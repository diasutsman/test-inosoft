<?php

namespace App\Services;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Repositories\VehicleRepository;
use App\Repositories\VehicleSalesRepository;

class VehicleService
{
    private $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function listAllVehicle()
    {
        return $this->vehicleRepository->listAllVehicle();
    }

    public function addVehicle(Request $request)
    {
        $vehicleData = $request->only(['year', 'color', 'price']);
        return $this->vehicleRepository->addVehicle($vehicleData);
    }

    public function vehicleDetail($id)
    {
        return $this->vehicleRepository->vehicleDetail($id);
    }

    public function updateVehicle(Request $request, Vehicle $vehicle) // this function is not used, only for complements
    {
        $vehicleData = $request->only(['year', 'color', 'price']);
        return $this->vehicleRepository->updateVehicle($vehicleData, $vehicle);
    }
}
