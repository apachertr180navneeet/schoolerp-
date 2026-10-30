@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12 mb-3">
        <div class="p-4 rounded text-white" style="background: linear-gradient(135deg, #1e3a8a 0%, #0284c7 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="badge bg-warning text-dark mb-2">Student Portal</span>
                    <h3 class="mb-1 text-white">Hello, {{ $student->student->name ?? 'Student' }}!</h3>
                    <p class="mb-0 text-white-50">Class: <strong>{{ $student->student_class->name ?? 'Class 10' }}</strong> | Roll No: <strong>{{ $student->roll ?? '01' }}</strong></p>
                </div>
                <div class="text-end">
                    <span class="badge bg-light text-dark fs-6 py-2 px-3">Session 2026-27</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Homework Assignments -->
    <div class="col-md-7 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">My Assignments & Homework</h5>
                <span class="badge bg-primary">{{ $homeworks->count() }} Active</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Subject</th>
                                <th>Assignment</th>
                                <th>Due Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($homeworks as $hw)
                            <tr>
                                <td><span class="badge bg-info text-dark">{{ $hw->school_subject->name ?? 'Subject' }}</span></td>
                                <td>
                                    <strong>{{ $hw->title }}</strong>
                                    <p class="text-muted small mb-0">{{ Str::limit($hw->description, 50) }}</p>
                                </td>
                                <td><span class="badge bg-danger">{{ date('d-M', strtotime($hw->submission_date)) }}</span></td>
                                <td>
                                    <a href="{{ route('homework.submissions', $hw->id) }}" class="btn btn-sm btn-outline-primary">
                                        View / Submit
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No assignments due!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Exam Performance & Quick Links -->
    <div class="col-md-5 mb-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Recent Exam Scores</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($marks as $m)
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <div>
                            <strong>{{ $m->assign_subject->school_subject->name ?? ($m->subject->name ?? 'Subject') }}</strong>
                            <p class="text-muted small mb-0">{{ $m->exam_type->name ?? 'Exam' }}</p>
                        </div>
                        <span class="badge bg-success fs-6">{{ $m->marks }} Pts</span>
                    </li>
                    @empty
                    <li class="list-group-item text-muted">Scores will appear once published.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Campus Circulars</h5>
            </div>
            <div class="card-body">
                @foreach($notices as $n)
                <div class="mb-3 pb-2 border-bottom">
                    <strong>{{ $n->title }}</strong>
                    <p class="text-muted small mb-0">{{ Str::limit($n->message, 70) }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
