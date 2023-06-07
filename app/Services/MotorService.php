<?php

namespace App\Services;

use App\Repositories\MotorRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MotorService
{
    private $motorRepository;

    private $rules = [
        'name' => 'required',
        'machine' => 'required',
        'suspension_type' => 'required',
        'transmission_type' => 'required',
        'vehicle_id' => 'required|exists:vehicles,_id'
    ];

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
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return null;
        }

        $motorData = $request->only(['manufacture_year', 'color', 'price']);
        return $this->motorRepository->addMotor($motorData);
    }

    public function motorDetail($id)
    {
        return $this->motorRepository->motorDetail($id);
    }

    public function updateMotor(Request $request, string $id) // this function is not used, only for complements
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return null;
        }
        
        $motorData = $validator->validated();
        return $this->motorRepository->updateMotor($motorData, $id);
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

    public function buy(string $id)
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
