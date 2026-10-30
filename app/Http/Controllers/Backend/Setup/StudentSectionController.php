<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentSection;

class StudentSectionController extends Controller
{
    public function ViewSection()
    {
        $allData = StudentSection::all();
        return view('backend.setup.section.view_section', compact('allData'));
    }

    public function AddSection()
    {
        return view('backend.setup.section.add_section');
    }

    public function StoreSection(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:student_sections,name',
        ]);

        $data = new StudentSection();
        $data->name = $request->name;
        $data->capacity = $request->capacity ?? 40;
        $data->save();

        $notification = [
            'message' => 'Student Section Inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.section.view')->with($notification);
    }

    public function EditSection($id)
    {
        $editData = StudentSection::findOrFail($id);
        return view('backend.setup.section.edit_section', compact('editData'));
    }

    public function UpdateSection(Request $request, $id)
    {
        $data = StudentSection::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:student_sections,name,' . $data->id,
        ]);

        $data->name = $request->name;
        $data->capacity = $request->capacity ?? 40;
        $data->save();

        $notification = [
            'message' => 'Student Section Updated Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('student.section.view')->with($notification);
    }

    public function DeleteSection($id)
    {
        $data = StudentSection::findOrFail($id);
        $data->delete();

        $notification = [
            'message' => 'Student Section Deleted Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('student.section.view')->with($notification);
    }
}

