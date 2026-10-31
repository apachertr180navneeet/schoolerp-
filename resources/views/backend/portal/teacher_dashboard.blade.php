@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12 mb-3">
        <div class="p-4 rounded text-white" style="background: linear-gradient(135deg, #065f46 0%, #059669 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="badge bg-light text-dark mb-2">Teacher Workspace</span>
                    <h3 class="mb-1 text-white">Faculty Dashboard</h3>
                    <p class="mb-0 text-white-50">Manage class curriculum, daily homework, attendance rosters, and student leave requests</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('homework.add') }}" class="btn btn-light btn-sm fw-bold">
                        <i class="feather icon-plus me-1"></i> Assign Homework
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Leave Approvals -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Student Leave Requests (Pending Action)</h5>
                <span class="badge bg-warning text-dark">{{ $pendingLeaves->count() }} Pending</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Student</th>
                                <th>Duration</th>
                                <th>Reason</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingLeaves as $pl)
                            <tr>
                                <td><strong>{{ $pl->student->name ?? 'Student' }}</strong></td>
                                <td>{{ date('d-M', strtotime($pl->start_date)) }} to {{ date('d-M', strtotime($pl->end_date)) }}</td>
                                <td>{{ $pl->reason }}</td>
                                <td>
                                    <a href="{{ route('student.leave.approve', $pl->id) }}" class="btn btn-sm btn-success">Approve</a>
                                    <a href="{{ route('student.leave.reject', $pl->id) }}" class="btn btn-sm btn-danger">Reject</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No pending student leaves.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Homework Evaluator -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Recently Assigned Homework</h5>
                <a href="{{ route('homework.view') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($homeworks as $hw)
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <div>
                            <strong>{{ $hw->title }}</strong>
                            <p class="text-muted small mb-0">{{ $hw->student_class->name ?? '' }} - {{ $hw->school_subject->name ?? '' }} | Due: {{ date('d-M', strtotime($hw->submission_date)) }}</p>
                        </div>
                        <a href="{{ route('homework.submissions', $hw->id) }}" class="btn btn-sm btn-outline-info">
                            Evaluate
                        </a>
                    </li>
                    @empty
                    <li class="list-group-item text-muted">No homework posted.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

