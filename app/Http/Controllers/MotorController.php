<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Helpers\FormatApi;
use Illuminate\Http\Request;
use App\Services\MotorService;

class MotorController extends Controller
{
    private $motorService;
    public function __construct(MotorService $motorService)
    {
        $this->motorService = $motorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->formatApiResponse($this->motorService->listMotorVehicles(), 200);
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

        return $this->formatApiResponse($this->motorService->addMotor($request), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->formatApiResponse($this->motorService->motorDetail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Motor  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Motor $car)
    {
        return $this->formatApiResponse($this->motorService->updateMotor($request, $car), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->formatApiResponse($this->motorService->deleteMotor($id), 200);
    }

    public function report(Motor $car)
    {
        return $this->formatApiResponse($this->motorService->report(), 200);
    }

    public function buy(Request $request, Motor $car)
    {
        return $this->formatApiResponse($this->motorService->buy($request, $car), 200);
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
