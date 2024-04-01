<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_registration()
    {
        $userData = [
            'name' => fake()->name,
            'email' => fake()->unique()->safeEmail,
            'password' => 'password',
        ];

        $this->postJson('/api/auth/register', $userData)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['token']);

    }

    public function test_user_login()
    {
        $user = User::factory()->create();

        $userData = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $this->postJson('/api/auth/login', $userData)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['token']);
    }

    public function testUserLogout()
    {
        $user = User::factory()->create();

        $userData = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $token = $this->postJson('/api/auth/login', $userData)->json('token');

        $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->postJson('/api/auth/logout')
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(['message' => 'Successfully logged out']);
    }
}
