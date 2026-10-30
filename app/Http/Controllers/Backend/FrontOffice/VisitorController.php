<?php

namespace App\Http\Controllers\Backend\FrontOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\ActivityLog;
use Barryvdh\DomPDF\Facade\Pdf;

class VisitorController extends Controller
{
    public function VisitorView()
    {
        $allData = Visitor::orderBy('id', 'DESC')->get();
        return view('backend.front_office.visitor_view', compact('allData'));
    }

    public function VisitorAdd()
    {
        return view('backend.front_office.visitor_add');
    }

    public function VisitorStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'purpose' => 'required|string',
            'person_to_meet' => 'required|string',
        ]);

        $passNumber = 'GP-' . date('Ymd') . '-' . rand(100, 999);

        $visitor = new Visitor();
        $visitor->pass_number = $passNumber;
        $visitor->name = $request->name;
        $visitor->phone = $request->phone;
        $visitor->email = $request->email;
        $visitor->purpose = $request->purpose;
        $visitor->person_to_meet = $request->person_to_meet;
        $visitor->id_proof_type = $request->id_proof_type ?? 'Aadhaar';
        $visitor->id_proof_number = $request->id_proof_number;
        $visitor->check_in = now();
        $visitor->number_of_persons = $request->number_of_persons ?? 1;
        $visitor->save();

        ActivityLog::log('CREATE', 'FrontOffice', 'Issued gate pass ' . $passNumber . ' for ' . $visitor->name);

        $notification = [
            'message' => 'Visitor gate pass created successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('visitor.view')->with($notification);
    }

    public function VisitorCheckOut($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->check_out = now();
        $visitor->save();

        $notification = [
            'message' => 'Visitor checked out successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('visitor.view')->with($notification);
    }

    public function VisitorGatePass($id)
    {
        $data['visitor'] = Visitor::findOrFail($id);
        $pdf = Pdf::loadView('backend.front_office.gate_pass_pdf', $data);
        return $pdf->stream('GatePass_' . $data['visitor']->pass_number . '.pdf');
    }

    public function VisitorDelete($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->delete();

        $notification = [
            'message' => 'Visitor record removed successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('visitor.view')->with($notification);
    }
}
