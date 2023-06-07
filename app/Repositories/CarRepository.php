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
        return $this->car->all();
    }
    // List functions end

    /**
     * !Sales functions
     */
    // sales functions start
    public function sales()
    {
        return $this->car->where('status', 'sold')->get();
    }
    // sales functions end

    /**
     * !Sales functions
     */
    // sales functions start
    public function stock()
    {
        return $this->car->where('status', 'ready')->get();
    }
    // sales functions end
}
