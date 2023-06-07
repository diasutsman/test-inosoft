<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

class Motor extends Moloquent
{
    use HasFactory;

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
