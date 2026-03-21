<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    //
        /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_qty',
        'stock_threshold',
        'image_url',
        'image_path',
        'category_id',
    ];

    public function category() {
        return $this->belongsTo(Category::class, "category_id", "id");
    }

    public function getStockStatus()
    {
        if ($this->stock_qty == 0) {
            return 'Out of Stock';
        } elseif ($this->stock_qty <= $this->stock_threshold) {
            return 'Low Stock';
        } else {
            return 'In Stock';
        }
    }

    public function getStockStatusClass()
    {
        if ($this->stock_qty == 0) {
            return 'out-of-stock';
        } elseif ($this->stock_qty <= $this->stock_threshold) {
            return 'low-stock';
        } else {
            return 'in-stock';
        }
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }
}

