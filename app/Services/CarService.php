<?php

namespace App\Services;

use App\Repositories\CarRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CarService
{
    private $carRepository;

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
        $vehicleData = $request->only(['year', 'color', 'price']);
        return $this->carRepository->addCar($vehicleData);
    }

    public function carDetail($id)
    {
        return $this->carRepository->carDetail($id);
    }

    public function updateCar(Request $request, string $id) // this function is not used, only for complements
    {
        $vehicleData = $request->only(['year', 'color', 'price']);
        return $this->carRepository->updateCar($vehicleData, $id);
    }

    public function deleteCar($id)
    {
        if (!$this->carDetail($id)) { // check if car exist
            return 'car not found';
        }

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
