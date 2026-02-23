<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Plasma extends Model
{
    use HasFactory;

    public static function createFromArray(array $data): self
    {
        $donor = new self();
        $donor->name = $data['name'] ?? null;
        $donor->blood = $data['blood'] ?? null;
        $donor->address = $data['address'] ?? null;
        $donor->phone = $data['phone'] ?? null;
        $donor->save();

        return $donor;
    }

    public static function paginateList(int $perPage): LengthAwarePaginator
    {
        return self::paginate($perPage);
    }
}
