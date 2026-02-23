<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    public static function createFromArray(array $data): self
    {
        $sample = new self();
        $sample->name = $data['name'] ?? null;
        $sample->email = $data['email'] ?? null;
        $sample->number = $data['phone'] ?? null;
        $sample->date = $data['date'] ?? null;
        $sample->address = $data['address'] ?? null;
        $sample->message = $data['message'] ?? null;
        $sample->save();

        return $sample;
    }
}
