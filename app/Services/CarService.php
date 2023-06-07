<?php

namespace App\Services;

use Illuminate\Http\Request;
use InvalidArgumentException;
use Illuminate\Support\Carbon;
use App\Repositories\CarRepository;
use App\Repositories\VehicleRepository;
use Illuminate\Support\Facades\Validator;

class CarService extends VehicleService
{
    public function __construct(VehicleRepository $vehicleRepository, private CarRepository $carRepository)
    {
        parent::__construct($vehicleRepository);
    }

    public function validator(array $data)
    {
        $data = parent::validator($data);

        $validator = Validator::make($data, [
            'passenger_capacity' => 'required|string',
            'type' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $data;
    }

    public function getAllCars()
    {
        return $this->carRepository->getAllCars();
    }

    public function sales()
    {
        return $this->carRepository->sales();
    }

    public function stock()
    {
        return $this->carRepository->sales();
    }
}
