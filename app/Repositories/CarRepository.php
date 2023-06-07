<?php

namespace App\Repositories;

use App\Models\Car;
use Illuminate\Support\Facades\Log;

class CarRepository
{
    private Car $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    /**
     * !List functions
     */
    // List functions start
    public function getAllCars()
    {
        return $this->car->with('vehicle')->get();
    }
    // List functions end

    public function store($data)
    {
        return $this->car->create($data);
    }

    /**
     * !Sales functions
     */
    // sales functions start
    public function sales()
    {
        return $this->car->with('vehicle')->where('status', 'sold')->get();
    }
    // sales functions end

    /**
     * !Sales functions
     */
    // sales functions start
    public function stock()
    {
        return $this->car->with('vehicle')->where('status', 'ready')->get();
    }
    // sales functions end
}
