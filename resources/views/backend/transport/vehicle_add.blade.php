@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Register Transport Vehicle</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('transport.vehicle.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Registration / Vehicle Number <span class="text-danger">*</span></label>
                            <input type="text" name="vehicle_number" class="form-control" placeholder="e.g. DL-01-AB-1234" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Vehicle Model / Make</label>
                            <input type="text" name="vehicle_model" class="form-control" placeholder="e.g. Tata Starbus 40-Seater">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Driver Name</label>
                            <input type="text" name="driver_name" class="form-control" placeholder="Full name of driver">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Driver Phone</label>
                            <input type="text" name="driver_phone" class="form-control" placeholder="+91 98765 43210">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Driver License Number</label>
                            <input type="text" name="driver_license" class="form-control" placeholder="Commercial DL number">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold">Passenger Capacity <span class="text-danger">*</span></label>
                            <input type="number" name="capacity" class="form-control" value="35" min="1" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold">Status</label>
                            <select name="status" class="form-select">
                                <option value="Active">Active</option>
                                <option value="Under Maintenance">Under Maintenance</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label font-weight-bold">Assign to Route</label>
                            <select name="route_id" class="form-select">
                                <option value="">No Route Assigned</option>
                                @foreach($routes as $route)
                                <option value="{{ $route->id }}">{{ $route->route_title }} (Fare: ₹{{ $route->fare }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">Save Vehicle</button>
                        <a href="{{ route('transport.vehicle.view') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
