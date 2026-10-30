@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Add Timetable Class Period</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('academic.timetable.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Day of Week <span class="text-danger">*</span></label>
                            <select name="day_of_week" class="form-select" required>
                                @foreach($days as $day)
                                <option value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Class <span class="text-danger">*</span></label>
                            <select name="class_id" class="form-select" required>
                                @foreach($classes as $cls)
                                <option value="{{ $cls->id }}">{{ $cls->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Section</label>
                            <select name="section_id" class="form-select">
                                <option value="">All Sections</option>
                                @foreach($sections as $sec)
                                <option value="{{ $sec->id }}">Section {{ $sec->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Subject <span class="text-danger">*</span></label>
                            <select name="subject_id" class="form-select" required>
                                @foreach($subjects as $sub)
                                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Teacher / Faculty</label>
                            <select name="teacher_id" class="form-select">
                                <option value="">Select Teacher</option>
                                @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Room / Hall Number</label>
                            <input type="text" name="room_no" class="form-control" placeholder="e.g. Room 102, Science Lab">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Period Start Time <span class="text-danger">*</span></label>
                            <input type="time" name="start_time" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Period End Time <span class="text-danger">*</span></label>
                            <input type="time" name="end_time" class="form-control" required>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">Save Period Slot</button>
                        <a href="{{ route('academic.timetable.view') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

