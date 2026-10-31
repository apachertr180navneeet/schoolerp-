<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function log($action, $module, $description, $user = null)
    {
        $userId = $user ? $user->id : (auth()->check() ? auth()->id() : null);
        $userName = $user ? $user->name : (auth()->check() ? auth()->user()->name : 'System');

        return self::create([
            'user_id' => $userId,
            'user_name' => $userName,
            'action_type' => $action,
            'module' => $module,
            'description' => $description,
            'ip_address' => request()->ip() ?? '127.0.0.1',
        ]);
    }
}

