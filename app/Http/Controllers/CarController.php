<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Helpers\FormatApi;
use App\Services\CarService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $cars = $this->carService->getAllCars();

        if ($cars->count() <= 0) {
            return response()->json([
                'success' => false,
                'data' => $cars,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'data' => $cars,
        ], Response::HTTP_OK);
    }

    public function stock()
    {
        $stock = $this->carService->stock();
        if ($stock->count() <= 0) {
            return response()->json([
                'success' => false,
                'stock' => 'No stock available',
                'data' => $stock,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'data' => $stock,
        ], Response::HTTP_OK);
    }

    public function sales()
    {
        $sales = $this->carService->sales();
        if ($sales->count() <= 0) {
            return response()->json([
                'success' => false,
                'amount_sold' => 'Nothing sold yet',
                'data' => $sales,
            ], Response::HTTP_OK);
        }


        return response()->json([
            'success' => true,
            'amount_sold' => $sales->count(),
            'data' => $sales,
        ], Response::HTTP_OK);
    }
}
