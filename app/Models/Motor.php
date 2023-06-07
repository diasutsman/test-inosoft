<?php

namespace App\Models;

use App\Models\Vehicle;
use Jenssegers\Mongodb\Eloquent\Model as Moloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Motor extends Moloquent
{
    use HasFactory;

    protected $with = [
        'vehicle',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'status',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
