<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ValidationService
{
    public function validateAppointment(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'date' => ['required', 'date'],
            'phone' => ['required', 'string', 'max:20'],
            'message' => ['nullable', 'string', 'max:1000'],
            'doctor' => ['required', 'string', 'max:255'],
            'time' => ['required', 'string', 'max:50'],
        ]);
    }

    public function validateCart(Request $request): array
    {
        return $request->validate([
            'product_id' => ['required', 'integer', Rule::exists('pharmacies', 'id')],
        ]);
    }

    public function validateOrderPlacement(Request $request): array
    {
        return $request->validate([
            'payment' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:500'],
            'bkash' => ['nullable', 'string', 'max:30'],
            'transaction_id' => ['nullable', 'string', 'max:100'],
        ]);
    }
}
