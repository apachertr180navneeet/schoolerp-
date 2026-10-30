<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentMedical;
use App\Models\User;
use App\Models\AssignStudent;
use App\Models\ActivityLog;

class StudentMedicalController extends Controller
{
    public function MedicalView()
    {
        $students = AssignStudent::with(['student', 'student_class', 'year'])->get();
        $medicals = StudentMedical::all()->keyBy('student_id');
        return view('backend.student.medical.medical_view', compact('students', 'medicals'));
    }

    public function MedicalEdit($student_id)
    {
        $student = User::findOrFail($student_id);
        $medical = StudentMedical::where('student_id', $student_id)->first();
        return view('backend.student.medical.medical_edit', compact('student', 'medical'));
    }

    public function MedicalUpdate(Request $request, $student_id)
    {
        $medical = StudentMedical::updateOrCreate(
            ['student_id' => $student_id],
            [
                'blood_group' => $request->blood_group,
                'height_cm' => $request->height_cm,
                'weight_kg' => $request->weight_kg,
                'known_allergies' => $request->known_allergies,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_phone' => $request->emergency_contact_phone,
                'medical_conditions' => $request->medical_conditions,
                'last_checkup_date' => $request->last_checkup_date ?? now()->toDateString(),
            ]
        );

        ActivityLog::log('UPDATE', 'Medical', 'Updated health card for student ID #' . $student_id);

        $notification = [
            'message' => 'Student medical health profile updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.medical.view')->with($notification);
    }
}
