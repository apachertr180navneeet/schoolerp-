<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentLeave;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\ActivityLog;

class StudentLeaveController extends Controller
{
    public function LeaveView()
    {
        $allData = StudentLeave::with(['student', 'student_class', 'approver'])
            ->orderBy('id', 'DESC')
            ->get();
        return view('backend.student.student_leave.leave_view', compact('allData'));
    }

    public function LeaveAdd()
    {
        $students = AssignStudent::with(['student', 'student_class'])->get();
        $classes = StudentClass::all();
        return view('backend.student.student_leave.leave_add', compact('students', 'classes'));
    }

    public function LeaveStore(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'class_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'reason' => 'required|string',
        ]);

        $leave = new StudentLeave();
        $leave->student_id = $request->student_id;
        $leave->class_id = $request->class_id;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->reason = $request->reason;
        $leave->status = 'Pending';
        $leave->save();

        ActivityLog::log('CREATE', 'StudentLeave', 'Submitted student leave application #' . $leave->id);

        $notification = [
            'message' => 'Student leave application submitted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.leave.view')->with($notification);
    }

    public function LeaveApprove($id)
    {
        $leave = StudentLeave::findOrFail($id);
        $leave->status = 'Approved';
        $leave->approved_by = auth()->id() ?? 1;
        $leave->save();

        ActivityLog::log('APPROVE', 'StudentLeave', 'Approved student leave #' . $leave->id);

        $notification = [
            'message' => 'Student leave approved successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.leave.view')->with($notification);
    }

    public function LeaveReject($id)
    {
        $leave = StudentLeave::findOrFail($id);
        $leave->status = 'Rejected';
        $leave->approved_by = auth()->id() ?? 1;
        $leave->save();

        $notification = [
            'message' => 'Student leave rejected',
            'alert-type' => 'info'
        ];

        return redirect()->route('student.leave.view')->with($notification);
    }
}

