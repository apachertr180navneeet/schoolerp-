@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Add Hostel Room</h5>
                    <p class="text-muted small mb-0">Define room details, occupancy capacity and monthly charges</p>
                </div>
                <a href="{{ route('hostel.room.view') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="feather icon-arrow-left me-1"></i> Back to Rooms
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('hostel.room.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hostel Block / Name <span class="text-danger">*</span></label>
                            <input type="text" name="hostel_name" class="form-control" value="Boys Hostel - Tagore Wing" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Room Number <span class="text-danger">*</span></label>
                            <input type="text" name="room_no" class="form-control" placeholder="e.g. 101, B-204" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Room Type</label>
                            <select name="room_type" class="form-control">
                                <option value="Standard Non-AC">Standard Non-AC</option>
                                <option value="Standard AC" selected>Standard AC</option>
                                <option value="Deluxe 2-Seater">Deluxe 2-Seater</option>
                                <option value="Dormitory (4-Seater)">Dormitory (4-Seater)</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Bed Capacity <span class="text-danger">*</span></label>
                            <input type="number" name="capacity" class="form-control" value="3" min="1" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Monthly Cost per Bed (₹) <span class="text-danger">*</span></label>
                            <input type="number" name="cost_per_bed" class="form-control" value="3500" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Facilities & Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Attached bathroom, study table, balcony, etc."></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="feather icon-save me-1"></i> Save Room
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

