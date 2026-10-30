<?php

namespace App\Http\Controllers\Backend\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Models\InventoryCategory;
use App\Models\InventoryIssue;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function ItemView()
    {
        $allData = InventoryItem::with('category')->orderBy('id', 'DESC')->get();
        return view('backend.inventory.item_view', compact('allData'));
    }

    public function ItemAdd()
    {
        $categories = InventoryCategory::all();
        return view('backend.inventory.item_add', compact('categories'));
    }

    public function ItemStore(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'item_name' => 'required|string|max:255',
            'item_code' => 'required|string|unique:inventory_items,item_code',
            'quantity' => 'required|integer|min:0',
        ]);

        $item = new InventoryItem();
        $item->category_id = $request->category_id;
        $item->item_name = $request->item_name;
        $item->item_code = $request->item_code;
        $item->unit = $request->unit ?? 'Pcs';
        $item->quantity = $request->quantity;
        $item->min_quantity_alert = $request->min_quantity_alert ?? 5;
        $item->unit_price = $request->unit_price ?? 0;
        $item->description = $request->description;
        $item->save();

        ActivityLog::log('CREATE', 'Inventory', 'Added item: ' . $item->item_name);

        $notification = [
            'message' => 'Inventory item added successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('inventory.item.view')->with($notification);
    }

    public function ItemDelete($id)
    {
        $item = InventoryItem::findOrFail($id);
        $item->delete();

        $notification = [
            'message' => 'Inventory item deleted successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('inventory.item.view')->with($notification);
    }

    public function IssueView()
    {
        $allData = InventoryIssue::with(['item', 'user'])->orderBy('id', 'DESC')->get();
        return view('backend.inventory.issue_view', compact('allData'));
    }

    public function IssueAdd()
    {
        $items = InventoryItem::where('quantity', '>', 0)->get();
        $staffs = User::where('usertype', 'Employee')->orWhere('usertype', 'Admin')->get();
        return view('backend.inventory.issue_add', compact('items', 'staffs'));
    }

    public function IssueStore(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'user_id' => 'required',
            'quantity_issued' => 'required|integer|min:1',
            'issue_date' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {
            $item = InventoryItem::findOrFail($request->item_id);
            if ($item->quantity < $request->quantity_issued) {
                throw new \Exception('Insufficient stock available');
            }

            $issue = new InventoryIssue();
            $issue->item_id = $request->item_id;
            $issue->user_id = $request->user_id;
            $issue->quantity_issued = $request->quantity_issued;
            $issue->issue_date = $request->issue_date;
            $issue->status = 'Issued';
            $issue->remarks = $request->remarks;
            $issue->save();

            $item->decrement('quantity', $request->quantity_issued);

            ActivityLog::log('ISSUE', 'Inventory', 'Issued ' . $request->quantity_issued . ' of ' . $item->item_name);
        });

        $notification = [
            'message' => 'Item issued successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('inventory.issue.view')->with($notification);
    }

    public function IssueReturn($id)
    {
        DB::transaction(function () use ($id) {
            $issue = InventoryIssue::findOrFail($id);
            if ($issue->status !== 'Returned') {
                $issue->status = 'Returned';
                $issue->return_date = now()->toDateString();
                $issue->save();

                $item = InventoryItem::find($issue->item_id);
                if ($item) {
                    $item->increment('quantity', $issue->quantity_issued);
                }

                ActivityLog::log('RETURN', 'Inventory', 'Returned issue ID #' . $issue->id);
            }
        });

        $notification = [
            'message' => 'Item returned to inventory stock successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('inventory.issue.view')->with($notification);
    }
}
