<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('products')->insert([
        [   'name' => 'Grey sporty hoodie', 
            'created_at' => now(), 
            'updated_at' => now(), 
            'description' => "A grey sports hoodie for men and women.",
            'price' => 39.99,
            'stock_qty' => 50,
            'stock_threshold' => 5,
            'image_url' => 'https://ruandrocka.co.uk/cdn/shop/files/GREYZIPHOODIEBACK.jpg?v=1723725056&width=1946',
            'category_id' => 11,
        ],

        
        [   'name' => 'Black suit trousers', 
            'created_at' => now(), 
            'updated_at' => now(), 
            'description' => "Suit trousers for men, coloured black.",
            'price' => 69.99,
            'stock_qty' => 40,
            'stock_threshold' => 5,
            'image_url' => 'https://cdn.media.amplience.net/i/frasersdev/57909103_o_a11?fmt=auto&upscale=true&w=450&h=450&sm=scaleFit&$h-ttl$',
            'category_id' => 12,

        ],
            
        ]);
    }
}
