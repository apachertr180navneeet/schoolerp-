@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Student Daily Attendance Logs</h5>
                    <p class="text-muted small mb-0">Record and review student attendance rosters by class and session</p>
                </div>
                <a href="{{ route('student.attendance.add') }}" class="btn btn-success btn-sm">
                    <i class="feather icon-plus me-1"></i> Take Attendance
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="8%">SL</th>
                                <th>Date</th>
                                <th>Class</th>
                                <th width="25%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><strong>{{ date('d-m-Y', strtotime($item->date)) }}</strong></td>
                                <td><span class="badge bg-primary fs-6">{{ $item->student_class->name ?? 'Class' }}</span></td>
                                <td>
                                    <a href="{{ route('student.attendance.edit', ['date' => $item->date, 'class_id' => $item->class_id]) }}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{ route('student.attendance.details', ['date' => $item->date, 'class_id' => $item->class_id]) }}" class="btn btn-secondary btn-sm">View Roster</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No student attendance recorded yet. Click "Take Attendance" to begin.</td>
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

