@php
    $students = DB::table('users')->where('usertype','Student')->count();
    $employees = DB::table('users')->where('usertype','Employee')->count();
    $classes = DB::table('student_classes')->count();
    $subjects = DB::table('school_subjects')->count();
    $enquiries = DB::table('admission_enquiries')->count();
    $books = DB::table('books')->count();
    $buses = DB::table('transport_vehicles')->count();
    $school = DB::table('school_settings')->first();
@endphp

@extends('admin.admin_master')
@section('admin')

<!-- Hero Institution Banner -->
<div class="card mb-4 border-0 shadow-sm" style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 45%, #4338ca 100%); color: #ffffff; border-radius: 16px;">
    <div class="card-body p-4 p-md-5 position-relative overflow-hidden">
        <div class="row align-items-center position-relative" style="z-index: 2;">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge bg-white text-primary fw-bold px-3 py-1 rounded-pill">
                        <i class="bi bi-shield-check me-1"></i> {{ $school->board ?? 'CBSE' }} Affiliated
                    </span>
                    <span class="badge bg-white-50 text-white fw-semibold px-2 py-1 rounded-pill">
                        Session: {{ $school->academic_session ?? '2026-2027' }}
                    </span>
                </div>
                <h2 class="fw-bold mb-2 text-white" style="letter-spacing: -0.02em;">
                    {{ $school->school_name ?? 'Shiksha Mitra Public School' }}
                </h2>
                <p class="text-white-50 mb-0 fs-6">
                    Integrated Campus ERP & Academic Management Portal. Institution Code: <strong>{{ $school->school_code ?? 'SMPS-1029' }}</strong>
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <div class="d-inline-flex flex-column align-items-lg-end bg-white bg-opacity-10 backdrop-blur p-3 rounded-3 border border-white border-opacity-10">
                    <span class="small text-white-50">Current Academic Date</span>
                    <span class="fs-5 fw-bold text-white">{{ date('l, d F Y') }}</span>
                    <span class="badge bg-success mt-1"><i class="bi bi-circle-fill me-1" style="font-size: 6px;"></i> Term Active</span>
                </div>
            </div>
        </div>
        <!-- Decorative Glow Orbs -->
        <div style="position: absolute; right: -80px; top: -80px; width: 280px; height: 280px; border-radius: 50%; background: radial-gradient(circle, rgba(99, 102, 241, 0.4) 0%, transparent 70%); pointer-events: none;"></div>
        <div style="position: absolute; left: 20%; bottom: -100px; width: 200px; height: 200px; border-radius: 50%; background: radial-gradient(circle, rgba(56, 189, 248, 0.3) 0%, transparent 70%); pointer-events: none;"></div>
    </div>
</div>

<!-- 4 Modern Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('student.registration.view') }}" class="stat-card-modern primary">
            <div class="icon-box">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <div class="stat-meta">
                <div class="label">Total Students</div>
                <div class="value">{{ $students }}</div>
            </div>
            <div class="stat-trend">
                <i class="bi bi-graph-up-arrow"></i> Active
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{ route('employee.registration.view') }}" class="stat-card-modern success">
            <div class="icon-box">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-meta">
                <div class="label">Total Faculty</div>
                <div class="value">{{ $employees }}</div>
            </div>
            <div class="stat-trend">
                <i class="bi bi-shield-check"></i> 100% On Duty
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{ route('student.class.view') }}" class="stat-card-modern warning">
            <div class="icon-box">
                <i class="bi bi-door-open-fill"></i>
            </div>
            <div class="stat-meta">
                <div class="label">Active Classes</div>
                <div class="value">{{ $classes }}</div>
            </div>
            <div class="stat-trend">
                <i class="bi bi-layers"></i> 4 Sections
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{ route('school.subject.view') }}" class="stat-card-modern danger">
            <div class="icon-box">
                <i class="bi bi-journal-bookmark-fill"></i>
            </div>
            <div class="stat-meta">
                <div class="label">Curriculum Master</div>
                <div class="value">{{ $subjects }}</div>
            </div>
            <div class="stat-trend">
                <i class="bi bi-check-circle"></i> CBSE Compliant
            </div>
        </a>
    </div>
</div>

<!-- Quick Actions Panel -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0">Quick Operations & Shortcuts</h5>
                    <p class="text-muted small mb-0">Fast access to everyday institutional tasks and student workflows</p>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-xl-2 col-md-4 col-6">
                        <a href="{{ route('student.registration.add') }}" class="quick-action-btn">
                            <div class="action-icon bg-primary-subtle text-primary">
                                <i class="bi bi-person-plus-fill"></i>
                            </div>
                            <span class="action-title">Enroll Student</span>
                        </a>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6">
                        <a href="{{ route('student.attendance.add') }}" class="quick-action-btn">
                            <div class="action-icon bg-success-subtle text-success">
                                <i class="bi bi-calendar-check-fill"></i>
                            </div>
                            <span class="action-title">Take Attendance</span>
                        </a>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6">
                        <a href="{{ route('admission.enquiry.add') }}" class="quick-action-btn">
                            <div class="action-icon bg-info-subtle text-info">
                                <i class="bi bi-chat-left-dots-fill"></i>
                            </div>
                            <span class="action-title">New Enquiry</span>
                        </a>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6">
                        <a href="{{ route('academic.timetable.view') }}" class="quick-action-btn">
                            <div class="action-icon bg-warning-subtle text-warning">
                                <i class="bi bi-calendar3"></i>
                            </div>
                            <span class="action-title">Class Timetable</span>
                        </a>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6">
                        <a href="{{ route('library.book.view') }}" class="quick-action-btn">
                            <div class="action-icon" style="background: #f3e8ff; color: #9333ea;">
                                <i class="bi bi-book-half"></i>
                            </div>
                            <span class="action-title">Library Books</span>
                        </a>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6">
                        <a href="{{ route('transport.vehicle.view') }}" class="quick-action-btn">
                            <div class="action-icon" style="background: #ffedd5; color: #ea580c;">
                                <i class="bi bi-bus-front-fill"></i>
                            </div>
                            <span class="action-title">School Fleet</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Records Tables -->
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0"><i class="bi bi-mortarboard me-2 text-primary"></i>Recently Registered Students</h5>
                    <small class="text-muted">Enrolled in current academic term</small>
                </div>
                <a href="{{ route('student.registration.view') }}" class="btn btn-outline-primary btn-sm">View Directory</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Scholar / ID</th>
                                <th>Class</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $recentStudents = DB::table('users')
                                    ->join('assign_students','users.id','=','assign_students.student_id')
                                    ->join('student_classes','assign_students.class_id','=','student_classes.id')
                                    ->where('users.usertype','Student')
                                    ->select('users.id','users.name','users.id_no','student_classes.name as class')
                                    ->orderBy('users.id','desc')
                                    ->take(5)
                                    ->get();

                                $colors = ['#4f46e5', '#0ea5e9', '#10b981', '#f59e0b', '#ec4899'];
                            @endphp
                            @foreach($recentStudents as $idx => $s)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-pill" style="background: {{ $colors[$idx % count($colors)] }};">
                                            {{ strtoupper(substr($s->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $s->name }}</div>
                                            <small class="text-muted">Active Student</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-secondary font-monospace">{{ $s->id_no }}</span></td>
                                <td><span class="badge bg-primary">{{ $s->class }}</span></td>
                                <td class="text-end">
                                    <a href="{{ route('student.registration.details', $s->id) }}" target="_blank" class="btn btn-light btn-sm text-primary" title="View Profile PDF">
                                        <i class="bi bi-file-earmark-person"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0"><i class="bi bi-people me-2 text-success"></i>Teaching & Staff Roster</h5>
                    <small class="text-muted">Active faculty and administrative staff</small>
                </div>
                <a href="{{ route('employee.registration.view') }}" class="btn btn-outline-success btn-sm">Staff Directory</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Staff Member</th>
                                <th>Employee Code</th>
                                <th>Designation</th>
                                <th class="text-end">Status</th>
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

                                $empColors = ['#059669', '#d97706', '#dc2626', '#7c3aed', '#0284c7'];
                            @endphp
                            @foreach($recentEmployees as $idx => $e)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-pill" style="background: {{ $empColors[$idx % count($empColors)] }};">
                                            {{ strtoupper(substr($e->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $e->name }}</div>
                                            <small class="text-muted">Faculty Member</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-secondary font-monospace">{{ $e->id_no }}</span></td>
                                <td><span class="badge bg-success">{{ $e->designation }}</span></td>
                                <td class="text-end">
                                    <span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i>Active</span>
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
