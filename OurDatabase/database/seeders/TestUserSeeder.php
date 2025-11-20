<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::create([
            'name' => 'Test Admin',
            'email' => 'test.admin@revivalthreads.com',
            'email_verified_at' => now(),
            'password' => Hash::make('TestAdminPass123!'),
            'remember_token' => Str::random(10),
            'is_admin' => true
        ]);
    }
}
