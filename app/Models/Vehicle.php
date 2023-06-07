<?php

namespace App\Models;

use App\Models\Car;
use App\Models\Motor;
use Jenssegers\Mongodb\Eloquent\Model as Moloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Moloquent
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function motor()
    {
        return $this->hasOne(Motor::class);
    }

    public function car()
    {
        return $this->hasOne(Car::class);
    }
}
