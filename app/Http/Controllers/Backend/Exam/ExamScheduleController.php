<?php

namespace App\Http\Controllers\Backend\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamSchedule;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\SchoolSubject;
use App\Models\AssignStudent;
use App\Models\SchoolSetting;
use App\Models\ActivityLog;
use Barryvdh\DomPDF\Facade\Pdf;

class ExamScheduleController extends Controller
{
    public function DatesheetView()
    {
        $allData = ExamSchedule::with(['exam_type', 'student_class', 'school_subject'])
            ->orderBy('exam_date', 'ASC')
            ->get();
        return view('backend.exam.datesheet_view', compact('allData'));
    }

    public function DatesheetAdd()
    {
        $examTypes = ExamType::all();
        $classes = StudentClass::all();
        $subjects = SchoolSubject::all();
        return view('backend.exam.datesheet_add', compact('examTypes', 'classes', 'subjects'));
    }

    public function DatesheetStore(Request $request)
    {
        $request->validate([
            'exam_type_id' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'exam_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $schedule = new ExamSchedule();
        $schedule->exam_type_id = $request->exam_type_id;
        $schedule->class_id = $request->class_id;
        $schedule->subject_id = $request->subject_id;
        $schedule->exam_date = $request->exam_date;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->room_no = $request->room_no ?? 'Exam Hall A';
        $schedule->max_marks = $request->max_marks ?? 100;
        $schedule->pass_marks = $request->pass_marks ?? 33;
        $schedule->save();

        ActivityLog::log('CREATE', 'Exam', 'Created datesheet slot for exam: ' . $schedule->id);

        $notification = [
            'message' => 'Exam datesheet slot scheduled successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('exam.schedule.view')->with($notification);
    }

    public function DatesheetDelete($id)
    {
        $schedule = ExamSchedule::findOrFail($id);
        $schedule->delete();

        $notification = [
            'message' => 'Exam schedule entry removed successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('exam.schedule.view')->with($notification);
    }

    public function AdmitCardView()
    {
        $examTypes = ExamType::all();
        $classes = StudentClass::all();
        $students = AssignStudent::with(['student', 'student_class', 'year'])->get();
        return view('backend.exam.admit_card_view', compact('examTypes', 'classes', 'students'));
    }

    public function AdmitCardPdf(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'exam_type_id' => 'required',
        ]);

        $assignStudent = AssignStudent::with(['student', 'student_class', 'year'])
            ->where('student_id', $request->student_id)
            ->firstOrFail();

        $examType = ExamType::findOrFail($request->exam_type_id);
        $schedules = ExamSchedule::with('school_subject')
            ->where('exam_type_id', $request->exam_type_id)
            ->where('class_id', $assignStudent->class_id)
            ->orderBy('exam_date', 'ASC')
            ->get();

        $school = SchoolSetting::first();

        $data = [
            'assignStudent' => $assignStudent,
            'examType' => $examType,
            'schedules' => $schedules,
            'school' => $school,
        ];

        $pdf = Pdf::loadView('backend.exam.admit_card_pdf', $data);
        return $pdf->stream('Admit_Card_' . $assignStudent->student->id_no . '.pdf');
    }
}
