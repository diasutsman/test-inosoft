<?php

namespace App\Services;

use App\Repositories\CarRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class CarService
{
    private $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
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
