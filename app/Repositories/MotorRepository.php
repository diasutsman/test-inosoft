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

    /**
     * !List functions
     */
    // List functions start
    public function getAllMotors()
    {
        return $this->motor->select('_id', 'name')->get();
    }
    // List functions end

    /**
     * !Sales functions
     */
    // sales functions start
    public function sales()
    {
        return $this->motor->where('status', 'sold')->get();
    }
    // sales functions end

    /**
     * !Sales functions
     */
    // sales functions start
    public function stock()
    {
        return $this->motor->where('status', 'ready')->get();
    }
    // sales functions end
}
