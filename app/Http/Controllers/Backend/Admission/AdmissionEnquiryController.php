<?php

namespace App\Http\Controllers\Backend\Admission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdmissionEnquiry;
use App\Models\StudentClass;

class AdmissionEnquiryController extends Controller
{
    public function EnquiryView(Request $request)
    {
        $status = $request->status;
        $query = AdmissionEnquiry::with('student_class')->orderBy('id', 'DESC');
        
        if ($status && $status != 'all') {
            $query->where('status', $status);
        }

        $allData = $query->get();
        $classes = StudentClass::all();

        $stats = [
            'total' => AdmissionEnquiry::count(),
            'new' => AdmissionEnquiry::where('status', 'New')->count(),
            'contacted' => AdmissionEnquiry::where('status', 'Contacted')->count(),
            'admitted' => AdmissionEnquiry::where('status', 'Admitted')->count(),
        ];

        return view('backend.admission.enquiry_view', compact('allData', 'classes', 'stats', 'status'));
    }

    public function EnquiryAdd()
    {
        $classes = StudentClass::all();
        return view('backend.admission.enquiry_add', compact('classes'));
    }

    public function EnquiryStore(Request $request)
    {
        $request->validate([
            'student_name' => 'required',
            'parent_name' => 'required',
            'mobile' => 'required',
            'class_id' => 'required',
        ]);

        $enquiry = new AdmissionEnquiry();
        $enquiry->enquiry_no = 'ENQ-' . date('Y') . '-' . rand(1000, 9999);
        $enquiry->student_name = $request->student_name;
        $enquiry->parent_name = $request->parent_name;
        $enquiry->mobile = $request->mobile;
        $enquiry->email = $request->email;
        $enquiry->class_id = $request->class_id;
        $enquiry->enquiry_date = $request->enquiry_date ?? date('Y-m-d');
        $enquiry->source = $request->source ?? 'Walk-in';
        $enquiry->status = $request->status ?? 'New';
        $enquiry->notes = $request->notes;
        $enquiry->save();

        $notification = [
            'message' => 'Admission Enquiry Logged Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('admission.enquiry.view')->with($notification);
    }

    public function EnquiryEdit($id)
    {
        $editData = AdmissionEnquiry::findOrFail($id);
        $classes = StudentClass::all();
        return view('backend.admission.enquiry_edit', compact('editData', 'classes'));
    }

    public function EnquiryUpdate(Request $request, $id)
    {
        $enquiry = AdmissionEnquiry::findOrFail($id);
        $request->validate([
            'student_name' => 'required',
            'parent_name' => 'required',
            'mobile' => 'required',
            'class_id' => 'required',
        ]);

        $enquiry->student_name = $request->student_name;
        $enquiry->parent_name = $request->parent_name;
        $enquiry->mobile = $request->mobile;
        $enquiry->email = $request->email;
        $enquiry->class_id = $request->class_id;
        $enquiry->enquiry_date = $request->enquiry_date ?? $enquiry->enquiry_date;
        $enquiry->source = $request->source ?? $enquiry->source;
        $enquiry->status = $request->status ?? $enquiry->status;
        $enquiry->notes = $request->notes;
        $enquiry->save();

        $notification = [
            'message' => 'Enquiry Updated Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('admission.enquiry.view')->with($notification);
    }

    public function EnquiryStatusUpdate(Request $request, $id)
    {
        $enquiry = AdmissionEnquiry::findOrFail($id);
        $enquiry->status = $request->status;
        $enquiry->save();

        return response()->json(['status' => 'success', 'message' => 'Status updated successfully']);
    }

    public function EnquiryDelete($id)
    {
        $enquiry = AdmissionEnquiry::findOrFail($id);
        $enquiry->delete();

        $notification = [
            'message' => 'Enquiry Deleted Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('admission.enquiry.view')->with($notification);
    }
}

