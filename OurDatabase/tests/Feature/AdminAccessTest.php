<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AdminAccessTest extends TestCase
{
    Use RefreshDatabase;

    /**
     * 1. Middleware Tests
     */

    /** @test */
    public function guest_is_redirected_to_login_when_accessing_admin_page()
    {
        $response = $this->get('/admin/users');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function non_admin_user_gets_403_error_on_admin_page()
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->get('/admin/users');

        $response->assertStatus(403);
    }

    /** @test */
    public function admin_user_can_access_admin_page()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get('/admin/users');

        $response->assertStatus(200);
    }

    // 2. Route and Controller tests

    /** @test */
    public function admin_page_loads_correct_view()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get('/admin/users');

        $response->assertViewIs('users.index');
    }

    /** @test */
    public function admin_page_receives_users_list()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $users = User::factory()->count(5)->create();

        $response = $this->actingAs($admin)->get('/admin/users');

        $response->assertViewHas('users', function ($viewUsers) use ($users){
            return $viewUsers->count() === 6; //5 users + admin
        });
    }

    // 3. Dashboard button tests

    
    /** @test */
    public function dashboard_shows_manage_users_button_for_admin()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertSee('Manage users');
        $response->assertSee('/admin/users');
    }

     /** @test */
    public function dashboard_hides_manage_users_button_for_non_admin()
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertDontSee('Manage users');
        
    }
}
