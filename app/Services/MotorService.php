<?php

namespace App\Services;

use App\Models\Motor;
use App\Repositories\MotorRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Motorbon;

class MotorService
{
    private $motorRepository;

    public function __construct(MotorRepository $motorRepository)
    {
        $this->motorRepository = $motorRepository;
    }

    public function listMotorVehicles()
    {
        return $this->motorRepository->listMotorVehicles();
    }

    public function addMotor(Request $request)
    {
        $motorData = $request->only(['year', 'color', 'price']);
        return $this->motorRepository->addMotor($motorData);
    }

    public function motorDetail($id)
    {
        return $this->motorRepository->motorDetail($id);
    }

    public function updateMotor(Request $request, Motor $motor) // this function is not used, only for complements
    {
        $motorData = $request->only(['year', 'color', 'price']);
        return $this->motorRepository->updateMotor($motorData, $motor);
    }

    public function deleteMotor($id)
    {
        if (!$this->motorDetail($id)) { // check if motor exist
            return 'motor not found';
        }

        return $this->motorRepository->deleteMotor($id);
    }

    public function report()
    {
        return $this->motorRepository->report();
    }

    public function buy($id)
    {
        $motorSalesData = $this->generateSalesData();
        return $this->motorRepository->buy($id, $motorSalesData);
    }

    private function generateSalesData()
    {
        $now = Carbon::now('Asia/Jakarta');
        $formattedDate = $now->format('d/m/Y');

        return [
            'status' => 'sold',
            'date' => $formattedDate,
        ];
    }
}
