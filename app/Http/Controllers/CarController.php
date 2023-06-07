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
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->formatApiResponse($this->carService->updateCar($request, $id), 200);
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

    public function report()
    {
        return $this->formatApiResponse($this->carService->report(), 200);
    }

    public function buy($id)
    {
        return $this->formatApiResponse($this->carService->buy($id), 200);
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
