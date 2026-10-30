<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTransport extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getMonthlyFeeAttribute()
    {
        return $this->attributes['monthly_fare'] ?? 0;
    }

    public function setMonthlyFeeAttribute($value)
    {
        $this->attributes['monthly_fare'] = $value;
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function route()
    {
        return $this->belongsTo(TransportRoute::class, 'route_id', 'id');
    }

    public function vehicle()
    {
        return $this->belongsTo(TransportVehicle::class, 'vehicle_id', 'id');
    }
}
