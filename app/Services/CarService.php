<?php

namespace App\Services;

use App\Repositories\CarRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class CarService
{
    private $carRepository;
    private $rules = [
        'name' => 'required|string',
        'machine' => 'required|string',
        'passenger_capacity' => 'required|integer',
        'type' => 'required|string',
        'vehicle_id' => 'required|exists:vehicles,_id'
    ];

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function listCarVehicles()
    {
        return $this->carRepository->listCarVehicles();
    }

    public function addCar(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return null;
        }

        $vehicleData = $validator->validated();
        return $this->carRepository->addCar($vehicleData);
    }

    public function carDetail($id)
    {
        return $this->carRepository->carDetail($id);
    }

    public function updateCar(Request $request, string $id) // this function is not used, only for complements
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return null;
        }

        $carData = $validator->validated();
        return $this->carRepository->updateCar($carData, $id);
    }

    public function deleteCar($id)
    {
        return $this->carRepository->deleteCar($id);
    }

    public function report()
    {
        return $this->carRepository->report();
    }

    public function buy($id)
    {
        $carSalesData = $this->generateSalesData();
        return $this->carRepository->buy($id, $carSalesData);
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
