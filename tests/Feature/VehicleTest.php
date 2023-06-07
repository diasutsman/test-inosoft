<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Kendaraan;
use App\Models\User;
use App\Models\Vehicle;
use JWTAuth;
use Illuminate\Support\Str;

class VehicleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_all_vehicles()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->get('/api/vehicles?token=' . $token);

        $response->assertStatus(200);
    }
    public function test_show_penjualan()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->get('/api/vehicles/sales?token=' . $token);

        $response->assertStatus(200);
    }

    public function test_show_by_id_kendaraan()
    {

        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $vehicle = Vehicle::create([
            "manufacture_year" => random_int(2000, 2022),
            "color" => Str::random(6),
            "price" => 120000000,
            "vehicle_type" => "car",
            "machine" => "diesel",
            "suspension_type" => null,
            "transmission_type" => null,
            "status" => "ready",
            "type" => Str::random(3),
            "passenger_capacity" => random_int(1, 6),
        ]);

        $id = $vehicle->id;

        $response = $this->get('api/vehicles/' . $id . '?token=' . $token);

        $response->assertStatus(200);
    }

    public function test_post_kendaraan()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $form = [
            "manufacture_year" => random_int(2000, 2022),
            "color" => Str::random(6),
            "price" => 120000000,
            "vehicle_type" => "car",
            "machine" => "diesel",
            "suspension_type" => null,
            "transmission_type" => null,
            "status" => "ready",
            "type" => Str::random(3),
            "passenger_capacity" => random_int(1, 6),

        ];


        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('api/vehicles/', $form);

        $response->assertStatus(200);
    }
    public function test_update_kendaraan()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $vehicle = Vehicle::create([
            "manufacture_year" => random_int(2000, 2022),
            "color" => Str::random(6),
            "price" => 120000000,
            "vehicle_type" => "car",
            "machine" => "diesel",
            "suspension_type" => null,
            "transmission_type" => null,
            "status" => "ready",
            "type" => Str::random(3),
            "passenger_capacity" => random_int(1, 6),
        ]);

        $id = $vehicle->id;

        $form = [
            "manufacture_year" => random_int(2000, 2022),
            "color" => Str::random(6),
            "price" => 120000000,
            "vehicle_type" => "car",
            "machine" => "diesel",
            "suspension_type" => null,
            "transmission_type" => null,
            "status" => "ready",
            "type" => Str::random(3),
            "passenger_capacity" => random_int(1, 6),
        ];


        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('api/vehicles/' . $id, $form);

        $response->assertStatus(200);
    }

    public function test_delete_by_id_kendaraan()
    {

        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $vehicle = Vehicle::create([
            "manufacture_year" => random_int(2000, 2022),
            "color" => Str::random(6),
            "price" => 120000000,
            "vehicle_type" => "car",
            "machine" => "diesel",
            "suspension_type" => null,
            "transmission_type" => null,
            "status" => "ready",
            "type" => Str::random(3),
            "passenger_capacity" => random_int(1, 6),
        ]);

        $id = $vehicle->id;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete('api/vehicles/' . $id);

        $response->assertStatus(200);
    }
}
