<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Mymensingh extends Model
{
    use HasFactory;

    public static function paginateList(int $perPage): LengthAwarePaginator
    {
        return self::paginate($perPage);
    }
}
