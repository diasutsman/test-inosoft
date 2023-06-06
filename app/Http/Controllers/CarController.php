<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Helpers\FormatApi;
use App\Services\CarService;
use Illuminate\Http\Request;

class CarController extends Controller
{
    private $carService;
    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->formatApiResponse($this->carService->listCarVehicles(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mobil' => 'required|string|max:15',
            'mesin' => 'required|string|max:10',
            'kapasitas_penumpang' => 'required|numeric|max:10',
            'tipe' => 'required|string|max:10',
            'id_kendaraan' => 'required|string'
        ]);

        return $this->formatApiResponse($this->carService->addCar($request), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->formatApiResponse($this->carService->carDetail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        return $this->formatApiResponse($this->carService->updateCar($request, $car), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->formatApiResponse($this->carService->deleteCar($id), 200);
    }

    public function report(Car $car)
    {
        return $this->formatApiResponse($this->carService->report(), 200);
    }

    public function buy(Request $request, Car $car)
    {
        return $this->formatApiResponse($this->carService->buy($request, $car), 200);
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
