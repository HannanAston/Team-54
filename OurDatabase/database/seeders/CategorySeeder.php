<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory(10)->create(); // 10 random using fakr

        DB::table('categories')->insert([
            ['category_name' => 'Hoodies', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Trousers', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Jackets', 'created_at' => now(), 'updated_at' => now()],
            //3 fixed categories:
        ]);

    }
}
