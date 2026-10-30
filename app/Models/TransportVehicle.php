<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportVehicle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getVehicleNumberAttribute()
    {
        return $this->attributes['vehicle_no'] ?? '';
    }

    public function setVehicleNumberAttribute($value)
    {
        $this->attributes['vehicle_no'] = $value;
    }

    public function route()
    {
        return $this->belongsTo(TransportRoute::class, 'route_id', 'id');
    }
}
