@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Allocate Transport to Student</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('transport.student.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Select Student <span class="text-danger">*</span></label>
                            <select name="student_id" class="form-select" required>
                                <option value="" disabled selected>Choose a student...</option>
                                @foreach($students as $st)
                                <option value="{{ $st->id }}">{{ $st->name }} (ID: {{ $st->id_no ?? $st->id }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Select Bus Route <span class="text-danger">*</span></label>
                            <select name="route_id" class="form-select" required>
                                <option value="" disabled selected>Choose a route...</option>
                                @foreach($routes as $rt)
                                <option value="{{ $rt->id }}">{{ $rt->route_title }} — ₹{{ $rt->fare }}/mo</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Assigned Vehicle (Optional)</label>
                            <select name="vehicle_id" class="form-select">
                                <option value="">Auto / Any Available Vehicle</option>
                                @foreach($vehicles as $vh)
                                <option value="{{ $vh->id }}">{{ $vh->vehicle_number }} ({{ $vh->driver_name ?? 'Driver' }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Pickup / Drop Point</label>
                            <input type="text" name="pickup_point" class="form-control" placeholder="e.g. Sector 15 Main Crossing">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Monthly Fee Charged (₹)</label>
                            <input type="number" name="monthly_fee" class="form-control" value="1200">
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">Assign Transport</button>
                        <a href="{{ route('transport.student.view') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
