<?php

namespace App\Http\Controllers;

use App\Helpers\FormatApi;
use Illuminate\Http\Request;
use App\Services\MotorService;

class MotorController extends Controller
{
    public function __construct(private MotorService $motorService)
    {
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
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        return $this->formatApiResponse($this->motorService->updateMotor($request, $id), 200);
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

    public function sales()
    {
        return $this->formatApiResponse($this->motorService->sales(), 200);
    }

    public function buy(string $id)
    {
        return FormatApi::formatResponse(200, 'success', $this->motorService->buy($id));
    }

    // format api dengan dinamis data dan status code
    private function formatApiResponse($data, $statusCode)
    {
        if ($data) {
            return FormatApi::formatResponse($statusCode, 'success', $data);
        } else {
            return FormatApi::formatResponse(400, 'Gagal');
        }
    }
}
