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
        'category_id',
    ];

    public function category() {
        return $this->belongsTo(Category::class, "category_id", "id");
    }
}
