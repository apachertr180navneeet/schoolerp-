<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelRoom extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student_hostels()
    {
        return $this->hasMany(StudentHostel::class, 'room_id', 'id');
    }

    public function getOccupiedBedsCountAttribute()
    {
        return $this->student_hostels()->where('status', 'Occupied')->count();
    }
}

