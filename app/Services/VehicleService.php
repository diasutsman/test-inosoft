<?php

namespace App\Services;

use App\Models\Vehicle;
use App\Helpers\FormatApi;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Repositories\VehicleRepository;
use Illuminate\Support\Facades\Validator;

class VehicleService
{
    private $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function validator(array $data)
    {
        $validator = Validator::make($data, [
            'year' => 'required|size:4',
            'color' => 'required|string',
            'price' => 'required|numeric',
            'vehicle_type' => 'required|string',
            'status' => ['required', Rule::in(['ready', 'sold'])],
            'machine' => 'required',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $data;
    }

    public function getAllVehicles()
    {
        return $this->vehicleRepository->getAllVehicles();
    }

    public function store($data)
    {
        return $this->vehicleRepository->store($data);
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

    public function sales()
    {
        return $this->vehicleRepository->sales();
    }

    public function stock()
    {
        return $this->vehicleRepository->stock();
    }
}
