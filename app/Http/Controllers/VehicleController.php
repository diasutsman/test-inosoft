<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Helpers\FormatApi;
use App\Services\CarService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\MotorService;
use App\Services\VehicleService;

class VehicleController extends Controller
{
    public function __construct(
        private VehicleService $vehicleService,
        private CarService $carService,
        private MotorService $motorService
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = $this->vehicleService->getAllVehicles();
        if ($all->count() <= 0) {
            return response()->json([
                'success' => false,
                'data' => $all
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'data' => $all
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->tipe_kendaraan == 'mobil') {
            $validatedData = $this->carService->validator($request->all());
        } else if ($request->tipe_kendaraan == 'motor') {
            $validatedData = $this->motorService->validator($request->all());
        } else {
            return response()->json(['error' => 'Invalid vehicle type'], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'success' => true,
            'data' => $this->vehicleService->store($validatedData)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->formatApiResponse($this->vehicleService->updateVehicle($request, $id), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }

    public function sales()
    {
        $sales = $this->vehicleService->sales();
        if ($sales->count() <= 0) {
            return response()->json([
                'success' => false,
                'amount_sold' => 'No sales available',
                'data' => $sales
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'amount_sold' => $sales->count(),
            'data' => $sales
        ], Response::HTTP_OK);
    }

    public function stock()
    {
        $stock = $this->vehicleService->stock();
        if ($stock->count() <= 0) {
            return response()->json([
                'success' => false,
                'amount_sold' => 'No stock available',
                'data' => $stock
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'amount_sold' => $stock->count(),
            'data' => $stock
        ], Response::HTTP_OK);
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
