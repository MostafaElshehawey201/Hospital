<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_success()
    {
        $response = $this->postJson('/api/v1/Auth/register', [
            "name" => "mostafa mahmoud",
            "email" => "mostafa@gmail.com",
            "phone" => "01095766001",
            "password" => "Mostafa123455$",
            "password_confirmation" => "Mostafa123455$",
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            "email" => "mostafa@gmail.com"
        ]);
    }

    public function test_register_errors()
    {
        $response = $this->postJson('api/v1/Auth/register', [
            "name" => "",
            "email" => "",
            "phone" => "",
            "password" => "",
            "password_confirmation" => "",
        ]);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'success',
            'errors'
        ]);
    }
}
