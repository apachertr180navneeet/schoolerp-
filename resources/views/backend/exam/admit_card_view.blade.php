@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Generate Student Admit Card</h5>
                    <p class="text-muted small mb-0">Print official CBSE Hall Ticket with exam schedules and student credentials</p>
                </div>
                <a href="{{ route('exam.schedule.view') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="feather icon-arrow-left me-1"></i> Back to Schedule
                </a>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('exam.admitcard.pdf') }}" target="_blank">
                    <div class="mb-3">
                        <label class="form-label">Examination Term <span class="text-danger">*</span></label>
                        <select name="exam_type_id" class="form-control" required>
                            <option value="" disabled selected>Select Examination</option>
                            @foreach($examTypes as $et)
                            <option value="{{ $et->id }}">{{ $et->name }}</option>
                            @endforeach
                        </select>
                    </div>

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

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="feather icon-printer me-1"></i> Generate & Print Admit Card (PDF)
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

