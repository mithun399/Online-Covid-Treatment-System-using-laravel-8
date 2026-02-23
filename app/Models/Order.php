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
            foreach ($carts as $cart) {
                $order = new self();
                $order->product_id = $cart['product_id'];
                $order->user_id = $cart['user_id'];
                $order->status = 'pending';
                $order->payment_method = $data['payment'];
                $order->payment_status = 'pending';
                $order->address = $data['address'];
                $order->bkash = $data['bkash'] ?? null;
                $order->transaction_id = $data['transaction_id'] ?? null;
                $order->save();
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
