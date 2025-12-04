<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->environment('local', 'development', 'testing')) {

            //TEST DATA
            $this->call([
            TestCategorySeeder::class,
            TestUserSeeder::class,
            TestProductSeeder::class,
            TestCartSeeder::class,
            ]);
        
        }else {
            // OFFICIAL DATA
            $this->call([
                UserSeeder::class,
                CategorySeeder::class,
                ProductSeeder::class,
            ]);
        }


    }
}
