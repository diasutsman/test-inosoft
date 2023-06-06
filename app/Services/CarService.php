<?php

namespace App\Services;

use App\Models\Vehicle;
use App\Repositories\CarRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Repositories\VehicleRepository;
use App\Repositories\VehicleSalesRepository;

class CarService
{
    private $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function listCarVehicles()
    {
        return $this->vehicleSalesRepository->listCarVehicles();
    }

    public function addVehicle(Request $request)
    {
        $vehicleData = $request->only(['year', 'color', 'price']);
        return $this->carRepository->addVehicle($vehicleData);
    }

    public function vehicleDetail($id)
    {
        return $this->carRepository->vehicleDetail($id);
    }

    public function updateVehicle(Request $request, Vehicle $vehicle) // this function is not used, only for complements
    {
        $vehicleData = $request->only(['year', 'color', 'price']);
        return $this->carRepository->updateVehicle($vehicleData, $vehicle);
    }
}
