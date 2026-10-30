<?php

namespace App\Http\Controllers\Backend\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Timetable;
use App\Models\StudentClass;
use App\Models\StudentSection;
use App\Models\SchoolSubject;
use App\Models\User;

class TimetableController extends Controller
{
    public function TimetableView(Request $request)
    {
        $classes = StudentClass::all();
        $sections = StudentSection::all();

        $selected_class = $request->class_id ?? ($classes->first()?->id ?? null);
        $selected_section = $request->section_id ?? null;

        $query = Timetable::with(['student_class', 'section', 'subject', 'teacher']);

        if ($selected_class) {
            $query->where('class_id', $selected_class);
        }
        if ($selected_section) {
            $query->where('section_id', $selected_section);
        }

        $allData = $query->orderBy('day')->orderBy('start_time')->get();

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        return view('backend.academic.timetable.timetable_view', compact(
            'allData', 'classes', 'sections', 'selected_class', 'selected_section', 'days'
        ));
    }

    public function TimetableAdd()
    {
        $classes = StudentClass::all();
        $sections = StudentSection::all();
        $subjects = SchoolSubject::all();
        $teachers = User::where('usertype', 'employee')->get();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        return view('backend.academic.timetable.timetable_add', compact(
            'classes', 'sections', 'subjects', 'teachers', 'days'
        ));
    }

    public function TimetableStore(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $day = $request->day ?? $request->day_of_week ?? 'Monday';

        Timetable::create([
            'class_id' => $request->class_id,
            'section_id' => $request->section_id ?? null,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id ?? null,
            'day' => $day,
            'period_no' => $request->period_no ?? (Timetable::where('class_id', $request->class_id)->where('day', $day)->count() + 1),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'room_no' => $request->room_no ?? 'Room 101',
        ]);

        $notification = [
            'message' => 'Class Period Added to Timetable Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('academic.timetable.view', ['class_id' => $request->class_id, 'section_id' => $request->section_id])->with($notification);
    }

    public function TimetableDelete($id)
    {
        $timetable = Timetable::findOrFail($id);
        $class_id = $timetable->class_id;
        $timetable->delete();

        $notification = [
            'message' => 'Timetable Slot Deleted Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('academic.timetable.view', ['class_id' => $class_id])->with($notification);
    }
}
