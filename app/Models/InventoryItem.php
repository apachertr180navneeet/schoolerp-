<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(InventoryCategory::class, 'category_id', 'id');
    }

    public function issues()
    {
        return $this->hasMany(InventoryIssue::class, 'item_id', 'id');
    }
}

