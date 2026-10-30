@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Record Student Attendance</h5>
            </div>
            <div class="card-body">
                <form method="get" action="{{ route('student.attendance.add') }}" class="mb-4 p-3 bg-light rounded border">
                    <div class="row align-items-end g-3">
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">Academic Year</label>
                            <select name="year_id" class="form-select" required>
                                @foreach($years as $yr)
                                <option value="{{ $yr->id }}" {{ $selected_year == $yr->id ? 'selected' : '' }}>{{ $yr->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">Class</label>
                            <select name="class_id" class="form-select" required>
                                @foreach($classes as $cls)
                                <option value="{{ $cls->id }}" {{ $selected_class == $cls->id ? 'selected' : '' }}>{{ $cls->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-dark w-100">Load Students</button>
                        </div>
                    </div>
                </form>

                @if(!empty($students) && count($students) > 0)
                <form method="post" action="{{ route('student.attendance.store') }}">
                    @csrf
                    <input type="hidden" name="class_id" value="{{ $selected_class }}">
                    <input type="hidden" name="year_id" value="{{ $selected_year }}">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">Attendance Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Roll No</th>
                                    <th width="35%">Attendance Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $key => $row)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $row->student->id_no ?? 'N/A' }}</td>
                                    <td><strong>{{ $row->student->name ?? 'Student' }}</strong></td>
                                    <td>{{ $row->roll ?? ($key + 1) }}</td>
                                    <td>
                                        <input type="hidden" name="student_id[]" value="{{ $row->student_id }}">
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" name="attend_status_{{ $row->student_id }}" id="present_{{ $row->student_id }}" value="Present" checked>
                                            <label class="btn btn-outline-success btn-sm" for="present_{{ $row->student_id }}">Present</label>

                                            <input type="radio" class="btn-check" name="attend_status_{{ $row->student_id }}" id="absent_{{ $row->student_id }}" value="Absent">
                                            <label class="btn btn-outline-danger btn-sm" for="absent_{{ $row->student_id }}">Absent</label>

                                            <input type="radio" class="btn-check" name="attend_status_{{ $row->student_id }}" id="leave_{{ $row->student_id }}" value="Leave">
                                            <label class="btn btn-outline-warning btn-sm" for="leave_{{ $row->student_id }}">Leave</label>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary px-4">Save Attendance</button>
                        <a href="{{ route('student.attendance.view') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
                @else
                <div class="alert alert-info">
                    Please select a Class and Year to load enrolled students roster.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
