@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Issue Book to Student or Faculty</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('library.issue.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Select Available Book <span class="text-danger">*</span></label>
                            <select name="book_id" class="form-select" required>
                                <option value="" disabled selected>Choose a book...</option>
                                @foreach($books as $b)
                                <option value="{{ $b->id }}">{{ $b->title }} ({{ $b->available }} available)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Borrower (Student / Staff) <span class="text-danger">*</span></label>
                            <select name="user_id" class="form-select" required>
                                <option value="" disabled selected>Select borrower...</option>
                                @foreach($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }} [{{ $u->usertype }} | ID: {{ $u->id_no ?? $u->id }}]</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Due Date for Return <span class="text-danger">*</span></label>
                            <input type="date" name="due_date" class="form-control" value="{{ date('Y-m-d', strtotime('+14 days')) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Librarian Notes</label>
                            <input type="text" name="remarks" class="form-control" placeholder="Book condition or special notes">
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">Issue Book</button>
                        <a href="{{ route('library.issue.view') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
