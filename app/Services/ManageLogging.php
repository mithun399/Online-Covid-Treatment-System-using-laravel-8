<?php

namespace App\Services;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ManageLogging
{
    public const CUSTOM_LOG_FILE_NAME_KEY = 'CUSTOM_LOG_FILE_NAME_KEY';
    public const PANEL_NAME_LOG_KEY = 'panel';
    public const PANEL_NAME_LOG_POST_FIX = '_PANEL_LOG';

    public const LOG_SEARCH_WORD_SPLITTER = '[SEP]';
    public const SEARCH_LOG_PREFIX = 'SEARCH_LOG_';

    public const LOG_TYPE_INFO = 'info';
    public const LOG_TYPE_ERROR = 'error';

    public static $should_log = null;
    public static array $hide_keys = [];

    /**
     * Create an application log entry.
     */
    public function createLog(array $data, bool $mergeCommonLog = true, string $logType = self::LOG_TYPE_INFO): bool
    {
        try {
            if ($mergeCommonLog) {
                $this->getCommonLogData($data);
            }

            $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

            if ($jsonData === false) {
                return false;
            }

            Log::{$logType}($this->removeLineBreaks($jsonData));

            return true;
        } catch (\Throwable $throwable) {
            Log::error('MANAGE_LOGGING_CREATE_LOG_FAILED', [
                'exception' => $throwable->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Resolve request-aware metadata and merge with given log payload.
     */
    public function getCommonLogData(array &$logData): void
    {
        $traceId = self::getTraceId();

        if (!empty($traceId)) {
            $logData = ['trace_id' => $traceId] + $logData;
        }

        $logData = ['log_id' => app()->bound('log_id') ? app('log_id') : self::uniqueLogId()] + $logData;
        $logData['date_time'] = Carbon::now()->toDateTimeString();

        if (!App::runningInConsole() && request()) {
            $logData['auth_user_ip'] = request()->ip();
            $logData['auth_user_agent'] = request()->userAgent();
        }

        if (function_exists('auth') && auth()->check()) {
            $logData['auth_email'] = auth()->user()->email;
            $logData['auth_id'] = auth()->id();
        }
    }

    public static function getTraceId(): ?string
    {
        if (!App::runningInConsole() && request()->headers->has('x-request-id')) {
            $requestId = trim((string) request()->headers->get('x-request-id'));

            if (Str::length($requestId) > 10) {
                return $requestId;
            }
        }

        return null;
    }

    public static function resolveTrackingId(): string
    {
        return self::getTraceId() ?? (app()->bound('log_id') ? app('log_id') : self::uniqueLogId());
    }

    public static function uniqueLogId(): string
    {
        return 'l' . uniqid() . '-r' . random_int(10000, 99999) . '-d' . now()->format('Ymd') . '-t' . now()->format('His');
    }

    public static function mergeQueriesAndBindings(array $queryLogsData = []): array
    {
        $finalQueries = [];

        foreach ($queryLogsData as $queryLog) {
            $query = $queryLog['query'] ?? '';
            $bindings = $queryLog['bindings'] ?? [];

            $formattedBindings = array_map(static function ($item) {
                if ($item instanceof Carbon || $item instanceof CarbonImmutable) {
                    return sprintf("'%s'", $item->toDateTimeString());
                }

                if (is_string($item)) {
                    return sprintf("'%s'", $item);
                }

                if (is_null($item)) {
                    return 'NULL';
                }

                return $item;
            }, $bindings);

            $finalQueries[] = (string) Str::of($query)->replaceArray('?', $formattedBindings);
        }

        return $finalQueries;
    }

    public static function shouldLog($shouldLog = null)
    {
        if (!is_null($shouldLog)) {
            self::$should_log = $shouldLog;
        }

        return self::$should_log;
    }

    public static function hideKeys($hideKeys = null)
    {
        if (!empty($hideKeys)) {
            self::$hide_keys = array_merge(self::$hide_keys, is_array($hideKeys) ? $hideKeys : [$hideKeys]);
            return self::$hide_keys;
        }

        $hiddenKeys = self::$hide_keys;
        self::$hide_keys = [];

        return $hiddenKeys;
    }

    public static function setDynamicLogFile(array $logData, string $fileName = 'custom-log-file'): void
    {
        Log::build([
            'driver' => 'single',
            'path' => storage_path("logs/{$fileName}.log"),
            'level' => 'debug',
        ])->info('DEBUG:', $logData);
    }

    public static function setCustomLogFileName(string $fileName): void
    {
        app()->instance(self::CUSTOM_LOG_FILE_NAME_KEY, $fileName);
    }

    public static function createDebuggingLog(array $logData): void
    {
        $fileName = app()->bound(self::CUSTOM_LOG_FILE_NAME_KEY)
            ? app(self::CUSTOM_LOG_FILE_NAME_KEY)
            : 'custom-log-file';

        self::setDynamicLogFile($logData, $fileName);
    }

    public function logSearchArray(string $scope, array $data): bool
    {
        return $this->createLog([
            'action' => self::SEARCH_LOG_PREFIX . $scope,
            'data' => $this->filterEmptyValues($this->cleanSearchData($data)),
        ]);
    }

    public function logSearchArrayWithEmptyValues(string $scope, array $data): bool
    {
        return $this->createLog([
            'action' => self::SEARCH_LOG_PREFIX . $scope,
            'data' => $this->cleanSearchData($data),
        ]);
    }

    public function getAllRequestAfterProvidedKey(array $input, string $logKey): array
    {
        return collect($input)
            ->skipUntil(fn ($value, $key) => $key === $logKey)
            ->toArray();
    }

    public function prepareLogDataAfterProvidedKey(array $data): array
    {
        $filterData = [
            'input_data' => '_token',
            'model_data' => '_token',
        ];

        foreach ($filterData as $key => $value) {
            if (isset($data[$key]) && is_array($data[$key])) {
                $data[$key] = $this->getAllRequestAfterProvidedKey($data[$key], $value);
            }
        }

        return $data;
    }

    public static function getPanelLogString(string $panel): string
    {
        return Str::upper($panel) . self::PANEL_NAME_LOG_POST_FIX;
    }

    private function cleanSearchData(array $data): array
    {
        $unusedKeys = [
            'activeAdminUsers',
            'auth_user_id',
            'page_limit',
            'order_by',
            'asc_desc',
            'orderBy',
            'limit',
            'is_simple_paginate_active',
        ];

        return Arr::except($data, $unusedKeys);
    }

    private function filterEmptyValues(array $data): array
    {
        return array_filter($data, static fn ($value) => !empty($value));
    }

    private function removeLineBreaks(string $item): string
    {
        return str_replace(["\r\n", "\r", "\n", "\t", '\\n', '\\t', '\\r'], '', $item);
    }
}
