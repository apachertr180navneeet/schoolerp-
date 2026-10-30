@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Attendance Roster — {{ $class->name ?? '' }}</h5>
                    <p class="text-muted small mb-0">Date: {{ date('d F, Y', strtotime($date)) }}</p>
                </div>
                <a href="{{ route('student.attendance.view') }}" class="btn btn-secondary btn-sm">Back to Logs</a>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded text-center border-start border-success border-4">
                            <h4 class="text-success mb-0">{{ $details->where('attend_status', 'Present')->count() }}</h4>
                            <small class="text-muted">Present Students</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded text-center border-start border-danger border-4">
                            <h4 class="text-danger mb-0">{{ $details->where('attend_status', 'Absent')->count() }}</h4>
                            <small class="text-muted">Absent Students</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded text-center border-start border-warning border-4">
                            <h4 class="text-warning mb-0">{{ $details->where('attend_status', 'Leave')->count() }}</h4>
                            <small class="text-muted">On Leave</small>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="8%">SL</th>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->student->id_no ?? 'N/A' }}</td>
                                <td>{{ $row->student->name ?? 'Student' }}</td>
                                <td>
                                    @if($row->attend_status == 'Present')
                                    <span class="badge bg-success">Present</span>
                                    @elseif($row->attend_status == 'Absent')
                                    <span class="badge bg-danger">Absent</span>
                                    @else
                                    <span class="badge bg-warning text-dark">Leave</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

