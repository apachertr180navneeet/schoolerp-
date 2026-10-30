@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Edit Attendance — {{ $class->name ?? '' }} ({{ date('d-m-Y', strtotime($date)) }})</h5>
                <a href="{{ route('student.attendance.view') }}" class="btn btn-secondary btn-sm">Back</a>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('student.attendance.store') }}">
                    @csrf
                    <input type="hidden" name="class_id" value="{{ $class_id }}">
                    <input type="hidden" name="year_id" value="{{ $editData->first()->year_id ?? 1 }}">
                    <input type="hidden" name="date" value="{{ $date }}">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Student Name</th>
                                    <th width="35%">Attendance Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($editData as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><strong>{{ $item->student->name ?? 'Student' }}</strong></td>
                                    <td>
                                        <input type="hidden" name="student_id[]" value="{{ $item->student_id }}">
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" name="attend_status_{{ $item->student_id }}" id="present_{{ $item->student_id }}" value="Present" {{ $item->attend_status == 'Present' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-success btn-sm" for="present_{{ $item->student_id }}">Present</label>

                                            <input type="radio" class="btn-check" name="attend_status_{{ $item->student_id }}" id="absent_{{ $item->student_id }}" value="Absent" {{ $item->attend_status == 'Absent' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-danger btn-sm" for="absent_{{ $item->student_id }}">Absent</label>

                                            <input type="radio" class="btn-check" name="attend_status_{{ $item->student_id }}" id="leave_{{ $item->student_id }}" value="Leave" {{ $item->attend_status == 'Leave' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-warning btn-sm" for="leave_{{ $item->student_id }}">Leave</label>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary px-4">Update Attendance</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
