<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Motor;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{

    protected $baseRules = [
        'year' => 'required|integer',
        'color' => 'required',
        'price' => 'required|integer',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vehicle::all();
    }

    public function storeMotor(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array_merge($this->baseRules, [
                'machine' => 'required',
                'suspension_type' => 'required',
                'transmission_type' => 'required',
            ])
        );

        // if validation failed
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Invalid payload'
            ], Response::HTTP_BAD_REQUEST);
        }

        // if validation success
        $vehicle = Vehicle::create($request->only(array_keys($this->baseRules)));
        $motor = Motor::create(array_merge($request->only([
            'machine',
            'suspension_type',
            'transmission_type'
        ]), [
            'vehicle_id' => $vehicle->id
        ]));

        return response()->json([
            'status' => 'success',
            'data' => [
                'addedVehicle' => collect(array_merge($vehicle->toArray(), $motor->toArray()))->except('vehicle_id')
            ]
        ], Response::HTTP_CREATED);
    }

    public function storeCar(Request $request)
    {
        $rules = [
            'machine' => 'required',
            'passenger_capacity' => 'required',
            'type' => 'required',
        ];

        $validator = Validator::make(
            $request->all(),
            array_merge($this->baseRules, $rules)
        );

        // if validation failed
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Invalid payload'
            ], Response::HTTP_BAD_REQUEST);
        }

        // if validation success
        $vehicle = Vehicle::create($request->only(array_keys($this->baseRules)));
        $car = Car::create(array_merge($request->only(array_keys($rules)), [
            'vehicle_id' => $vehicle->id
        ]));

        return response()->json([
            'status' => 'success',
            'data' => [
                'addedVehicle' => collect(array_merge($vehicle->toArray(), $car->toArray()))->except('vehicle_id')
            ]
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
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
}
