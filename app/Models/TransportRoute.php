<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportRoute extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteTitleAttribute()
    {
        return $this->attributes['route_name'] ?? '';
    }

    public function setRouteTitleAttribute($value)
    {
        $this->attributes['route_name'] = $value;
    }

    public function vehicles()
    {
        return $this->hasMany(TransportVehicle::class, 'route_id', 'id');
    }
}
