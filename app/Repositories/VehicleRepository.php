<?php

namespace App\Repositories;

use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

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
    public function getAllVehicles()
    {
        return $this->vehicle->with(['motor', 'car'])
            ->get()
            ->filter(fn ($item) => $item->car || $item->motor)
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'manufacture_year' => $item->manufacture_year,
                    'color' => $item->color,
                    'price' => $item->price,
                    ...($item->car ?? $item->motor ?? collect())
                        ->toArray(),
                    'is' => 'a ' . ($item->car ? 'car' : 'motor')
                ];
            })->values();
    }
    // List functions end

    /**
     * !Sales functions
     */
    // sales functions start
    public function sales()
    {
        return $this->vehicle->where('status', 'sold')->get();
    }
    // sales functions end

    /**
     * !Sales functions
     */
    // sales functions start
    public function stock()
    {
        return $this->vehicle->where('status', 'ready')->get();
    }
    // sales functions end


    /**
     * !Create functions
     */
    // create functions start
    public function store(array $data)
    {
        return $this->vehicle->create($data);
    }
    // create functions end


    /**
     * !Detail functions
     */
    // detail functions start

    public function show($id)
    {
        return $this->vehicle->find($id);
    }
    // detail functions end

    /**
     * !Update functions
     */

    public function update(array $data, $id)
    {
        $vehicle = $this->vehicle->find($id);
        return $vehicle->update($data);
    }
    // update functions end

    /**
     * !Delete functions
     */

    public function delete($id)
    {
        $vehicle = $this->vehicle->find($id);
        return $vehicle->delete();
    }
    // Delete functions end

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
