<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->post('/register', [
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'student',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
        $response->assertRedirect('/student/dashboard');
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/student/dashboard');
    }

    public function test_user_cannot_access_admin_dashboard_without_permission()
    {
        $user = User::factory()->create(['role' => 'student']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403);
    }
}
