@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Hostel & Boarding Accommodation</h5>
                    <p class="text-muted small mb-0">Manage dormitories, rooms, bed capacity, pricing, and occupancy rates</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('hostel.allotment.view') }}" class="btn btn-outline-primary btn-sm">
                        <i class="feather icon-users me-1"></i> Student Allotments
                    </a>
                    <a href="{{ route('hostel.room.add') }}" class="btn btn-primary btn-sm">
                        <i class="feather icon-plus me-1"></i> Add Hostel Room
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>Hostel Block</th>
                                <th>Room Number</th>
                                <th>Room Type</th>
                                <th>Bed Capacity</th>
                                <th>Occupied Beds</th>
                                <th>Vacant Beds</th>
                                <th>Cost / Month</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $r)
                            @php
                                $occupied = $r->student_hostels->where('status', 'Occupied')->count();
                                $vacant = max(0, $r->capacity - $occupied);
                            @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><strong>{{ $r->hostel_name }}</strong></td>
                                <td><span class="badge bg-secondary">{{ $r->room_no }}</span></td>
                                <td>{{ $r->room_type }}</td>
                                <td>{{ $r->capacity }} Beds</td>
                                <td><span class="badge bg-warning text-dark">{{ $occupied }} Beds</span></td>
                                <td>
                                    @if($vacant > 0)
                                    <span class="badge bg-success">{{ $vacant }} Available</span>
                                    @else
                                    <span class="badge bg-danger">Full</span>
                                    @endif
                                </td>
                                <td>₹{{ number_format($r->cost_per_bed, 2) }}</td>
                                <td>
                                    @if($vacant > 0)
                                    <span class="badge bg-success">Available</span>
                                    @else
                                    <span class="badge bg-danger">Occupied</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">No hostel rooms registered.</td>
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

