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
    public function listMotorVehicles()
    {
        return $this->motor->select('_id', 'name')->get();
    }
    // List functions end

    /**
     * !Sales functions
     */
    // sales functions start

    public function buy(string $id, array $data)
    {
        $motor = $this->motor->find($id);
        if (!$motor || $motor->status === 'sold') {
            return 'motor not found';
        }
        $motor->status = $data['status'];
        $motor->sold_at = $data['date'];
        $motor->save();

        return $motor;
    }
    // sales functions end

    /**
     * !Report functions
     */
    // report functions start
    public function report()
    {
        return $this->motor->where('status', 'sold')->get();
    }
    // report functions end


    /**
     * !Create functions
     */
    // create functions start
    public function addMotor(array $data)
    {
        return $this->motor->create($data);
    }
    // create functions end


    /**
     * !Detail functions
     */
    // detail functions start
    public function motorDetail($id)
    {
        return $this->motor->find($id);
    }
    // detail functions end

    /**
     * !Update functions
     */

    public function updateMotor(array $data, string $id)
    {
        $motor = $this->motor->find($id);
        $motor->update($data);
        return $motor;
    }
    // update functions end

    /**
     * !Delete functions
     */
    // delete functions start
    public function deleteMotor($id)
    {
        $dataModel = $this->motor->find($id);

        if (!$dataModel) {
            return 'data not found!!';
        }
        $dataModel->delete();
        return 'successfully deleted data';
    }
    // delete functions end
}
