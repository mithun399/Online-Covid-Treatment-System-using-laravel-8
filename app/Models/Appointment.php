<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Appointment extends Model
{
    use HasFactory;

    public static function createForUser(array $data, ?int $userId): self
    {
        $appointment = new self();
        $appointment->name = $data['name'];
        $appointment->email = $data['email'];
        $appointment->date = $data['date'];
        $appointment->phone = $data['phone'];
        $appointment->message = $data['message'] ?? null;
        $appointment->doctor = $data['doctor'];
        $appointment->status = 'In Progress';
        $appointment->time = $data['time'];
        if ($userId) {
            $appointment->user_id = $userId;
        }
        $appointment->save();

        return $appointment;
    }

    public static function forUser(int $userId): Collection
    {
        return self::where('user_id', $userId)->get();
    }

    public static function cancelForUserWithStatuses(int $id, int $userId, array $statuses): int
    {
        return self::where('id', $id)
            ->where('user_id', $userId)
            ->whereIn('status', $statuses)
            ->delete();
    }
}
