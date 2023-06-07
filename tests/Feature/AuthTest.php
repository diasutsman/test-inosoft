<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use JWTAuth;
use Illuminate\Support\Str;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_success()
    {
        User::create([
            "name" => "Joko Doe",
            "email" => "jokodoe@gmail.com",
            "password" => bcrypt(12345678),
        ]);
        $data = [
            "email" => "jokodoe@gmail.com",
            "password" => 12345678,
        ];
        $response = $this->post('/api/login', $data);
        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }
    public function test_login_failed()
    {
        $data = [
            "email" => "uhuy@gmail.com",
            "password" => 12345,
        ];
        $response = $this->post('/api/login', $data);

        $response->assertStatus(401);
    }

    public function test_register_success()
    {
        $data = [
            "name" => Str::random(10),
            "email" => Str::random(6) . "@gmail.com",
            "password" => 12345678
        ];
        $response = $this->post('/api/register', $data);

        $response->assertStatus(200);
    }
    public function test_register_failed()
    {
        $data = [
            "name" => "",
            "email" => "uhuy@gmail.com",
            "password" => null,
        ];
        $response = $this->post('/api/register', $data);

        $response->assertStatus(400);
    }
    public function test_get_user_success()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->get('/api/me?token=' . $token);

        $response->assertStatus(200);
    }
    public function test_get_user_failed()
    {
        $token = "randomtoken";
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/me');

        $response->assertStatus(401);
    }
    public function test_logout_success()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/logout');

        $response->assertStatus(200);
    }
    public function test_logout_failed()
    {
        $token = "randomtoken";
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/logout');

        $response->assertStatus(401);
    }
}
