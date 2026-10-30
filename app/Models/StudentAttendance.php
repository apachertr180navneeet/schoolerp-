<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function student_class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

    public function student_year()
    {
        return $this->belongsTo(StudentYear::class, 'year_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo(StudentSection::class, 'section_id', 'id');
    }
}

