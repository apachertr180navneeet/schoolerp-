<?php

namespace App\Http\Controllers\Backend\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\User;

class LibraryController extends Controller
{
    public function BookView()
    {
        $allData = Book::orderBy('id', 'DESC')->get();
        return view('backend.library.book_view', compact('allData'));
    }

    public function BookAdd()
    {
        return view('backend.library.book_add');
    }

    public function BookStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'isbn' => 'nullable|unique:books,isbn',
            'quantity' => 'required|numeric|min:1',
        ]);

        $book = new Book();
        $book->accession_no = $request->accession_no ?? ('ACC-' . rand(1000, 9999));
        $book->title = $request->title;
        $book->author = $request->author ?? 'Various';
        $book->isbn = $request->isbn ?? ('ISBN-' . rand(100000, 999999));
        $book->publisher = $request->publisher;
        $book->category = $request->category ?? 'General';
        $book->rack_no = $request->rack_no;
        $book->total_copies = $request->quantity ?? 1;
        $book->available_copies = $request->quantity ?? 1;
        $book->save();

        $notification = [
            'message' => 'Book Added to Library Catalog Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('library.book.view')->with($notification);
    }

    public function BookEdit($id)
    {
        $editData = Book::findOrFail($id);
        return view('backend.library.book_edit', compact('editData'));
    }

    public function BookUpdate(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $request->validate([
            'title' => 'required',
            'quantity' => 'required|numeric|min:1',
        ]);

        $qtyDiff = $request->quantity - ($book->total_copies ?? 1);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->isbn = $request->isbn;
        $book->publisher = $request->publisher;
        $book->category = $request->category;
        $book->rack_no = $request->rack_no;
        $book->total_copies = $request->quantity;
        $book->available_copies = max(0, ($book->available_copies ?? 1) + $qtyDiff);
        $book->save();

        $notification = [
            'message' => 'Book Information Updated Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('library.book.view')->with($notification);
    }

    public function BookDelete($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        $notification = [
            'message' => 'Book Deleted from Catalog',
            'alert-type' => 'info'
        ];

        return redirect()->route('library.book.view')->with($notification);
    }

    public function IssueView()
    {
        $allData = BookIssue::with(['book', 'user'])->orderBy('id', 'DESC')->get();
        return view('backend.library.issue_view', compact('allData'));
    }

    public function IssueAdd()
    {
        $books = Book::where('available_copies', '>', 0)->get();
        $users = User::all();
        return view('backend.library.issue_add', compact('books', 'users'));
    }

    public function IssueStore(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
            'user_id' => 'required',
            'due_date' => 'required|date',
        ]);

        $book = Book::findOrFail($request->book_id);
        if ($book->available_copies <= 0) {
            return redirect()->back()->with(['message' => 'Book is currently not available in inventory', 'alert-type' => 'error']);
        }

        $issue = new BookIssue();
        $issue->book_id = $request->book_id;
        $issue->user_id = $request->user_id;
        $issue->issue_date = date('Y-m-d');
        $issue->due_date = date('Y-m-d', strtotime($request->due_date));
        $issue->status = 'Issued';
        $issue->save();

        $book->decrement('available_copies');

        $notification = [
            'message' => 'Book Issued Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('library.issue.view')->with($notification);
    }

    public function IssueReturn($id)
    {
        $issue = BookIssue::findOrFail($id);
        $issue->return_date = date('Y-m-d');
        $issue->status = 'Returned';

        // Calculate fine if overdue ($10 per overdue day)
        $dueDate = strtotime($issue->due_date);
        $today = strtotime(date('Y-m-d'));
        if ($today > $dueDate) {
            $daysLate = ceil(($today - $dueDate) / 86400);
            $issue->fine_amount = $daysLate * 10;
        }

        $issue->save();

        // Increment available quantity
        Book::where('id', $issue->book_id)->increment('available_copies');

        $notification = [
            'message' => 'Book Returned Successfully' . ($issue->fine_amount > 0 ? ' (Late fine incurred: ₹' . $issue->fine_amount . ')' : ''),
            'alert-type' => 'info'
        ];

        return redirect()->route('library.issue.view')->with($notification);
    }
}
