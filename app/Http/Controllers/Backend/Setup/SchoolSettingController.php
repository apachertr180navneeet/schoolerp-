<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSetting;

class SchoolSettingController extends Controller
{
    public function SchoolProfileView()
    {
        $setting = SchoolSetting::first();
        if (!$setting) {
            $setting = SchoolSetting::create([
                'school_name' => 'Shiksha Mitra Public School',
                'school_code' => 'SMPS-1029',
                'affiliation_no' => 'CBSE/AFF/2026/8942',
                'board' => 'CBSE',
                'phone' => '+91 98765 43210',
                'email' => 'contact@shikshamitra.edu.in',
                'address' => 'Campus 1, Vidya Marg, Knowledge Park, Education City',
                'principal_name' => 'Dr. Rajesh Sharma',
                'academic_session' => '2026-2027',
            ]);
        }
        return view('backend.setup.school_profile.view_profile', compact('setting'));
    }

    public function SchoolProfileUpdate(Request $request)
    {
        $setting = SchoolSetting::first();
        if (!$setting) {
            $setting = new SchoolSetting();
        }

        $setting->school_name = $request->school_name;
        $setting->school_code = $request->school_code;
        $setting->affiliation_no = $request->affiliation_no;
        $setting->board = $request->board;
        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->address = $request->address;
        $setting->principal_name = $request->principal_name;
        $setting->academic_session = $request->academic_session;

        if ($request->file('logo')) {
            $file = $request->file('logo');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/school'), $filename);
            $setting->logo = $filename;
        }

        if ($request->file('school_seal')) {
            $file = $request->file('school_seal');
            $filename = date('YmdHi') . '_seal_' . $file->getClientOriginalName();
            $file->move(public_path('upload/school'), $filename);
            $setting->school_seal = $filename;
        }

        $setting->save();

        $notification = [
            'message' => 'School Profile & Configuration Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}

