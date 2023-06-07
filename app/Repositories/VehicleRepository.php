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

    private function filterByStatus($collection, $status = null)
    {
        return $collection->filter(fn ($item) => ($item->car ?? $item->motor)?->status === $status)->values();
    }

    /**
     * !List functions
     */
    // List functions start
    public function getAllVehicles()
    {
        return $this->vehicle->with(['car', 'motor'])
            ->get();
    }
    // List functions end

    /**
     * !Sales functions
     */
    // sales functions start
    public function sales()
    {
        return $this->filterByStatus($this->vehicle->with(['car', 'motor'])->get(), 'sold');
    }
    // sales functions end

    /**
     * !Sales functions
     */
    // sales functions start
    public function stock()
    {
        return $this->filterByStatus($this->vehicle->with(['car', 'motor'])->get(), 'ready');
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
}
