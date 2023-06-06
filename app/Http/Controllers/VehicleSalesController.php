<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FormatApi;
use App\Services\VehicleSalesService;

class VehicleSalesController extends Controller
{
    private $vehicleSalesService;

    public function __construct(VehicleSalesService $vehicleSalesService)
    {
        $this->vehicleSalesService = $vehicleSalesService;
    }

    public function listAllVehicle()
    {
        return $this->formatApiResponse($this->vehicleSalesService->listAllVehicle(), 200);
    }

    public function listCarVehicles()
    {
        return $this->formatApiResponse($this->vehicleSalesService->listCarVehicles(), 200);
    }

    public function listKendaraanMotor()
    {
        return $this->formatApiResponse($this->vehicleSalesService->listMotorVehicles(), 200);
    }

    public function carSales($id)
    {
        return $this->formatApiResponse($this->vehicleSalesService->carSales($id), 200);
    }

    public function motorSales($id)
    {
        return $this->formatApiResponse($this->vehicleSalesService->motorSales($id), 200);
    }

    public function carSalesReport()
    {
        return $this->formatApiResponse($this->vehicleSalesService->carSalesReport(), 200);
    }

    public function motorSalesReport()
    {
        return $this->formatApiResponse($this->vehicleSalesService->motorSalesReport(), 200);
    }

    public function addVehicle(Request $request)
    {
        $validatedData = $request->validate([
            'year' => 'required|date',
            'color' => 'required|string|max:10',
            'price' => 'required|numeric|max:500000000'
        ]);

        return $this->formatApiResponse($this->vehicleSalesService->addVehicle($request), 201);
    }

    public function addCar(Request $request)
    {
        $validatedData = $request->validate([
            'nama_mobil' => 'required|string|max:15',
            'mesin' => 'required|string|max:10',
            'kapasitas_penumpang' => 'required|numeric|max:10',
            'tipe' => 'required|string|max:10',
            'id_kendaraan' => 'required|string'
        ]);

        return $this->formatApiResponse($this->vehicleSalesService->addCar($request), 201);
    }

    public function addMotor(Request $request)
    {
        $validatedData = $request->validate([
            'nama_motor' => 'required|string|max:15',
            'mesin' => 'required|string|max:10',
            'tipe_suspensi' => 'required|string|max:20',
            'tipe_transmisi' => 'required|string|max:10',
            'id_kendaraan' => 'required|string'
        ]);

        return $this->formatApiResponse($this->vehicleSalesService->addMotor($request), 201);
    }

    public function vehicleDetail($id)
    {
        return $this->formatApiResponse($this->vehicleSalesService->vehicleDetail($id), 200);
    }
    public function carDetail($id)
    {
        return $this->formatApiResponse($this->vehicleSalesService->carDetail($id), 200);
    }
    public function motorDetail($id)
    {
        return $this->formatApiResponse($this->vehicleSalesService->motorDetail($id), 200);
    }

    public function updateVehicle(Request $request, $id)
    {
        return $this->formatApiResponse($this->vehicleSalesService->updateVehicle($request, $id), 200);
    }

    public function updateCar(Request $request, $id)
    {
        return $this->formatApiResponse($this->vehicleSalesService->updateCar($request, $id), 200);
    }

    public function updateMotor(Request $request, $id)
    {
        return $this->formatApiResponse($this->vehicleSalesService->updateMotor($request, $id), 200);
    }

    public function deleteCar($id)
    {
        return $this->formatApiResponse($this->vehicleSalesService->deleteCar($id), 200);
    }

    public function deleteMotor($id)
    {
        return $this->formatApiResponse($this->vehicleSalesService->deleteMotor($id), 200);
    }


    // format api dengan dinamis data dan status code
    private function formatApiResponse($data, $statusCode)
    {
        if ($data) {
            return FormatApi::formatResponse($statusCode, 'Success', $data);
        } else {
            return FormatApi::formatResponse(400, 'Gagal');
        }
    }
}
