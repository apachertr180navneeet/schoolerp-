<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\SchoolSetting;
use PDF;

class CertificateController extends Controller
{
    public function TCView(Request $request)
    {
        $years = StudentYear::all();
        $classes = StudentClass::all();

        $year_id = $request->year_id ?? ($years->first()?->id ?? null);
        $class_id = $request->class_id ?? ($classes->first()?->id ?? null);

        $students = AssignStudent::where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->with(['student', 'student_class', 'student_year'])
            ->get();

        return view('backend.student.certificate.tc_view', compact('students', 'years', 'classes', 'year_id', 'class_id'));
    }

    public function TCPDF($student_id)
    {
        $data['details'] = AssignStudent::with(['student', 'student_class', 'student_year'])
            ->where('student_id', $student_id)
            ->first();

        $data['school'] = SchoolSetting::first();
        $data['tc_no'] = 'TC/' . date('Y') . '/' . rand(100, 999);
        $data['issue_date'] = date('d-m-Y');

        $pdf = PDF::loadView('backend.student.certificate.tc_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('transfer_certificate_' . $student_id . '.pdf');
    }

    public function BonafideView(Request $request)
    {
        $years = StudentYear::all();
        $classes = StudentClass::all();

        $year_id = $request->year_id ?? ($years->first()?->id ?? null);
        $class_id = $request->class_id ?? ($classes->first()?->id ?? null);

        $students = AssignStudent::where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->with(['student', 'student_class', 'student_year'])
            ->get();

        return view('backend.student.certificate.bonafide_view', compact('students', 'years', 'classes', 'year_id', 'class_id'));
    }

    public function BonafidePDF($student_id)
    {
        $data['details'] = AssignStudent::with(['student', 'student_class', 'student_year'])
            ->where('student_id', $student_id)
            ->first();

        $data['school'] = SchoolSetting::first();
        $data['cert_no'] = 'BON/' . date('Y') . '/' . rand(100, 999);
        $data['issue_date'] = date('d-m-Y');

        $pdf = PDF::loadView('backend.student.certificate.bonafide_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('bonafide_certificate_' . $student_id . '.pdf');
    }
}

