@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Assign New Homework</h5>
                    <p class="text-muted small mb-0">Publish an assignment syllabus for a designated class and subject</p>
                </div>
                <a href="{{ route('homework.view') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="feather icon-arrow-left me-1"></i> Back to List
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('homework.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Target Class <span class="text-danger">*</span></label>
                            <select name="class_id" class="form-control" required>
                                <option value="" disabled selected>Select Class</option>
                                @foreach($classes as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Subject <span class="text-danger">*</span></label>
                            <select name="subject_id" class="form-control" required>
                                <option value="" disabled selected>Select Subject</option>
                                @foreach($subjects as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Homework Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Chapter 4: Linear Equations Exercise 4.2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Maximum Marks</label>
                            <input type="number" name="max_marks" class="form-control" value="10" min="1">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Assignment Date <span class="text-danger">*</span></label>
                            <input type="date" name="homework_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Submission Deadline <span class="text-danger">*</span></label>
                            <input type="date" name="submission_date" class="form-control" value="{{ date('Y-m-d', strtotime('+2 days')) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Instructions & Assignment Details</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Detail the questions, pages to read, and formatting requirements..."></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="feather icon-save me-1"></i> Publish Homework
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
