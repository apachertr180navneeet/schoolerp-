<?php

namespace App\Http\Controllers\Backend\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Homework;
use App\Models\Notice;
use App\Models\AssignStudent;
use App\Models\StudentAttendance;
use App\Models\StudentMarks;
use App\Models\StudentLeave;
use App\Models\Timetable;
use App\Models\AccountStudentFee;

class PortalController extends Controller
{
    public function ParentDashboard()
    {
        $student = AssignStudent::with(['student', 'student_class', 'year'])->first();
        $notices = Notice::where('is_active', 1)->orderBy('publish_date', 'DESC')->take(5)->get();
        $recentHomeworks = Homework::with(['school_subject'])->orderBy('id', 'DESC')->take(5)->get();
        $fees = AccountStudentFee::with(['fee_category'])->take(5)->get();

        return view('backend.portal.parent_dashboard', compact('student', 'notices', 'recentHomeworks', 'fees'));
    }

    public function StudentDashboard()
    {
        $student = AssignStudent::with(['student', 'student_class', 'year'])->first();
        $notices = Notice::where('is_active', 1)->orderBy('publish_date', 'DESC')->take(5)->get();
        $homeworks = Homework::with(['school_subject'])->orderBy('id', 'DESC')->take(6)->get();
        $marks = StudentMarks::with(['exam_type', 'assign_subject.school_subject'])->take(6)->get();

        return view('backend.portal.student_dashboard', compact('student', 'notices', 'homeworks', 'marks'));
    }

    public function TeacherDashboard()
    {
        $notices = Notice::where('is_active', 1)->orderBy('publish_date', 'DESC')->take(4)->get();
        $homeworks = Homework::with(['student_class', 'school_subject'])->orderBy('id', 'DESC')->take(5)->get();
        $pendingLeaves = StudentLeave::with(['student', 'student_class'])->where('status', 'Pending')->get();

        return view('backend.portal.teacher_dashboard', compact('notices', 'homeworks', 'pendingLeaves'));
    }
}
