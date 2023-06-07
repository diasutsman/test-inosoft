<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function getToken()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => bcrypt('test12345') // Use bcrypt to encrypt the password
        ]);

        $loginData = [
            'email' => 'test@test.com',
            'password' => 'test12345'
        ];

        $response = $this->json('POST', 'api/login', $loginData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in'
            ]);

        $token = $response->json('access_token');

        return $token;
    }
}
