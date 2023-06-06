<?php

namespace App\Repositories;

use App\Models\Car;

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
    public function listCarVehicles()
    {
        return $this->car->select('_id', 'name')->get();
    }
    // List functions end

    /**
     * !Sales functions
     */
    // sales functions start

    public function buy(Car $car, array $data)
    {
        if (!$car || $car->status === 'sold') {
            return 'vehicle not found';
        }
        $car->status = $data['status'];
        $car->sold_at = $data['date'];
        $car->save();

        return $car;
    }
    // sales functions end

    /**
     * !Report functions
     */
    // report functions start
    public function report()
    {
        return $this->car->where('status', 'sold')->get();
    }
    // report functions end


    /**
     * !Create functions
     */
    // create functions start
    public function addCar(array $data)
    {
        return $this->car->create($data);
    }
    // create functions end


    /**
     * !Detail functions
     */
    // detail functions start
    public function carDetail($id)
    {
        return $this->car->find($id);
    }
    // detail functions end

    /**
     * !Update functions
     */

    public function updateCar(array $data, string $id)
    {
        $car = $this->car->find($id);
        $car->update($data);
        return $car;
    }
    // update functions end

    /**
     * !Delete functions
     */
    // delete functions start
    public function deleteCar($id)
    {
        $dataModel = $this->car->find($id);

        if (!$dataModel) {
            return 'data not found!!';
        }
        $dataModel->delete();
        return 'successfully deleted data';
    }
    // delete functions end
}
