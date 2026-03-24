<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Tops
            ['category' => 'Tops', 'name' => 'Classic Cotton Tee', 'description' => 'Soft recycled cotton T-shirt with a relaxed fit; restored from vintage stock for everyday wear.', 'price' => 28.00, 'image_url' => 'https://kudoscompanies.co.uk/cdn/shop/products/Shirt_1_749b9216-9cea-4bb4-bb4c-5e550cbd83f0_large.jpg?v=1516107628'],
            ['category' => 'Tops', 'name' => 'Ribbed Long Sleeve Top', 'description' => 'Slim-fit ribbed top made from renewed stretch cotton; perfect for layering or wearing on its own.', 'price' => 34.00, 'image_url' => 'https://kudoscompanies.co.uk/cdn/shop/products/Shirt_1_749b9216-9cea-4bb4-bb4c-5e550cbd83f0_large.jpg?v=1516107628'],
            ['category' => 'Tops', 'name' => 'Oversized Graphic Tee', 'description' => 'Loose-fit T-shirt with a faded vintage print; reworked from reclaimed fabric.', 'price' => 32.00, 'image_url' => 'https://kudoscompanies.co.uk/cdn/shop/products/Shirt_1_749b9216-9cea-4bb4-bb4c-5e550cbd83f0_large.jpg?v=1516107628'],
            ['category' => 'Tops', 'name' => 'Button-Up Shirt', 'description' => 'Lightweight button-up shirt crafted from repurposed cotton; featuring a relaxed vintage cut.', 'price' => 45.00, 'image_url' => 'https://kudoscompanies.co.uk/cdn/shop/products/Shirt_1_749b9216-9cea-4bb4-bb4c-5e550cbd83f0_large.jpg?v=1516107628'],
            ['category' => 'Tops', 'name' => 'Knit Sweater', 'description' => 'Soft mid-weight sweater restored from vintage knitwear with subtle texture and warmth.', 'price' => 52.00, 'image_url' => 'https://kudoscompanies.co.uk/cdn/shop/products/Shirt_1_749b9216-9cea-4bb4-bb4c-5e550cbd83f0_large.jpg?v=1516107628'],

            // Bottoms
            ['category' => 'Bottoms', 'name' => 'Straight Leg Jeans', 'description' => 'Classic straight-cut denim jeans made from renewed vintage denim with light wear character.', 'price' => 58.00, 'image_url' => 'https://www.buyworkwear.co.uk/cdn/shop/products/NLSPCT-B-BLACK_7b254d23-7604-4c3a-b261-2604379d508a.jpg?v=1678447758&width=1080'],
            ['category' => 'Bottoms', 'name' => 'Wide Leg Trousers', 'description' => 'Flowing wide-leg trousers tailored from reclaimed fabric for comfort and movement.', 'price' => 54.00, 'image_url' => 'https://www.buyworkwear.co.uk/cdn/shop/products/NLSPCT-B-BLACK_7b254d23-7604-4c3a-b261-2604379d508a.jpg?v=1678447758&width=1080'],
            ['category' => 'Bottoms', 'name' => 'Denim Skirt', 'description' => 'Mid-length skirt cut from repurposed denim with a clean timeless silhouette.', 'price' => 42.00, 'image_url' => 'https://www.buyworkwear.co.uk/cdn/shop/products/NLSPCT-B-BLACK_7b254d23-7604-4c3a-b261-2604379d508a.jpg?v=1678447758&width=1080'],
            ['category' => 'Bottoms', 'name' => 'Relaxed Fit Joggers', 'description' => 'Soft fleece joggers reworked from vintage sportswear for everyday comfort.', 'price' => 38.00, 'image_url' => 'https://www.buyworkwear.co.uk/cdn/shop/products/NLSPCT-B-BLACK_7b254d23-7604-4c3a-b261-2604379d508a.jpg?v=1678447758&width=1080'],
            ['category' => 'Bottoms', 'name' => 'Tailored Shorts', 'description' => 'Smart casual shorts made from upcycled suiting fabric with a neat finish.', 'price' => 36.00, 'image_url' => 'https://www.buyworkwear.co.uk/cdn/shop/products/NLSPCT-B-BLACK_7b254d23-7604-4c3a-b261-2604379d508a.jpg?v=1678447758&width=1080'],

            // Outerwear
            ['category' => 'Outerwear', 'name' => 'Denim Jacket', 'description' => 'Classic trucker-style jacket restored from vintage denim with reinforced stitching.', 'price' => 68.00, 'image_url' => 'https://www.consortium.co.uk/media/catalog/product/cache/1/image/1000x/af097278c5db4767b0fe9bb92fe21690/s/t/stussy-stock-logo-zip-hoodie-heather-grey-118533ho23_0000_cat.jpg'],
            ['category' => 'Outerwear', 'name' => 'Wool Coat', 'description' => 'Mid-length wool coat made from reclaimed materials offering warmth and structure.', 'price' => 95.00, 'image_url' => 'https://www.consortium.co.uk/media/catalog/product/cache/1/image/1000x/af097278c5db4767b0fe9bb92fe21690/s/t/stussy-stock-logo-zip-hoodie-heather-grey-118533ho23_0000_cat.jpg'],
            ['category' => 'Outerwear', 'name' => 'Lightweight Windbreaker', 'description' => 'Renewed vintage windbreaker with a relaxed fit and practical design.', 'price' => 60.00, 'image_url' => 'https://www.consortium.co.uk/media/catalog/product/cache/1/image/1000x/af097278c5db4767b0fe9bb92fe21690/s/t/stussy-stock-logo-zip-hoodie-heather-grey-118533ho23_0000_cat.jpg'],
            ['category' => 'Outerwear', 'name' => 'Utility Jacket', 'description' => 'Multi-pocket jacket crafted from repurposed canvas for durability and style.', 'price' => 72.00, 'image_url' => 'https://www.consortium.co.uk/media/catalog/product/cache/1/image/1000x/af097278c5db4767b0fe9bb92fe21690/s/t/stussy-stock-logo-zip-hoodie-heather-grey-118533ho23_0000_cat.jpg'],
            ['category' => 'Outerwear', 'name' => 'Quilted Vest', 'description' => 'Sleeveless padded vest reworked from vintage outerwear ideal for layering.', 'price' => 55.00, 'image_url' => 'https://www.consortium.co.uk/media/catalog/product/cache/1/image/1000x/af097278c5db4767b0fe9bb92fe21690/s/t/stussy-stock-logo-zip-hoodie-heather-grey-118533ho23_0000_cat.jpg'],

            // Accessories
            ['category' => 'Accessories', 'name' => 'Canvas Tote Bag', 'description' => 'Durable tote made from reclaimed canvas perfect for daily use.', 'price' => 22.00, 'image_url' => 'https://eu-images.contentstack.com/v3/assets/blt7dcd2cfbc90d45de/blt624ff5f299b58f94/60dbc00b5543520fcbc2beb2/g-ne-4mm_1_9.jpg?format=pjpg&auto=webp&quality=75%2C90&width=640'],
            ['category' => 'Accessories', 'name' => 'Leather Belt', 'description' => 'Genuine leather belt restored from vintage stock with a simple buckle.', 'price' => 26.00, 'image_url' => 'https://eu-images.contentstack.com/v3/assets/blt7dcd2cfbc90d45de/blt624ff5f299b58f94/60dbc00b5543520fcbc2beb2/g-ne-4mm_1_9.jpg?format=pjpg&auto=webp&quality=75%2C90&width=640'],
            ['category' => 'Accessories', 'name' => 'Knit Beanie', 'description' => 'Soft knit beanie made from recycled yarn for warmth and comfort.', 'price' => 18.00, 'image_url' => 'https://eu-images.contentstack.com/v3/assets/blt7dcd2cfbc90d45de/blt624ff5f299b58f94/60dbc00b5543520fcbc2beb2/g-ne-4mm_1_9.jpg?format=pjpg&auto=webp&quality=75%2C90&width=640'],
            ['category' => 'Accessories', 'name' => 'Cotton Scarf', 'description' => 'Lightweight scarf crafted from repurposed cotton fabric with a soft finish.', 'price' => 20.00, 'image_url' => 'https://eu-images.contentstack.com/v3/assets/blt7dcd2cfbc90d45de/blt624ff5f299b58f94/60dbc00b5543520fcbc2beb2/g-ne-4mm_1_9.jpg?format=pjpg&auto=webp&quality=75%2C90&width=640'],
            ['category' => 'Accessories', 'name' => 'Crossbody Bag', 'description' => 'Compact everyday bag made from renewed materials with adjustable strap.', 'price' => 34.00, 'image_url' => 'https://eu-images.contentstack.com/v3/assets/blt7dcd2cfbc90d45de/blt624ff5f299b58f94/60dbc00b5543520fcbc2beb2/g-ne-4mm_1_9.jpg?format=pjpg&auto=webp&quality=75%2C90&width=640'],

            // Shoes
            ['category' => 'Shoes', 'name' => 'Classic Sneakers', 'description' => 'Comfortable low-top sneakers refurbished from vintage pairs with new insoles.', 'price' => 48.00, 'image_url' => 'https://t4.ftcdn.net/jpg/04/39/60/05/360_F_439600528_2FWTMQDiXYv6T0qolS57KSxiNbqlhDTa.jpg'],
            ['category' => 'Shoes', 'name' => 'Leather Boots', 'description' => 'Durable ankle boots restored from genuine leather with updated soles.', 'price' => 85.00, 'image_url' => 'https://t4.ftcdn.net/jpg/04/39/60/05/360_F_439600528_2FWTMQDiXYv6T0qolS57KSxiNbqlhDTa.jpg'],
            ['category' => 'Shoes', 'name' => 'Canvas Slip-Ons', 'description' => 'Easy-wear slip-on shoes made from reclaimed canvas materials.', 'price' => 36.00, 'image_url' => 'https://t4.ftcdn.net/jpg/04/39/60/05/360_F_439600528_2FWTMQDiXYv6T0qolS57KSxiNbqlhDTa.jpg'],
            ['category' => 'Shoes', 'name' => 'Chunky Trainers', 'description' => 'Cushioned trainers rebuilt from vintage components for all-day comfort.', 'price' => 58.00, 'image_url' => 'https://t4.ftcdn.net/jpg/04/39/60/05/360_F_439600528_2FWTMQDiXYv6T0qolS57KSxiNbqlhDTa.jpg'],
            ['category' => 'Shoes', 'name' => 'Casual Loafers', 'description' => 'Simple slip-on loafers renewed from leather uppers with refreshed lining.', 'price' => 62.00, 'image_url' => 'https://t4.ftcdn.net/jpg/04/39/60/05/360_F_439600528_2FWTMQDiXYv6T0qolS57KSxiNbqlhDTa.jpg'],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name'            => $product['name'],
                'description'     => $product['description'],
                'price'           => $product['price'],
                'image_url'       => $product['image_url'],
                'category_id'     => DB::table('categories')->where('category_name', $product['category'])->value('id'),
                'stock_qty'       => 50,
                'stock_threshold' => 5,
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}