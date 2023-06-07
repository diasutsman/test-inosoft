<?php

namespace Tests\Unit;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\User;
use App\Models\Motor;
use App\Models\Vehicle;
use Tests\CreatesApplication;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class ApiTest extends BaseTestCase
{
    use CreatesApplication;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // Run migration before each test
        Artisan::call('migrate');
    }

    /**
     * Rollback migration after each test.
     *
     * @return void
     */
    public function tearDown(): void
    {
        // Rollback migration after each test
        Artisan::call('migrate:rollback');

        parent::tearDown();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_list_vehicles_without_token()
    {
        $response = $this->get('api/vehicles');

        $response->assertStatus(401);
        $response->assertJson([
            'code' => 401,
            'message' => 'Missing authentication',
            'data' => null
        ]);
    }

    public function test_list_vehicles_with_token()
    {
        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->get('api/vehicles');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'code',
            'message',
            'data' => [
                '*' => [
                    'id',
                    'manufacture_year',
                    'color',
                    'price',
                    'sold_date',
                    'created_at',
                    'updated_at',
                    'vehicleable_type',
                    'vehicleable_id',
                    'vehicleable' => [
                        'id',
                        'vehicle_id',
                        'name',
                        'machine',
                        'suspension_type',
                        'transmission_type',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]
        ]);
    }

    public function test_list_cars_without_token()
    {
        $response = $this->get('/api/cars');

        $response->assertStatus(401);
    }

    public function test_list_cars_with_token()
    {
        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->get('/api/cars');

        $response->assertStatus(200);
    }

    public function test_list_motors_without_token()
    {
        $response = $this->get('/api/motors');

        $response->assertStatus(401);
    }

    public function test_list_motors_with_token()
    {
        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->get('/api/motors');

        $response->assertStatus(200);
    }

    public function test_carSalesReport_without_token()
    {
        $response = $this->get('/api/cars/report');

        $response->assertStatus(401);
    }

    public function test_carSalesReport_with_token()
    {
        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->get('/api/cars/report');

        $response->assertStatus(200);
    }

    public function test_motorcycleSalesReport_without_token()
    {
        $response = $this->get('/api/motors/report');

        $response->assertStatus(401);
    }

    public function test_motorcycleSalesReport_with_token()
    {
        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->get('/api/motors/report');

        $response->assertStatus(200);
    }

    public function test_carDetail_without_token()
    {
        // Create car data
        $car = Car::create([
            'name' => 'Car Test',
            'machine' => 'Test machine',
            'passenger_capacity' => 4,
            'type' => 'Test Type',
            'vehicle_id' => 1,
        ]);

        $response = $this->get('/api/cars/' . $car->id);

        $response->assertStatus(401);
    }

    public function test_carDetail_with_token()
    {
        $token = $this->getToken();

        // Create car data
        $car = Car::create([
            'name' => 'Car Test',
            'machine' => 'Test machine',
            'passenger_capacity' => 4,
            'type' => 'Test Type',
            'vehicle_id' => 1,
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->get('/api/cars/' . $car->id);

        $response->assertStatus(200);
    }

    public function test_motorcycleDetail_without_token()
    {
        // Create motorcycle data
        $motorcycle = Motor::create([
            'name' => 'Motorcycle Test',
            'machine' => 'Test Engine',
            'suspension_type' => 'Test Suspension',
            'transmission_type' => 'Test Transmission',
            'sold_date' => null,
            'vehicle_id' => 1,
        ]);

        $response = $this->get('/api/motors/' . $motorcycle->id);

        $response->assertStatus(401);
    }

    public function test_motorcycleDetail_with_token()
    {
        $token = $this->getToken();

        // Create motorcycle data
        $motorcycle = Motor::create([
            'name' => 'Motorcycle Test',
            'machine' => 'Test Engine',
            'suspension_type' => 'Test Suspension',
            'transmission_type' => 'Test Transmission',
            'sold_date' => null,
            'vehicle_id' => 1,
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->get('/api/motors/' . $motorcycle->id);

        $response->assertStatus(200);
    }

    public function test_addVehicle_without_token()
    {
        $vehicleData = [
            'manufacture_year' => 2023,
            'color' => 'black',
            'price' => 100000000
        ];

        $response = $this->post('/api/vehicles/', $vehicleData);

        $response->assertStatus(401);
    }

    public function test_addVehicle_with_token()
    {
        $token = $this->getToken();

        $vehicleData = [
            'manufacture_year' => 2023,
            'color' => 'black',
            'price' => 100000000
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->post('/api/vehicles/', $vehicleData);

        $response->assertStatus(201);
    }

    public function test_addVehicle_with_invalid_payload()
    {
        $token = $this->getToken();

        $vehicleData = [
            'manufacture_year' => '2023',
            'color' => 111,
            'price' => '100000000'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->post('/api/vehicles/', $vehicleData);

        $response->assertStatus(400);
    }

    public function test_addMotorcycle_without_token()
    {
        $motorcycleData = [
            'name' => 'Motorcycle Test',
            'machine' => 'Test Machine',
            'suspension_type' => 'Test Suspension',
            'transmission_type' => 'Test Transmission',
            'vehicle_id' => 1
        ];

        $response = $this->post('/api/motors', $motorcycleData);

        $response->assertStatus(401);
    }

    public function test_addMotorcycle_with_token()
    {
        $token = $this->getToken();

        $vehicle = Vehicle::create([
            'manufacture_year' => 2023,
            'color' => 'black',
            'price' => 100000000
        ]);

        $motorcycleData = [
            'name' => 'Motor Test',
            'machine' => 'Test Machine',
            'suspension_type' => 'Test Suspension',
            'transmission_type' => 'Test Transmission',
            'vehicle_id' => $vehicle->id,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->post('/api/motors', $motorcycleData);

        $response->assertStatus(201);
    }

    public function test_addMotorcycle_with_invalid_payload()
    {
        $token = $this->getToken();

        $motorcycleData = [
            'name' => [],
            'machine' => 11,
            'suspension_type' => ['fsfsf', 'fsfsf' => 'sdfsd'],
            'transmission_type' => 232323,
            'vehicle_id' => 1
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->post('/api/motors', $motorcycleData);

        $response->assertStatus(400);
    }

    public function test_addCar_without_token()
    {
        $carData = [
            'name' => 'Car Test',
            'machine' => 'Test Engine',
            'passenger_capacity' => 8,
            'type' => 'Test Type',
            'vehicle_id' => '1',
        ];

        $response = $this->post('/api/cars', $carData);

        $response->assertStatus(401);
    }

    public function test_addCar_with_token()
    {
        $token = $this->getToken();

        $vehicle = Vehicle::create([
            'manufacture_year' => 2023,
            'color' => 'black',
            'price' => 100000000
        ]);

        $carData = [
            'name' => 'Car Test',
            'machine' => 'Test Engine',
            'passenger_capacity' => 8,
            'type' => 'Test Type',
            'vehicle_id' => $vehicle->id,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->post('/api/cars', $carData);

        $response->assertStatus(201);
    }
    public function test_addCar_with_invalid_payload()
    {
        $token = $this->getToken();

        $carData = [
            'name' => 3424,
            'machine' => 8294,
            'passenger_capacity' => 'fsdfs',
            'type' => 'Test Type',
            'vehicle_id' => '1',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->post('/api/cars', $carData);

        $response->assertStatus(400);
    }

    public function test_updateMotorcycle_without_token()
    {
        // Create motorcycle data
        $motorcycle = Motor::create([
            'name' => 'Motorcycle Test',
            'machine' => 'Test Engine',
            'suspension_type' => 'Test Suspension',
            'transmission_type' => 'Test Transmission',
            'vehicle_id' => '1',
        ]);

        $motorcycleData = [
            'name' => 'Motorcycle Test 1',
            'machine' => 'Test Engine 1',
            'suspension_type' => 'Test Suspension 1',
            'transmission_type' => 'Test Transmission 1',
            'vehicle_id' => '1',
        ];

        $response = $this->put('/api/motors/' . $motorcycle->id, $motorcycleData);

        $response->assertStatus(401);
    }

    public function test_updateMotorcycle_with_token()
    {
        $token = $this->getToken();

        $vehicle = Vehicle::create([
            'manufacture_year' => 2023,
            'color' => 'black',
            'price' => 100000000
        ]);

        // Create motorcycle data
        $motorcycle = Motor::create([
            'name' => 'Motorcycle Test',
            'machine' => 'Test Engine',
            'suspension_type' => 'Test Suspension',
            'transmission_type' => 'Test Transmission',
            'vehicle_id' => $vehicle->id,
        ]);

        $motorcycleData = [
            'name' => 'Motorcycle Test 1',
            'machine' => 'Test Engine 1',
            'suspension_type' => 'Test Suspension 1',
            'tranension_type' => 'Test Suspension 1',
            'transmission_type' => 'Test Transmission 1',
            'vehicle_id' => $vehicle->id,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->put('/api/motors/' . $motorcycle->id, $motorcycleData);

        $response->assertStatus(200);

        $response->assertJson([
            'code' => 200,
            'message' => 'success',
            'data' => [
                '_id' => $motorcycle->id,
                'name' => 'Motorcycle Test 1',
                'machine' => 'Test Engine 1',
                'suspension_type' => 'Test Suspension 1',
                'transmission_type' => 'Test Transmission 1',
                'vehicle_id' => $vehicle->id,
            ]
        ]);
    }

    public function test_updateMotorcycle_with_invalid_payload()
    {
        $token = $this->getToken();

        $vehicle = Vehicle::create([
            'manufacture_year' => 2023,
            'color' => 'black',
            'price' => 100000000
        ]);

        // Create motorcycle data
        $motorcycle = Motor::create([
            'name' => 'Motorcycle Test',
            'machine' => 'Test Engine',
            'suspension_type' => 'Test Suspension',
            'transmission_type' => 'Test Transmission',
            'vehicle_id' => $vehicle->id,
        ]);

        $motorcycleData = [
            'name' => 11,
            'machine' => 3232,
            'suspension_type' => 34234,
            'transmission_type' => 232323,
            'vehicle_id' => 232323,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->put('/api/motors/' . $motorcycle->id, $motorcycleData);

        $response->assertStatus(400);
    }

    public function test_updateCar_without_token()
    {
        // Create car data
        $car = Car::create([
            'name' => 'Car Test',
            'machine' => 'Test Engine',
            'passenger_capacity' => 4,
            'type' => 'Test Type',
            'vehicle_id' => '1',
        ]);
        $carData = [
            'name' => 'Car Test',
            'machine' => 'Test Engine',
            'passenger_capacity' => 4,
            'type' => 'Test Type',
            'vehicle_id' => '1',
        ];

        $response = $this->put('/api/cars/' . $car->id, $carData);

        $response->assertStatus(401);
    }

    public function test_updateCar_with_token()
    {
        $token = $this->getToken();

        $vehicle = Vehicle::create([
            'manufacture_year' => 2023,
            'color' => 'black',
            'price' => 100000000
        ]);

        // Create car data
        $car = Car::create([
            'name' => 'Car Test',
            'machine' => 'Test Engine',
            'passenger_capacity' => 4,
            'type' => 'Test Type',
            'vehicle_id' => $vehicle->id,
        ]);
        $carData = [
            'name' => 'Car Test',
            'machine' => 'Test Engine',
            'passenger_capacity' => 4,
            'type' => 'Test Type',
            'vehicle_id' => $vehicle->id,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->put('/api/cars/' . $car->id, $carData);

        $response->assertStatus(200);
    }

    public function test_updateCar_with_invalid_payload()
    {
        $token = $this->getToken();

        $vehicle = Vehicle::create([
            'manufacture_year' => 2023,
            'color' => 'black',
            'price' => 100000000
        ]);

        // Create car data
        $car = Car::create([
            'name' => 'Car Test',
            'machine' => 'Test Engine',
            'passenger_capacity' => 4,
            'type' => 'Test Type',
            'vehicle_id' => $vehicle->id,
        ]);
        $carData = [
            'name' => 11,
            'machine' => 23,
            'passenger_capacity' => '4',
            'type' => 232323,
            'vehicle_id' => '1',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->put('/api/cars/' . $car->id, $carData);

        $response->assertStatus(400);
    }

    public function test_deleteCar_without_token()
    {
        $vehicle = Vehicle::create([
            'manufacture_year' => 2023,
            'color' => 'black',
            'price' => 100000000
        ]);

        // Create car data
        $car = Car::create([
            'name' => 'Car Test',
            'machine' => 'Test Engine',
            'passenger_capacity' => 4,
            'type' => 'Test Type',
            'vehicle_id' => $vehicle->id,
        ]);

        $response = $this->delete('/api/cars/' . $car->id);

        $response->assertStatus(401);
    }

    public function test_deleteCar_with_token()
    {
        $token = $this->getToken();

        $vehicle = Vehicle::create([
            'manufacture_year' => 2023,
            'color' => 'black',
            'price' => 100000000
        ]);

        // Create car data
        $car = Car::create([
            'name' => 'Car Test',
            'machine' => 'Test Engine',
            'passenger_capacity' => 4,
            'type' => 'Test Type',
            'vehicle_id' => $vehicle->id,
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->delete('/api/cars/' . $car->id);

        $response->assertStatus(200);
    }

    public function test_deleteMotorcycle_without_token()
    {
        // Create motorcycle data
        $motorcycle = Motor::create([
            'name' => 'Motorcycle Test',
            'machine' => 'Test Engine',
            'suspension_type' => 'Test Suspension',
            'transmission_type' => 'Test Transmission',
            'vehicle_id' => 1
        ]);

        $response = $this->delete('/api/motors/' . $motorcycle->id);

        $response->assertStatus(401);
    }

    public function test_deleteMotorcycle_with_token()
    {
        $token = $this->getToken();

        $vehicle = Vehicle::create([
            'manufacture_year' => 2023,
            'color' => 'black',
            'price' => 100000000
        ]);

        // Create motorcycle data
        $motorcycle = Motor::create([
            'name' => 'Motorcycle Test',
            'machine' => 'Test Engine',
            'suspension_type' => 'Test Suspension',
            'transmission_type' => 'Test Transmission',
            'vehicle_id' => $vehicle->id
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->delete('/api/motors/' . $motorcycle->id);

        $response->assertStatus(200);
    }

    public function test_buyCar_without_token()
    {
        // Create car data
        $car = Car::create([
            'name' => 'Car Test',
            'machine' => 'Test Engine',
            'passenger_capacity' => 4,
            'type' => 'Test Type',
            'vehicle_id' => 1,
        ]);

        $response = $this->put('/api/cars/' . $car->id . '/buy');

        $response->assertStatus(401);
    }

    public function test_buyCar_with_token()
    {
        $token = $this->getToken();

        // Create car data
        $car = Car::create([
            'name' => 'Car Test',
            'machine' => 'Test Engine',
            'passenger_capacity' => 4,
            'type' => 'Test Type',
            'vehicle_id' => 1,
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->put('/api/cars/' . $car->id . '/buy');

        $response->assertStatus(200);
    }

    public function test_buyMotorcycle_without_token()
    {
        // Create motorcycle data
        $motorcycle = Motor::create([
            'name' => 'Motorcycle Test',
            'machine' => 'Test Engine',
            'suspension_type' => 'Test Suspension',
            'transmission_type' => 'Test Transmission',
            'vehicle_id' => 1
        ]);

        $response = $this->put('/api/motors/' . $motorcycle->id . '/buy');

        $response->assertStatus(401);
    }

    public function test_buyMotorcycle_with_token()
    {
        $token = $this->getToken();

        // Create motorcycle data
        $motorcycle = Motor::create([
            'name' => 'Motorcycle Test',
            'machine' => 'Test Engine',
            'suspension_type' => 'Test Suspension',
            'transmission_type' => 'Test Transmission',
            'vehicle_id' => 1
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include token in request header
        ])->put('/api/motors/' . $motorcycle->id . '/buy');

        $response->assertStatus(200);

        $response->assertExactJson([
            'code' => 200,
            'message' => 'success',
            'data' => [
                '_id' => $motorcycle->id,
                'name' => 'Motorcycle Test',
                'machine' => 'Test Engine',
                'suspension_type' => 'Test Suspension',
                'transmission_type' => 'Test Transmission',
                'vehicle_id' => 1,
                'sold_date' => Carbon::now()->format('d/m/Y'),
            ]
        ]);
    }


    private function getToken()
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
