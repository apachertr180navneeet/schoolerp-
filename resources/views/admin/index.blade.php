@php
    $students = DB::table('users')->where('usertype','Student')->count();
    $employees = DB::table('users')->where('usertype','Employee')->count();
    $classes = DB::table('student_classes')->count();
    $subjects = DB::table('school_subjects')->count();
@endphp

@extends('admin.admin_master')
@section('admin')

<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('student.registration.view') }}" class="stat-card" style="background: linear-gradient(135deg, #0ea5e9, #3b82f6);">
            <div class="stat-icon"><i class="bi bi-mortarboard"></i></div>
            <div class="stat-content">
                <div class="stat-label">Total Students</div>
                <div class="stat-value">{{ $students }}</div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('employee.registration.view') }}" class="stat-card" style="background: linear-gradient(135deg, #10b981, #059669);">
            <div class="stat-icon"><i class="bi bi-people"></i></div>
            <div class="stat-content">
                <div class="stat-label">Total Employees</div>
                <div class="stat-value">{{ $employees }}</div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('student.class.view') }}" class="stat-card" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
            <div class="stat-icon"><i class="bi bi-book"></i></div>
            <div class="stat-content">
                <div class="stat-label">Total Classes</div>
                <div class="stat-value">{{ $classes }}</div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('school.subject.view') }}" class="stat-card" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
            <div class="stat-icon"><i class="bi bi-journal-text"></i></div>
            <div class="stat-content">
                <div class="stat-label">Total Subjects</div>
                <div class="stat-value">{{ $subjects }}</div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3 col-6">
                        <a href="{{ route('student.registration.add') }}" class="btn btn-outline-primary w-100 py-3">
                            <i class="bi bi-person-plus fs-4 d-block mb-2"></i>
                            <span>Add Student</span>
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="{{ route('employee.registration.add') }}" class="btn btn-outline-success w-100 py-3">
                            <i class="bi bi-person-plus fs-4 d-block mb-2"></i>
                            <span>Add Employee</span>
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="{{ route('marks.entry.add') }}" class="btn btn-outline-warning w-100 py-3">
                            <i class="bi bi-pencil-square fs-4 d-block mb-2"></i>
                            <span>Enter Marks</span>
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="{{ route('account.salary.view') }}" class="btn btn-outline-info w-100 py-3">
                            <i class="bi bi-wallet2 fs-4 d-block mb-2"></i>
                            <span>Accounts</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="bi bi-mortarboard me-2 text-primary"></i>Recent Students</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>ID No</th>
                                <th>Class</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $recentStudents = DB::table('users')
                                    ->join('assign_students','users.id','=','assign_students.student_id')
                                    ->join('student_classes','assign_students.class_id','=','student_classes.id')
                                    ->where('users.usertype','Student')
                                    ->select('users.name','users.id_no','student_classes.name as class')
                                    ->orderBy('users.id','desc')
                                    ->take(5)
                                    ->get();
                            @endphp
                            @foreach($recentStudents as $s)
                            <tr>
                                <td>{{ $s->name }}</td>
                                <td>{{ $s->id_no }}</td>
                                <td><span class="badge bg-soft-primary text-primary">{{ $s->class }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="bi bi-people me-2 text-success"></i>Recent Employees</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>ID No</th>
                                <th>Designation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $recentEmployees = DB::table('users')
                                    ->join('designations','users.designation_id','=','designations.id')
                                    ->where('users.usertype','Employee')
                                    ->select('users.name','users.id_no','designations.name as designation')
                                    ->orderBy('users.id','desc')
                                    ->take(5)
                                    ->get();
                            @endphp
                            @foreach($recentEmployees as $e)
                            <tr>
                                <td>{{ $e->name }}</td>
                                <td>{{ $e->id_no }}</td>
                                <td><span class="badge bg-soft-success text-success">{{ $e->designation }}</span></td>
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
