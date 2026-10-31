<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function LogView(Request $request)
    {
        $query = ActivityLog::orderBy('id', 'DESC');

        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }
        if ($request->filled('action_type')) {
            $query->where('action_type', $request->action_type);
        }

        $allData = $query->paginate(25);
        $modules = ActivityLog::select('module')->distinct()->pluck('module');

        return view('backend.system.activity_log_view', compact('allData', 'modules'));
    }
}

