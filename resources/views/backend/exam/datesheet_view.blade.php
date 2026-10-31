@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Examination Datesheet & Schedule</h5>
                    <p class="text-muted small mb-0">CBSE exam timetable, subject paper timings, room halls, and max marks</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('exam.admitcard.view') }}" class="btn btn-outline-primary btn-sm">
                        <i class="feather icon-printer me-1"></i> Generate Admit Cards
                    </a>
                    <a href="{{ route('exam.schedule.add') }}" class="btn btn-primary btn-sm">
                        <i class="feather icon-plus me-1"></i> Add Datesheet Slot
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>Exam Term</th>
                                <th>Class</th>
                                <th>Subject Paper</th>
                                <th>Exam Date</th>
                                <th>Timing</th>
                                <th>Room / Hall</th>
                                <th>Max / Pass</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><span class="badge bg-primary">{{ $row->exam_type->name ?? 'Exam' }}</span></td>
                                <td><strong>{{ $row->student_class->name ?? 'Class' }}</strong></td>
                                <td><strong>{{ $row->school_subject->name ?? 'Subject' }}</strong></td>
                                <td>{{ date('d-M-Y', strtotime($row->exam_date)) }} ({{ date('l', strtotime($row->exam_date)) }})</td>
                                <td><span class="badge bg-secondary">{{ $row->start_time }} - {{ $row->end_time }}</span></td>
                                <td>{{ $row->room_no }}</td>
                                <td>{{ $row->max_marks }} / {{ $row->pass_marks }}</td>
                                <td>
                                    <a href="{{ route('exam.schedule.delete', $row->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete">
                                        <i class="feather icon-trash-2"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">No examination slots scheduled.</td>
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

