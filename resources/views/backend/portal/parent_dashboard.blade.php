@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12 mb-3">
        <div class="p-4 rounded text-white" style="background: linear-gradient(135deg, #090d16 0%, #1e293b 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="badge bg-primary mb-2">Parent Portal</span>
                    <h3 class="mb-1 text-white">Welcome, Parent of {{ $student->student->name ?? 'Aarav Sharma' }}</h3>
                    <p class="mb-0 text-white-50">Class: <strong>{{ $student->student_class->name ?? 'Class 10' }}</strong> | Admission ID: <strong>{{ $student->student->id_no ?? '2026-STU-001' }}</strong></p>
                </div>
                <div class="text-end">
                    <span class="badge bg-success fs-6 py-2 px-3"><i class="feather icon-check-circle me-1"></i> Attendance: 94.2%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Metrics -->
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="p-3 rounded bg-primary-subtle text-primary me-3">
                        <i class="feather icon-book fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Active Homeworks</h6>
                        <h4 class="mb-0">{{ $recentHomeworks->count() }} Tasks</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="p-3 rounded bg-warning-subtle text-warning me-3">
                        <i class="feather icon-credit-card fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Fee Invoices</h6>
                        <h4 class="mb-0">{{ $fees->count() }} Records</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="p-3 rounded bg-info-subtle text-info me-3">
                        <i class="feather icon-bell fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">School Circulars</h6>
                        <h4 class="mb-0">{{ $notices->count() }} Notices</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Tasks & Notices -->
    <div class="col-md-7 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Assigned Homework & Due Dates</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($recentHomeworks as $hw)
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <div>
                            <strong>{{ $hw->title }}</strong>
                            <p class="text-muted small mb-0">{{ $hw->school_subject->name ?? 'General' }} | Due: {{ date('d-M-Y', strtotime($hw->submission_date)) }}</p>
                        </div>
                        <span class="badge bg-secondary">{{ $hw->max_marks }} Pts</span>
                    </li>
                    @empty
                    <li class="list-group-item text-muted">No pending homework.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-5 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Official Circulars & Alerts</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($notices as $n)
                    <li class="list-group-item px-0">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong>{{ $n->title }}</strong>
                            <span class="badge bg-info text-dark">{{ $n->notice_type }}</span>
                        </div>
                        <p class="text-muted small mb-0">{{ Str::limit($n->message, 80) }}</p>
                    </li>
                    @empty
                    <li class="list-group-item text-muted">No circulars.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
