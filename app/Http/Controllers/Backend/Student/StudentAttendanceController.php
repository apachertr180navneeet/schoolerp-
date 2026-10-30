<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentAttendance;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\StudentSection;
use App\Models\User;
use DB;

class StudentAttendanceController extends Controller
{
    public function AttendanceView()
    {
        $allData = StudentAttendance::select('date', 'class_id')
            ->groupBy('date', 'class_id')
            ->orderBy('date', 'DESC')
            ->with('student_class')
            ->get();

        return view('backend.student.student_attendance.student_attendance_view', compact('allData'));
    }

    public function AttendanceAdd(Request $request)
    {
        $classes = StudentClass::all();
        $years = StudentYear::all();
        $sections = StudentSection::all();

        $students = [];
        $selected_class = $request->class_id ?? ($classes->first()?->id ?? null);
        $selected_year = $request->year_id ?? ($years->first()?->id ?? null);

        if ($selected_class && $selected_year) {
            $students = AssignStudent::where('class_id', $selected_class)
                ->where('year_id', $selected_year)
                ->with('student')
                ->get();
        }

        return view('backend.student.student_attendance.student_attendance_add', compact(
            'classes', 'years', 'sections', 'students', 'selected_class', 'selected_year'
        ));
    }

    public function AttendanceStore(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'class_id' => 'required',
            'year_id' => 'required',
        ]);

        $date = date('Y-m-d', strtotime($request->date));
        $class_id = $request->class_id;
        $year_id = $request->year_id;

        // Delete previous records for the same class and date to allow updating
        StudentAttendance::where('date', $date)
            ->where('class_id', $class_id)
            ->delete();

        if ($request->student_id && is_array($request->student_id)) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $statusKey = 'attend_status_' . $request->student_id[$i];
                $status = $request->$statusKey ?? 'Present';

                StudentAttendance::create([
                    'date' => $date,
                    'student_id' => $request->student_id[$i],
                    'class_id' => $class_id,
                    'year_id' => $year_id,
                    'section_id' => $request->section_id ?? null,
                    'attend_status' => $status,
                ]);
            }
        }

        $notification = [
            'message' => 'Student Attendance Recorded Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.attendance.view')->with($notification);
    }

    public function AttendanceEdit($date, $class_id)
    {
        $editData = StudentAttendance::where('date', $date)
            ->where('class_id', $class_id)
            ->with('student')
            ->get();

        $classes = StudentClass::all();
        $years = StudentYear::all();
        $class = StudentClass::find($class_id);

        return view('backend.student.student_attendance.student_attendance_edit', compact(
            'editData', 'date', 'class_id', 'classes', 'years', 'class'
        ));
    }

    public function AttendanceDetails($date, $class_id)
    {
        $details = StudentAttendance::where('date', $date)
            ->where('class_id', $class_id)
            ->with(['student', 'student_class'])
            ->get();

        $class = StudentClass::find($class_id);

        return view('backend.student.student_attendance.student_attendance_details', compact('details', 'date', 'class'));
    }
}

