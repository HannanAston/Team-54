<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;

class DatabaseSeederTest extends TestCase

{
   use RefreshDatabase;
   /**
     * runs the seeders and creates basic data
     */

    /** @test */
   public function runs_the_seeders_and_creates_basic_data(): void
   {
       $this->seed(); //runs all seeders

       // Count records
   $userCount = User::count();
   $categoryCount = Category::count();

       //output log
      fwrite (STDOUT, "\n--- SEEDING SUMMARY ---\n");
      fwrite (STDOUT, "Users Seeded: {$userCount}\n");
      fwrite (STDOUT, "Categories seeded: {$categoryCount}\n");
      fwrite (STDOUT, "--------------------\n");


       $this->assertTrue(User::count() > 0, 'No Users created.'); //assert user made
       $this->assertTrue(Category::count() > 0, 'No Categories seeded.'); //assert category made
   }

    /** @test */
   public function an_admin_user_exists(): void 
   {  
   
      $this->seed();

      $admin = User::where('is_admin', true)->first();

      $this->assertNotNull($admin, 'No admin account created.');

   }

   public function categories_have_the_required_fields(): void
   {
      $this->seed();

      $category = Category::first();

      $this->assertNotNull($category->category_name, 'Category name is missing.');
   }
}