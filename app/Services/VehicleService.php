<?php

namespace App\Services;

use App\Helpers\FormatApi;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Repositories\VehicleRepository;

use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'manufacture_year' => 'required|integer',
            'color' => 'required|string',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return null;
        }

        $vehicleData = $validator->validated();
        return $this->vehicleRepository->addVehicle($vehicleData);
    }

    public function vehicleDetail($id)
    {
        return $this->vehicleRepository->vehicleDetail($id);
    }

    public function updateVehicle(Request $request, $id) // this function is not used, only for complements
    {
        $vehicleData = $request->only(['manufacture_year', 'color', 'price']);
        return $this->vehicleRepository->updateVehicle($vehicleData, $id);
    }
}
