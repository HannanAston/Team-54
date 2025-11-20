<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // my admin account
        User::create([
            'name' => 'Angad Admin',
            'email' => 'angad.admin@revivalthreads.com',
            'email_verified_at' => now(),
            'password' => Hash::make('AdminPass123!'),
            'remember_token' => Str::random(10),
            'is_admin' => true
        ]);

        //Guest admin for demos

         User::create([
            'name' => 'Guest Admin',
            'email' => 'guest.admin@revivalthreads.com',
            'email_verified_at' => now(),
            'password' => Hash::make('GuestAdminPass123!'),
            'remember_token' => Str::random(10),
            'is_admin' => true
        ]);
    }
}
