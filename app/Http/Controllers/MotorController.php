<?php

namespace App\Http\Controllers;

use App\Helpers\FormatApi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $all = $this->motorService->getAllMotors();
        if ($all->count() < 0) {
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

    public function stock()
    {
        $stock = $this->motorService->stock();
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

    public function sales()
    {
        $sales = $this->motorService->sales();
        if ($sales->count() <= 0) {
            return response()->json([
                'success' => false,
                'amount_sold' => 'Nothing sold yet',
                'data' => $sales
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'amount_sold' => $sales->count(),
            'data' => $sales
        ], Response::HTTP_OK);
    }
}
