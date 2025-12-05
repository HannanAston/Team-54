<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class TestProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Product::factory(3)->create();

        DB::table('products')->insert([
        [   'name' => 'Grey sporty hoodie',
            'created_at' => now(),
            'updated_at' => now(),
            'description' => "A grey sports hoodie for men and women.",
            'price' => 39.99,
            'stock_qty' => 50,
            'stock_threshold' => 5,
            'image_url' => 'hoodie.jpg',
            'category_id' => 11,
        ],


        [   'name' => 'Black suit trousers',
            'created_at' => now(),
            'updated_at' => now(),
            'description' => "Suit trousers for men, coloured black.",
            'price' => 69.99,
            'stock_qty' => 40,
            'stock_threshold' => 5,
            'image_url' => 'trouser.jpg',
            'category_id' => 12,

        ],

        [   'name' => 'Cargo Trousers',
            'created_at' => now(),
            'updated_at' => now(),
            'description' => "Cargo Trousers for heavy work.",
            'price' => 50.99,
            'stock_qty' => 30,
            'stock_threshold' => 5,
            'image_url' => 'trouser.jpg',
            'category_id' => 12,

        ],

        ]);
    }
}
