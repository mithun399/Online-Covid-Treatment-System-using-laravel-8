<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Helpline extends Model
{
    use HasFactory;

    public static function fetchAll(): Collection
    {
        return self::all();
    }
}
