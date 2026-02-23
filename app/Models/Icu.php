<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Icu extends Model
{
    use HasFactory;

    public static function totalCount(): int
    {
        return self::count();
    }

    public static function createFromArray(array $data): self
    {
        $icu = new self();
        $icu->name = $data['name'] ?? null;
        $icu->reference = $data['reference'] ?? null;
        $icu->date = $data['date'] ?? null;
        $icu->address = $data['address'] ?? null;
        $icu->phone = $data['phone'] ?? null;
        $icu->message = $data['message'] ?? null;
        $icu->save();

        return $icu;
    }
}
