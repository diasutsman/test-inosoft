<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use JWTAuth;

class CarTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_show_penjualan_mobil()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/cars/sales');

        $response->assertStatus(200);
    }

    public function test_show_stock_mobil()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/cars/stock');

        $response->assertStatus(200);
    }

    public function test_show_mobil()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/cars');

        $response->assertStatus(200);
    }
}
