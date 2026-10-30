@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Submit Student Leave Request</h5>
                    <p class="text-muted small mb-0">Record formal absence request with dates and justification</p>
                </div>
                <a href="{{ route('student.leave.view') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="feather icon-arrow-left me-1"></i> Back to Leaves
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('student.leave.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select Student <span class="text-danger">*</span></label>
                        <select name="student_id" class="form-control" required>
                            <option value="" disabled selected>Select Student</option>
                            @foreach($students as $st)
                            <option value="{{ $st->student_id }}">
                                {{ $st->student->name }} (ID: {{ $st->student->id_no }}, Class: {{ $st->student_class->name ?? '' }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Class <span class="text-danger">*</span></label>
                        <select name="class_id" class="form-control" required>
                            <option value="" disabled selected>Select Class</option>
                            @foreach($classes as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date <span class="text-danger">*</span></label>
                            <input type="date" name="end_date" class="form-control" value="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Reason for Absence <span class="text-danger">*</span></label>
                        <textarea name="reason" class="form-control" rows="3" placeholder="Fever, Family emergency, Out of station, etc." required></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="feather icon-send me-1"></i> Submit Leave Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
