<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public static function createFromArray(array $data): self
    {
        $payment = new self();
        $payment->doctor = $data['doctor'] ?? null;
        $payment->bkash = $data['bkash'] ?? null;
        $payment->amount = $data['amount'] ?? null;
        $payment->trxID = $data['trxID'] ?? null;
        $payment->save();

        return $payment;
    }
}
