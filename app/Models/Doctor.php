<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Doctor extends Model
{
    use HasFactory;


    public static function fetchAll(): Collection
    {
        return self::all();
    }

    public static function findById(int $id): ?self
    {
        return self::find($id);
    }

    public static function searchByName(string $query): Collection
    {
        return self::where('name', 'like', '%' . $query . '%')->get();
    }
}
