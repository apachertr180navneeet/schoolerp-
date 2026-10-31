@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Homework & Daily Assignments</h5>
                    <p class="text-muted small mb-0">Manage digital assignments, due dates, instructions and student submissions</p>
                </div>
                <div>
                    <a href="{{ route('homework.add') }}" class="btn btn-primary btn-sm">
                        <i class="feather icon-plus me-1"></i> Assign New Homework
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Title & Assignment Description</th>
                                <th>Assigned Date</th>
                                <th>Due Date</th>
                                <th>Max Marks</th>
                                <th>Submissions</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $hw)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><span class="badge bg-primary">{{ $hw->student_class->name ?? 'Class' }}</span></td>
                                <td><strong>{{ $hw->school_subject->name ?? 'Subject' }}</strong></td>
                                <td>
                                    <strong>{{ $hw->title }}</strong>
                                    @if($hw->description)
                                    <p class="text-muted small mb-0">{{ Str::limit($hw->description, 60) }}</p>
                                    @endif
                                </td>
                                <td>{{ date('d-M-Y', strtotime($hw->homework_date)) }}</td>
                                <td>
                                    <span class="badge bg-danger">{{ date('d-M-Y', strtotime($hw->submission_date)) }}</span>
                                </td>
                                <td>{{ $hw->max_marks }} Pts</td>
                                <td>
                                    <a href="{{ route('homework.submissions', $hw->id) }}" class="btn btn-sm btn-outline-info">
                                        <i class="feather icon-users me-1"></i> {{ $hw->submissions->count() }} Submissions
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('homework.submissions', $hw->id) }}" class="btn btn-sm btn-info" title="Evaluate">
                                        <i class="feather icon-check-square"></i>
                                    </a>
                                    <a href="{{ route('homework.delete', $hw->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete">
                                        <i class="feather icon-trash-2"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">No homework assignments recorded yet.</td>
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

