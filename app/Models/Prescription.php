<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Prescription extends Model
{
    use HasFactory;

    public static function createFromArray(array $data): self
    {
        $prescription = new self();
        $prescription->name = $data['name'] ?? null;
        $prescription->dname = $data['dname'] ?? null;
        $prescription->age = $data['age'] ?? null;
        $prescription->file = $data['file'] ?? null;
        $prescription->save();

        return $prescription;
    }

    public static function fetchAll(): Collection
    {
        return self::all();
    }

    public static function findById(int $id): ?self
    {
        return self::find($id);
    }
}
