<?php

namespace App\Repositories;

use App\Models\Vehicle;
use App\Models\Car;
use App\Models\Motor;

class VehicleSalesRepository
{
    private $vehicle;
    private $car;
    private $motor;

    public function __construct(Vehicle $vehicle, Car $car, Motor $motor)
    {
        $this->vehicle = $vehicle;
        $this->car = $car;
        $this->motor = $motor;
    }

    /**
     * !List functions
     */
    // List functions start
    public function listAllVehicle()
    {
        return $this->vehicle->get();
    }

    public function listCarVehicles()
    {
        return $this->car->select('_id', 'name')->get();
    }

    public function listMotorVehicles()
    {
        return $this->motor->select('_id', 'name')->get();
    }
    // List functions end

    /**
     * !Sales functions
     */
    // sales functions start
    public function vehicleSales($id, array $data, $model)
    {
        $salesData = $model->find($id);

        if ($salesData && !$salesData->status) {
            $salesData->status = $data['status'];
            $salesData->sold_at = $data['date'];
            $salesData->save();

            return $salesData;
        }

        return 'vehicle not found';
    }

    public function carSales($id, array $data)
    {
        return $this->vehicleSales($id, $data, $this->car);
    }

    public function motorSales($id, array $data)
    {
        return $this->vehicleSales($id, $data, $this->motor);
    }
    // sales functions end

    /**
     * !Report functions
     */
    // report functions start
    public function salesReport($model)
    {
        return $model->where('status', 'sold')->get();
    }

    public function carSalesReport()
    {
        return $this->salesReport($this->car);
    }

    public function motorSalesReport()
    {
        return $this->salesReport($this->motor);
    }
    // report functions end


    /**
     * !Create functions
     */
    // create functions start
    public function createData($model, array $data)
    {
        return $model->create($data);
    }

    public function addVehicle(array $data)
    {
        return $this->createData($this->vehicle, $data);
    }

    public function addCar(array $data)
    {
        return $this->createData($this->car, $data);
    }

    public function addMotor(array $data)
    {
        return $this->createData($this->motor, $data);
    }
    // create functions end


    /**
     * !Detail functions
     */
    // detail functions start
    public function getDetail($model, $id)
    {
        return $model->find($id);
    }

    public function vehicleDetail($id)
    {
        return $this->getDetail($this->vehicle, $id);
    }

    public function carDetail($id)
    {
        return $this->getDetail($this->car, $id);
    }

    public function motorDetail($id)
    {
        return $this->getDetail($this->motor, $id);
    }
    // detail functions end

    /**
     * !Update functions
     */
    // update functions start
    public function updateData($model, array $data, $id)
    {
        $dataModel = $model->find($id);
        $dataModel->update($data);

        return $dataModel;
    }

    public function updateVehicle(array $data, $id)
    {
        return $this->updateData($this->vehicle, $data, $id);
    }

    public function updateCar(array $data, $id)
    {
        return $this->updateData($this->car, $data, $id);
    }

    public function updateMotor(array $data, $id)
    {
        return $this->updateData($this->motor, $data, $id);
    }
    // update functions end

    /**
     * !Delete functions
     */
    // delete functions start
    public function deleteData($model, $id)
    {
        $dataModel = $model->find($id);

        if ($dataModel) {
            $dataModel->delete();
            return 'successfully deleted data';
        }

        return 'data not found!!';
    }

    public function deleteCar($id)
    {
        return $this->deleteData($this->car, $id);
    }

    public function deleteMotor($id)
    {
        return $this->deleteData($this->motor, $id);
    }
    // delete functions end
}
