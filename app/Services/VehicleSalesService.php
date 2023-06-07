<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Repositories\VehicleSalesRepository;

class VehicleSalesService
{
    private $vehicleSalesRepository;

    public function __construct(VehicleSalesRepository $vehicleSalesRepository)
    {
        $this->vehicleSalesRepository = $vehicleSalesRepository;
    }

    public function listAllVehicle()
    {
        return $this->vehicleSalesRepository->listAllVehicle();
    }

    public function listCarVehicles()
    {
        return $this->vehicleSalesRepository->listCarVehicles();
    }

    public function listMotorVehicles()
    {
        return $this->vehicleSalesRepository->listMotorVehicles();
    }

    public function carSales($id)
    {
        $carSalesData = $this->generateSalesData();
        return $this->vehicleSalesRepository->carSales($id, $carSalesData);
    }

    public function motorSales($id)
    {
        $motorSalesData = $this->generateSalesData();
        return $this->vehicleSalesRepository->motorSales($id, $motorSalesData);
    }

    public function carSalesReport()
    {
        return $this->vehicleSalesRepository->carSalesReport();
    }

    public function motorSalesReport()
    {
        return $this->vehicleSalesRepository->motorSalesReport();
    }

    public function addVehicle(Request $request)
    {
        $vehicleData = $request->only(['manufacture_year', 'color', 'price']);
        return $this->vehicleSalesRepository->addVehicle($vehicleData);
    }

    public function addCar(Request $request)
    {
        if (!$this->vehicleDetail($request->vehicle_id)) { // check if vehicle id is valid
            return 'invalid vehicle';
        }

        $dataMobil = $request->only([
            'name', 'machine', 'passenger_capacity', 'type', 'vehicle_id', 'status' => 'ready'
        ]);
        return $this->vehicleSalesRepository->addCar($dataMobil);
    }

    public function addMotor(Request $request)
    {
        if (!$this->vehicleDetail($request->vehicle_id)) { // check if vehicle id is valid
            return 'invalid vehicle';
        }
        $dataMotor = $request->only(['name', 'machine', 'suspension_type', 'transmission_type', 'vehicle_id']);
        return $this->vehicleSalesRepository->addMotor($dataMotor);
    }

    public function vehicleDetail($id)
    {
        return $this->vehicleSalesRepository->vehicleDetail($id);
    }

    public function carDetail($id)
    {
        return $this->vehicleSalesRepository->carDetail($id);
    }

    public function motorDetail($id)
    {
        return $this->vehicleSalesRepository->motorDetail($id);
    }

    public function updateVehicle(Request $request, $id) // this function is not used, only for complements
    {
        $vehicleData = $request->only(['manufacture_year', 'color', 'price']);
        return $this->vehicleSalesRepository->updateVehicle($vehicleData, $id);
    }

    public function updateCar(Request $request, $id)
    {
        $dataMobil = $request->only(['name', 'machine', 'passenger_capacity', 'type', 'vehicle_id']);

        $dataMobilDetail = $this->carDetail($id);
        if (!$dataMobilDetail) { // check if car exist
            return 'car not found';
        }

        if ($dataMobilDetail->status === 'sold') { // check if car is sold
            return 'cannot update sold car';
        }

        if (!$this->vehicleDetail($request->vehicle_id)) { // check if vehicle id is valid
            return 'invalid vehicle';
        }

        return $this->vehicleSalesRepository->updateCar($dataMobil, $id);
    }

    public function updateMotor(Request $request, $id)
    {
        $dataMotor = $request->only(['name', 'machine', 'suspension_type', 'transmission_type', 'vehicle_id']);

        $dataMotorDetail = $this->motorDetail($id);

        if ($dataMotorDetail) { // check if motor exist
            return 'motor not found';
        }

        if ($dataMotorDetail->status === 'sold') { // check if motor is sold
            return 'cannot update sold motor';
        }

        if (!$this->vehicleDetail($request->vehicle_id)) { // check if vehicle id is valid
            return 'invalid vehicle';
        }

        return $this->vehicleSalesRepository->updateMotor($dataMotor, $id);
    }

    public function deleteCar($id)
    {
        if (!$this->carDetail($id)) { // check if car exist
            return 'car not found';
        }

        return $this->vehicleSalesRepository->deleteCar($id);
    }

    public function deleteMotor($id)
    {
        if (!$this->motorDetail($id)) { //periksa apakah motor ada
            return 'motor not found';
        }
        return $this->vehicleSalesRepository->deleteMotor($id);
    }

    private function generateSalesData()
    {
        $now = Carbon::now('Asia/Jakarta');
        $formattedDate = $now->format('d/m/Y');

        return [
            'status' => 'terjual',
            'date' => $formattedDate,
        ];
    }
}
