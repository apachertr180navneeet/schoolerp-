@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body bg-light rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 text-primary">{{ $homework->title }}</h4>
                        <p class="mb-0 text-muted">
                            Class: <strong>{{ $homework->student_class->name ?? '' }}</strong> | 
                            Subject: <strong>{{ $homework->school_subject->name ?? '' }}</strong> | 
                            Due: <strong>{{ date('d-M-Y', strtotime($homework->submission_date)) }}</strong> |
                            Max Marks: <strong>{{ $homework->max_marks }}</strong>
                        </p>
                    </div>
                    <a href="{{ route('homework.view') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="feather icon-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Student Submissions & Evaluation</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>Student Name</th>
                                <th>Submission Date</th>
                                <th>Status</th>
                                <th>Marks Obtained</th>
                                <th>Teacher Feedback</th>
                                <th width="20%">Grade / Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($submissions as $key => $sub)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><strong>{{ $sub->student->name ?? 'Student' }}</strong></td>
                                <td>{{ $sub->submitted_at ? date('d-M-Y H:i', strtotime($sub->submitted_at)) : '-' }}</td>
                                <td>
                                    @if($sub->status == 'Graded')
                                    <span class="badge bg-success">Graded</span>
                                    @elseif($sub->status == 'Submitted')
                                    <span class="badge bg-primary">Submitted</span>
                                    @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td><strong>{{ $sub->marks_obtained ?? '-' }}</strong> / {{ $homework->max_marks }}</td>
                                <td>{{ $sub->remarks ?? 'No feedback given' }}</td>
                                <td>
                                    <form method="POST" action="{{ route('homework.grade.store', $sub->id) }}" class="d-flex gap-2">
                                        @csrf
                                        <input type="number" name="marks_obtained" value="{{ $sub->marks_obtained }}" class="form-control form-control-sm" placeholder="Marks" style="width: 80px;" max="{{ $homework->max_marks }}">
                                        <input type="text" name="remarks" value="{{ $sub->remarks }}" class="form-control form-control-sm" placeholder="Feedback">
                                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No submissions received yet for this homework assignment.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
