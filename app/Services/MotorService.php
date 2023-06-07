<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Services\VehicleService;
use Illuminate\Support\Facades\Log;
use App\Repositories\MotorRepository;
use App\Repositories\VehicleRepository;
use Illuminate\Support\Facades\Validator;

class MotorService extends VehicleService
{
    public function __construct(VehicleRepository $vehicleRepository, private MotorRepository $motorRepository)
    {
        parent::__construct($vehicleRepository);
    }

    public function validator(array $data)
    {
        $data = parent::validator($data);

        $validator = Validator::make($data, [
            'suspension_type' => 'required|string',
            'transmission_type' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $data;
    }

    public function store($data)
    {
        return $this->motorRepository->store($data);
    }

    public function getAllMotors()
    {
        return $this->motorRepository->getAllMotors();
    }

    public function sales()
    {
        return $this->motorRepository->sales();
    }

    public function stock()
    {
        return $this->motorRepository->stock();
    }
}
