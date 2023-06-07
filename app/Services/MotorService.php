<?php

namespace App\Services;

use App\Repositories\MotorRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MotorService
{
    private $motorRepository;

    public function __construct(MotorRepository $motorRepository)
    {
        $this->motorRepository = $motorRepository;
    }

    public function getAllMotors()
    {
        return $this->motorRepository->getAllMotors();
    }

    public function sales()
    {
        return $this->motorRepository->sales();
    }

    public function stock()
    {
        return $this->motorRepository->stock();
    }
}
