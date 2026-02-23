<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Cart extends Model
{
    use HasFactory;

    public static function addForUser(int $userId, int $productId): self
    {
        $cart = new self();
        $cart->user_id = $userId;
        $cart->product_id = $productId;
        $cart->save();

        return $cart;
    }

    public static function countForUser(int $userId): int
    {
        return self::where('user_id', $userId)->count();
    }

    public static function productsForUser(int $userId): Collection
    {
        return self::query()
            ->join('pharmacies', 'carts.product_id', '=', 'pharmacies.id')
            ->where('carts.user_id', $userId)
            ->select('pharmacies.*', 'carts.id as cart_id')
            ->get();
    }

    public static function totalForUser(int $userId): int
    {
        return self::query()
            ->join('pharmacies', 'carts.product_id', '=', 'pharmacies.id')
            ->where('carts.user_id', $userId)
            ->sum('pharmacies.price');
    }

    public static function forUser(int $userId): Collection
    {
        return self::where('user_id', $userId)->get();
    }

    public static function clearForUser(int $userId): int
    {
        return self::where('user_id', $userId)->delete();
    }
}
