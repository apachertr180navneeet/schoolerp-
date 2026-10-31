@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Hostel Bed Allotment</h5>
                    <p class="text-muted small mb-0">Assign student resident to a hostel room</p>
                </div>
                <a href="{{ route('hostel.allotment.view') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="feather icon-arrow-left me-1"></i> Back to Allotments
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('hostel.allotment.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select Student <span class="text-danger">*</span></label>
                        <select name="student_id" class="form-control" required>
                            <option value="" disabled selected>Select Student</option>
                            @foreach($students as $st)
                            <option value="{{ $st->id }}">{{ $st->name }} (ID: {{ $st->id_no }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Select Hostel Room <span class="text-danger">*</span></label>
                            <select name="room_id" class="form-control" required>
                                <option value="" disabled selected>Select Room</option>
                                @foreach($rooms as $r)
                                <option value="{{ $r->id }}">{{ $r->hostel_name }} - Room {{ $r->room_no }} ({{ $r->room_type }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Allotment Date <span class="text-danger">*</span></label>
                            <input type="date" name="allotment_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarks / Special Requirements</label>
                        <textarea name="remarks" class="form-control" rows="3" placeholder="Bed preference, medical notes, etc."></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="feather icon-check me-1"></i> Allot Bed
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

