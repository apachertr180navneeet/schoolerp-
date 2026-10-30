<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getDayOfWeekAttribute()
    {
        return $this->attributes['day'] ?? '';
    }

    public function setDayOfWeekAttribute($value)
    {
        $this->attributes['day'] = $value;
    }

    public function student_class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo(StudentSection::class, 'section_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(SchoolSubject::class, 'subject_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }
}
