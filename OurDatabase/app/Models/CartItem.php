<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{

    /** @use HasFactory<\Database\Factories\CartItemFactory> */
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];


    public function Cartproduct() {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
