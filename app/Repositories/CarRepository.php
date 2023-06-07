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
        return $this->car->with('vehicle')->get()->map(function ($item) {
            $item->_id = $item->vehicle->_id;
            unset($item->vehicle->_id);
            return $item;
        });
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
        return $this->car->with('vehicle')->where('status', 'sold')->get()->map(function ($item) {
            $item->_id = $item->vehicle->_id;
            unset($item->vehicle->_id);
            unset($item->vehicle_id);
            return $item;
        });
    }
    // sales functions end

    /**
     * !Sales functions
     */
    // sales functions start
    public function stock()
    {
        return $this->car->with('vehicle')->where('status', 'ready')->get()->map(function ($item) {
            $item->_id = $item->vehicle->_id;
            unset($item->vehicle->_id);
            unset($item->vehicle_id);
            return $item;
        });
    }
    // sales functions end
}
