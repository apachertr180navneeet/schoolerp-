@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Post Circular Notice</h5>
                    <p class="text-muted small mb-0">Create and publish an announcement to students, parents, or staff</p>
                </div>
                <a href="{{ route('notice.view') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="feather icon-arrow-left me-1"></i> Back to Board
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('notice.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Notice Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Annual Sports Day 2026 Schedule & Guidelines" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Notice Type</label>
                            <select name="notice_type" class="form-control">
                                <option value="Circular">General Circular</option>
                                <option value="Holiday">Holiday Announcement</option>
                                <option value="Exam">Examination Schedule</option>
                                <option value="Event">School Event</option>
                                <option value="Urgent">Urgent / Alert</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Target Audience <span class="text-danger">*</span></label>
                            <select name="target_audience" class="form-control" required>
                                <option value="All">All (Students, Parents, Teachers)</option>
                                <option value="Students">Students Only</option>
                                <option value="Parents">Parents Only</option>
                                <option value="Teachers">Staff & Teachers</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Publish Date <span class="text-danger">*</span></label>
                            <input type="date" name="publish_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Expiry Date (Optional)</label>
                            <input type="date" name="expiry_date" class="form-control" value="{{ date('Y-m-d', strtotime('+15 days')) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Detailed Notice Content <span class="text-danger">*</span></label>
                        <textarea name="message" class="form-control" rows="6" placeholder="Write the full circular body with instructions and schedules..." required></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="feather icon-send me-1"></i> Publish Circular
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

