<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Tests\CreatesApplication;
use App\Models\Car;
use App\Models\Motor;
use App\Models\User;

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

        // Jalankan migrasi sebelum setiap pengujian
        Artisan::call('migrate');
    }

    /**
     * Rollback migrasi setelah setiap pengujian.
     *
     * @return void
     */
    public function tearDown(): void
    {
        // Rollback migrasi setelah setiap pengujian
        Artisan::call('migrate:rollback');

        parent::tearDown();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_listKendaraan()
    {
        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Menyertakan token dalam header permintaan
        ])->get('/api/auth/list-kendaraan');

        $response->assertStatus(200);
    }

    public function test_listCar()
    {
        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Menyertakan token dalam header permintaan
        ])->get('/api/auth/list-mobil');

        $response->assertStatus(200);
    }

    public function test_listMotor()
    {
        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Menyertakan token dalam header permintaan
        ])->get('/api/auth/list-motor');

        $response->assertStatus(200);
    }

    public function test_laporanCar()
    {
        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Menyertakan token dalam header permintaan
        ])->get('/api/auth/laporan-penjualan-mobil');

        $response->assertStatus(200);
    }

    public function test_laporanMotor()
    {
        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Menyertakan token dalam header permintaan
        ])->get('/api/auth/laporan-penjualan-motor');

        $response->assertStatus(200);
    }

    public function test_detailCar()
    {
        $token = $this->getToken();

        // Membuat data mobil
        $mobil = Car::create([
            'nama_mobil' => 'Car Test',
            'mesin' => 'Mesin Test',
            'kapasitas_penumpang' => 4,
            'tipe' => 'Tipe Test',
            'tanggal_terjual' => null,
            'kendaraan_id' => 1,
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Menyertakan token dalam header permintaan
        ])->get('/api/auth/detail-mobil/' . $mobil->id);

        $response->assertStatus(200);
    }

    public function test_detailMotor()
    {
        $token = $this->getToken();

        // Membuat data motor
        $motor = Motor::create([
            'nama_motor' => 'motor test',
            'mesin' => 'mesin test',
            'tipe_suspensi' => 'test',
            'tipe_transmisi' => 'test',
            'id_kendaraan' => 1
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Menyertakan token dalam header permintaan
        ])->get('/api/auth/detail-motor/' . $motor->id);

        $response->assertStatus(200);
    }

    public function test_tambahKendaraan()
    {
        $token = $this->getToken();

        $kendaraanData = [
            'tahun_keluaran' => '02-02-2023',
            'warna' => 'black',
            'harga' => 100000000
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Menyertakan token dalam header permintaan
        ])->post('/api/auth/kendaraan/', $kendaraanData);

        $response->assertStatus(201);
    }

    public function test_tambahMotor()
    {
        $token = $this->getToken();

        $motorData = [
            'nama_motor' => 'motor test',
            'mesin' => 'mesin test',
            'tipe_suspensi' => 'test',
            'tipe_transmisi' => 'test',
            'id_kendaraan' => '1'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Menyertakan token dalam header permintaan
        ])->post('/api/auth/motor/', $motorData);

        $response->assertStatus(201);
    }

    public function test_tambahCar()
    {
        $token = $this->getToken();

        $mobilData = [
            'nama_mobil' => 'test',
            'mesin' => 'test',
            'kapasitas_penumpang' => 8,
            'tipe' => 'test',
            'id_kendaraan' => '1'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Menyertakan token dalam header permintaan
        ])->post('/api/auth/mobil/', $mobilData);

        $response->assertStatus(201);
    }

    public function test_updateMotor()
    {
        $token = $this->getToken();

        // Membuat data motor
        $motor = Motor::create([
            'nama_motor' => 'motor test',
            'mesin' => 'mesin test',
            'tipe_suspensi' => 'test',
            'tipe_transmisi' => 'test',
            'id_kendaraan' => 1
        ]);
        $motorData = [
            'nama_motor' => 'motor test',
            'mesin' => 'mesin test',
            'tipe_suspensi' => 'test',
            'tipe_transmisi' => 'test',
            'id_kendaraan' => '1'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Menyertakan token dalam header permintaan
        ])->put('/api/auth/update-motor/' . $motor->id, $motorData);

        $response->assertStatus(200);
    }

    public function test_updateCar()
    {
        $token = $this->getToken();

        // Membuat data mobil
        $mobil = Car::create([
            'nama_motor' => 'motor test',
            'mesin' => 'mesin test',
            'tipe_suspensi' => 'test',
            'tipe_transmisi' => 'test',
            'id_kendaraan' => 1
        ]);
        $mobilData = [
            'nama_motor' => 'motor test',
            'mesin' => 'mesin test',
            'tipe_suspensi' => 'test',
            'tipe_transmisi' => 'test',
            'id_kendaraan' => 2
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Menyertakan token dalam header permintaan
        ])->put('/api/auth/update-mobil/' . $mobil->id, $mobilData);

        $response->assertStatus(200);
    }

    public function test_deleteCar()
    {
        $token = $this->getToken();

        // Membuat data mobil
        $mobil = Car::create([
            'nama_mobil' => 'Car Test',
            'mesin' => 'Mesin Test',
            'kapasitas_penumpang' => 4,
            'tipe' => 'Tipe Test',
            'kendaraan_id' => 1,
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Menyertakan token dalam header permintaan
        ])->delete('/api/auth/delete-mobil/' . $mobil->id);

        $response->assertStatus(200);
    }

    public function test_deleteMotor()
    {
        $token = $this->getToken();

        // Membuat data motor
        $motor = Motor::create([
            'nama_motor' => 'motor test',
            'mesin' => 'mesin test',
            'tipe_suspensi' => 'test',
            'tipe_transmisi' => 'test',
            'id_kendaraan' => 1
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Menyertakan token dalam header permintaan
        ])->delete('/api/auth/delete-motor/' . $motor->id);

        $response->assertStatus(200);
    }

    public function test_beliCar()
    {
        $token = $this->getToken();

        // Membuat data mobil
        $mobil = Car::create([
            'nama_mobil' => 'Car Test',
            'mesin' => 'Mesin Test',
            'kapasitas_penumpang' => 4,
            'tipe' => 'Tipe Test',
            'kendaraan_id' => 1,
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Menyertakan token dalam header permintaan
        ])->put('/api/auth/beli-mobil/' . $mobil->id);

        $response->assertStatus(200);
    }

    public function test_beliMotor()
    {
        $token = $this->getToken();

        // Membuat data motor
        $motor = Motor::create([
            'nama_motor' => 'motor test',
            'mesin' => 'mesin test',
            'tipe_suspensi' => 'test',
            'tipe_transmisi' => 'test',
            'id_kendaraan' => 1
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token, // Menyertakan token dalam header permintaan
        ])->put('/api/auth/beli-motor/' . $motor->id);

        $response->assertStatus(200);
    }


    private function getToken()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => bcrypt('test12345') // Gunakan bcrypt untuk mengenkripsi password
        ]);

        $loginData = [
            'email' => 'test@test.com',
            'password' => 'test12345'
        ];

        $response = $this->json('POST', '/api/auth/login', $loginData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in'
            ]);

        return $response->json('access_token');
    }


    

    public function test_register()
    {
        $registerData = [
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => 'test12345'
        ];

        $response = $this->json('POST', '/api/auth/register', $registerData);

        $response->assertStatus(200);
    }

    public function test_login()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => bcrypt('test12345') // Gunakan bcrypt untuk mengenkripsi password
        ]);

        $loginData = [
            'email' => 'test@test.com',
            'password' => 'test12345'
        ];

        $response = $this->json('POST', '/api/auth/login', $loginData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in'
            ]);
    }
}
