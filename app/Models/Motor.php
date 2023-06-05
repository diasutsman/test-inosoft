<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

class Motor extends Moloquent
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        '_id',
        'created_at',
        'updated_at',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
