@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Transport Routes & Stoppages</h5>
                    <p class="text-muted small mb-0">Configure transit routes, boarding stops, and monthly transport tariffs</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('transport.vehicle.view') }}" class="btn btn-outline-secondary btn-sm">Fleet Vehicles</a>
                    <a href="{{ route('transport.route.add') }}" class="btn btn-success btn-sm">
                        <i class="feather icon-plus me-1"></i> Add Route
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">SL</th>
                                <th>Route Title</th>
                                <th>Start Point</th>
                                <th>End Point / Campus</th>
                                <th>Key Stoppages</th>
                                <th>Monthly Fare</th>
                                <th>Assigned Buses</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $route)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><strong>{{ $route->route_title }}</strong></td>
                                <td>{{ $route->start_point }}</td>
                                <td>{{ $route->end_point }}</td>
                                <td><small class="text-muted">{{ $route->stops ?? 'Standard Stops' }}</small></td>
                                <td><span class="badge bg-success fs-6">₹{{ number_format($route->fare, 2) }}</span></td>
                                <td>{{ $route->vehicles->count() }} Bus(es)</td>
                                <td>
                                    <a href="{{ route('transport.route.edit', $route->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{ route('transport.route.delete', $route->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No transport routes configured yet.</td>
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
