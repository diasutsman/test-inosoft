<?php

namespace App\Repositories;

use App\Models\Vehicle;

class VehicleRepository
{
    private Vehicle $vehicle;

    public function __construct(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * !List functions
     */
    // List functions start
    public function listAllVehicle()
    {
        return $this->vehicle->get();
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
    // sales functions end

    /**
     * !Report functions
     */
    // report functions start
    public function salesReport($model)
    {
        return $model->where('status', 'sold')->get();
    }
    // report functions end


    /**
     * !Create functions
     */
    // create functions start
    public function addVehicle(array $data)
    {
        return $this->vehicle->create($data);
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
    // detail functions end

    /**
     * !Update functions
     */

    public function updateVehicle(array $data, $id)
    {
        $vehicle = $this->vehicle->find($id);
        $vehicle->update($data);
        return $vehicle;
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
    // delete functions end
}
