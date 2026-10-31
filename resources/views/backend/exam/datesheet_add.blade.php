@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Schedule Exam Slot</h5>
                    <p class="text-muted small mb-0">Add subject examination date, timing, and seating hall</p>
                </div>
                <a href="{{ route('exam.schedule.view') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="feather icon-arrow-left me-1"></i> Back to Datesheet
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('exam.schedule.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Exam Type / Term <span class="text-danger">*</span></label>
                            <select name="exam_type_id" class="form-control" required>
                                <option value="" disabled selected>Select Exam Term</option>
                                @foreach($examTypes as $et)
                                <option value="{{ $et->id }}">{{ $et->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Target Class <span class="text-danger">*</span></label>
                            <select name="class_id" class="form-control" required>
                                <option value="" disabled selected>Select Class</option>
                                @foreach($classes as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Subject Paper <span class="text-danger">*</span></label>
                            <select name="subject_id" class="form-control" required>
                                <option value="" disabled selected>Select Subject</option>
                                @foreach($subjects as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Exam Date <span class="text-danger">*</span></label>
                            <input type="date" name="exam_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Start Time <span class="text-danger">*</span></label>
                            <input type="time" name="start_time" class="form-control" value="09:00" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">End Time <span class="text-danger">*</span></label>
                            <input type="time" name="end_time" class="form-control" value="12:00" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Exam Room / Hall</label>
                            <input type="text" name="room_no" class="form-control" value="Exam Hall A">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Max / Pass Marks</label>
                            <div class="d-flex gap-2">
                                <input type="number" name="max_marks" class="form-control" value="100" placeholder="Max">
                                <input type="number" name="pass_marks" class="form-control" value="33" placeholder="Pass">
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="feather icon-save me-1"></i> Add to Datesheet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

