<?php

namespace App\Http\Controllers\Backend\Communication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\ActivityLog;

class NoticeController extends Controller
{
    public function NoticeView()
    {
        $allData = Notice::orderBy('id', 'DESC')->get();
        return view('backend.communication.notice.notice_view', compact('allData'));
    }

    public function NoticeAdd()
    {
        return view('backend.communication.notice.notice_add');
    }

    public function NoticeStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'publish_date' => 'required|date',
            'target_audience' => 'required|string',
            'message' => 'required',
        ]);

        $notice = new Notice();
        $notice->title = $request->title;
        $notice->notice_type = $request->notice_type ?? 'Circular';
        $notice->target_audience = $request->target_audience;
        $notice->publish_date = $request->publish_date;
        $notice->expiry_date = $request->expiry_date;
        $notice->message = $request->message;
        $notice->is_active = $request->is_active ? 1 : 1;
        $notice->created_by = auth()->id() ?? 1;
        $notice->save();

        ActivityLog::log('CREATE', 'Communication', 'Published school notice: ' . $notice->title);

        $notification = [
            'message' => 'Circular notice published successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('notice.view')->with($notification);
    }

    public function NoticeDelete($id)
    {
        $notice = Notice::findOrFail($id);
        $notice->delete();

        $notification = [
            'message' => 'Notice deleted successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('notice.view')->with($notification);
    }
}
