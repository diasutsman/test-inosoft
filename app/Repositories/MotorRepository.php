<?php

namespace App\Repositories;

use App\Models\Motor;

class MotorRepository
{
    private Motor $motor;

    public function __construct(Motor $motor)
    {
        $this->motor = $motor;
    }

    public function store($data)
    {
        return $this->motor->create($data);
    }

    /**
     * !List functions
     */
    // List functions start
    public function getAllMotors()
    {
        return $this->motor->with('vehicle')->get()->map(function ($item) {
            $item->_id = $item->vehicle->_id;
            unset($item->vehicle->_id);
            unset($item->vehicle_id);
            return $item;
        });
    }
    // List functions end

    /**
     * !Sales functions
     */
    // sales functions start
    public function sales()
    {
        return $this->motor->with('vehicle')->where('status', 'sold')->get()->map(function ($item) {
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
        return $this->motor->with('vehicle')->where('status', 'ready')->get()->map(function ($item) {
            $item->_id = $item->vehicle->_id;
            unset($item->vehicle->_id);
            unset($item->vehicle_id);
            return $item;
        });
    }
    // sales functions end
}
