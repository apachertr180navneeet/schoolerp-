@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">School Transport Fleet & Vehicles</h5>
                    <p class="text-muted small mb-0">Manage school buses, vans, drivers, seating capacity, and route assignments</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('transport.route.view') }}" class="btn btn-outline-primary btn-sm">Bus Routes</a>
                    <a href="{{ route('transport.student.view') }}" class="btn btn-outline-info btn-sm">Allocated Students</a>
                    <a href="{{ route('transport.vehicle.add') }}" class="btn btn-success btn-sm">
                        <i class="feather icon-plus me-1"></i> Add Vehicle
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">SL</th>
                                <th>Vehicle No</th>
                                <th>Vehicle Model</th>
                                <th>Driver Name</th>
                                <th>Driver Phone</th>
                                <th>Seating Capacity</th>
                                <th>Assigned Route</th>
                                <th>Status</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $vehicle)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><span class="badge bg-secondary">{{ $vehicle->vehicle_number }}</span></td>
                                <td>{{ $vehicle->vehicle_model ?? 'Standard Bus' }}</td>
                                <td><strong>{{ $vehicle->driver_name ?? 'N/A' }}</strong></td>
                                <td>{{ $vehicle->driver_phone ?? 'N/A' }}</td>
                                <td>{{ $vehicle->capacity }} Seats</td>
                                <td>{{ $vehicle->route->route_title ?? 'Unassigned' }}</td>
                                <td>
                                    @if($vehicle->status == 'Active')
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-warning text-dark">{{ $vehicle->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('transport.vehicle.edit', $vehicle->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{ route('transport.vehicle.delete', $vehicle->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">No transport vehicles registered yet.</td>
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
