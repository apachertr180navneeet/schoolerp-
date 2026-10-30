<?php

namespace App\Http\Controllers\Backend\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\SchoolSubject;
use App\Models\ActivityLog;

class HomeworkController extends Controller
{
    public function HomeworkView()
    {
        $allData = Homework::with(['student_class', 'school_subject', 'submissions'])->orderBy('id', 'DESC')->get();
        return view('backend.academic.homework.homework_view', compact('allData'));
    }

    public function HomeworkAdd()
    {
        $classes = StudentClass::all();
        $years = StudentYear::all();
        $subjects = SchoolSubject::all();
        return view('backend.academic.homework.homework_add', compact('classes', 'years', 'subjects'));
    }

    public function HomeworkStore(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
            'title' => 'required|string|max:255',
            'homework_date' => 'required|date',
            'submission_date' => 'required|date',
        ]);

        $homework = new Homework();
        $homework->class_id = $request->class_id;
        $homework->section_id = $request->section_id ?? null;
        $homework->subject_id = $request->subject_id;
        $homework->teacher_id = auth()->id() ?? 1;
        $homework->title = $request->title;
        $homework->description = $request->description;
        $homework->homework_date = $request->homework_date;
        $homework->assigned_date = $request->homework_date;
        $homework->submission_date = $request->submission_date;
        $homework->due_date = $request->submission_date;
        $homework->max_marks = $request->max_marks ?? 10;
        $homework->save();

        ActivityLog::log('CREATE', 'Academic', 'Assigned homework: ' . $homework->title);

        $notification = [
            'message' => 'Homework created successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('homework.view')->with($notification);
    }

    public function HomeworkSubmissions($id)
    {
        $homework = Homework::with(['student_class', 'school_subject'])->findOrFail($id);
        $submissions = HomeworkSubmission::with('student')->where('homework_id', $id)->get();
        return view('backend.academic.homework.submissions', compact('homework', 'submissions'));
    }

    public function HomeworkGradeStore(Request $request, $id)
    {
        $submission = HomeworkSubmission::findOrFail($id);
        $submission->status = $request->status ?? 'Graded';
        $submission->marks_obtained = $request->marks_obtained;
        $submission->marks = $request->marks_obtained;
        $submission->remarks = $request->remarks;
        $submission->evaluation_remarks = $request->remarks;
        $submission->save();

        $notification = [
            'message' => 'Homework submission evaluated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function HomeworkDelete($id)
    {
        $homework = Homework::findOrFail($id);
        $homework->delete();

        $notification = [
            'message' => 'Homework deleted successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('homework.view')->with($notification);
    }
}
