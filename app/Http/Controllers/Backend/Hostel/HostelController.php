<?php

namespace App\Http\Controllers\Backend\Hostel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HostelRoom;
use App\Models\StudentHostel;
use App\Models\User;
use App\Models\ActivityLog;

class HostelController extends Controller
{
    public function RoomView()
    {
        $allData = HostelRoom::with('student_hostels')->orderBy('id', 'DESC')->get();
        return view('backend.hostel.room_view', compact('allData'));
    }

    public function RoomAdd()
    {
        return view('backend.hostel.room_add');
    }

    public function RoomStore(Request $request)
    {
        $request->validate([
            'hostel_name' => 'required|string',
            'room_no' => 'required|string|unique:hostel_rooms,room_no',
            'capacity' => 'required|integer|min:1',
            'cost_per_bed' => 'required|numeric|min:0',
        ]);

        $room = new HostelRoom();
        $room->hostel_name = $request->hostel_name;
        $room->room_no = $request->room_no;
        $room->room_type = $request->room_type ?? 'Standard AC';
        $room->capacity = $request->capacity;
        $room->cost_per_bed = $request->cost_per_bed;
        $room->description = $request->description;
        $room->save();

        ActivityLog::log('CREATE', 'Hostel', 'Added hostel room ' . $room->room_no);

        $notification = [
            'message' => 'Hostel room added successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('hostel.room.view')->with($notification);
    }

    public function AllotmentView()
    {
        $allData = StudentHostel::with(['student', 'room'])->orderBy('id', 'DESC')->get();
        return view('backend.hostel.allotment_view', compact('allData'));
    }

    public function AllotmentAdd()
    {
        $rooms = HostelRoom::all();
        $students = User::where('usertype', 'Student')->get();
        return view('backend.hostel.allotment_add', compact('rooms', 'students'));
    }

    public function AllotmentStore(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'room_id' => 'required',
            'allotment_date' => 'required|date',
        ]);

        $allotment = new StudentHostel();
        $allotment->student_id = $request->student_id;
        $allotment->room_id = $request->room_id;
        $allotment->allotment_date = $request->allotment_date;
        $allotment->status = 'Occupied';
        $allotment->remarks = $request->remarks;
        $allotment->save();

        ActivityLog::log('ALLOTMENT', 'Hostel', 'Allotted bed to student ID #' . $allotment->student_id);

        $notification = [
            'message' => 'Hostel bed allotted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('hostel.allotment.view')->with($notification);
    }

    public function AllotmentVacate($id)
    {
        $allotment = StudentHostel::findOrFail($id);
        $allotment->status = 'Vacated';
        $allotment->save();

        $notification = [
            'message' => 'Hostel bed marked as vacated',
            'alert-type' => 'info'
        ];

        return redirect()->route('hostel.allotment.view')->with($notification);
    }
}

