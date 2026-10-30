<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getQuantityAttribute()
    {
        return $this->attributes['total_copies'] ?? 1;
    }

    public function setQuantityAttribute($value)
    {
        $this->attributes['total_copies'] = $value;
    }

    public function getAvailableAttribute()
    {
        return $this->attributes['available_copies'] ?? 1;
    }

    public function setAvailableAttribute($value)
    {
        $this->attributes['available_copies'] = $value;
    }

    public function issues()
    {
        return $this->hasMany(BookIssue::class, 'book_id', 'id');
    }
}
