@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Student Leave Applications</h5>
                    <p class="text-muted small mb-0">Review student absence requests, medical leaves, and approval status</p>
                </div>
                <div>
                    <a href="{{ route('student.leave.add') }}" class="btn btn-primary btn-sm">
                        <i class="feather icon-plus me-1"></i> Apply for Leave
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Reason for Absence</th>
                                <th>Status</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $l)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><strong>{{ $l->student->name ?? 'Student' }}</strong></td>
                                <td>{{ $l->student_class->name ?? '' }}</td>
                                <td>{{ date('d-M-Y', strtotime($l->start_date)) }}</td>
                                <td>{{ date('d-M-Y', strtotime($l->end_date)) }}</td>
                                <td>{{ $l->reason }}</td>
                                <td>
                                    @if($l->status == 'Approved')
                                    <span class="badge bg-success">Approved</span>
                                    @elseif($l->status == 'Rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                    @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if($l->status == 'Pending')
                                    <a href="{{ route('student.leave.approve', $l->id) }}" class="btn btn-sm btn-success" title="Approve">
                                        <i class="feather icon-check"></i>
                                    </a>
                                    <a href="{{ route('student.leave.reject', $l->id) }}" class="btn btn-sm btn-danger" title="Reject">
                                        <i class="feather icon-x"></i>
                                    </a>
                                    @else
                                    <span class="text-muted small">Decided</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No student leave applications.</td>
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

