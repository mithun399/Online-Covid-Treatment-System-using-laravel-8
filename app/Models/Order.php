<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    public static function createFromCarts(Collection $carts, array $data): void
    {
        DB::transaction(function () use ($carts, $data) {
            $now = now();
            $records = [];

            foreach ($carts as $cart) {
                $records[] = [
                    'product_id' => $cart['product_id'],
                    'user_id' => $cart['user_id'],
                    'status' => 'pending',
                    'payment_method' => $data['payment'],
                    'payment_status' => 'pending',
                    'address' => $data['address'],
                    'bkash' => $data['bkash'] ?? null,
                    'transaction_id' => $data['transaction_id'] ?? null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            if (!empty($records)) {
                self::insert($records);
            }

            if ($carts->isNotEmpty()) {
                Cart::clearForUser((int) $carts->first()['user_id']);
            }
        });
    }

    public static function productsForUser(int $userId): Collection
    {
        return self::query()
            ->join('pharmacies', 'orders.product_id', '=', 'pharmacies.id')
            ->where('orders.user_id', $userId)
            ->get();
    }

    public static function removeForUser(int $id, int $userId): int
    {
        return self::where('id', $id)
            ->where('user_id', $userId)
            ->delete();
    }
}
