<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{

            /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
    ];

    public function UserCart() {
        return $this->belongsTo(User::Class, "user_id", "id");
    }

    public function cartItems() {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    public function user() {
        return $this->belongsTo(User::Class, "user_id");
    }
}
