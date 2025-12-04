<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'discount_amount',
        'final_total',
        'status',
    ];

    /**
     * Each order belongs to one user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Each order has many order items.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
