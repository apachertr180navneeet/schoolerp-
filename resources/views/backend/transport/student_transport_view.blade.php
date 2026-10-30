@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Student Transport Allocations</h5>
                    <p class="text-muted small mb-0">Roster of students subscribed to bus services with pickup points and assigned vehicles</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('transport.vehicle.view') }}" class="btn btn-outline-secondary btn-sm">Buses</a>
                    <a href="{{ route('transport.route.view') }}" class="btn btn-outline-secondary btn-sm">Routes</a>
                    <a href="{{ route('transport.student.add') }}" class="btn btn-success btn-sm">
                        <i class="feather icon-plus me-1"></i> Allocate Transport
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">SL</th>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Assigned Route</th>
                                <th>Bus / Vehicle</th>
                                <th>Pickup Point</th>
                                <th>Monthly Fare</th>
                                <th width="12%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><span class="badge bg-secondary">{{ $row->student->id_no ?? 'N/A' }}</span></td>
                                <td><strong>{{ $row->student->name ?? 'Student' }}</strong></td>
                                <td>{{ $row->route->route_title ?? 'N/A' }}</td>
                                <td><span class="badge bg-info text-dark">{{ $row->vehicle->vehicle_number ?? 'Auto-assigned' }}</span></td>
                                <td>{{ $row->pickup_point ?? 'Standard Stop' }}</td>
                                <td>₹{{ number_format($row->monthly_fee, 2) }}</td>
                                <td>
                                    <a href="{{ route('transport.student.delete', $row->id) }}" class="btn btn-danger btn-sm" id="delete">Remove</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No student transport allocations found.</td>
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
