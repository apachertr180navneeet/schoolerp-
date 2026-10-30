@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Hostel Bed Allotments</h5>
                    <p class="text-muted small mb-0">Active student residents, allocated room numbers and allotment status</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('hostel.room.view') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="feather icon-home me-1"></i> Rooms Matrix
                    </a>
                    <a href="{{ route('hostel.allotment.add') }}" class="btn btn-primary btn-sm">
                        <i class="feather icon-user-plus me-1"></i> Allot Bed to Student
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>Student Name</th>
                                <th>Admission ID</th>
                                <th>Hostel Block</th>
                                <th>Room Number</th>
                                <th>Allotment Date</th>
                                <th>Status</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $al)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><strong>{{ $al->student->name ?? 'Student' }}</strong></td>
                                <td><span class="badge bg-secondary">{{ $al->student->id_no ?? 'ID' }}</span></td>
                                <td>{{ $al->room->hostel_name ?? '' }}</td>
                                <td><span class="badge bg-primary">Room {{ $al->room->room_no ?? '' }}</span></td>
                                <td>{{ date('d-M-Y', strtotime($al->allotment_date)) }}</td>
                                <td>
                                    @if($al->status == 'Occupied')
                                    <span class="badge bg-success">Active Resident</span>
                                    @else
                                    <span class="badge bg-dark">Vacated</span>
                                    @endif
                                </td>
                                <td>
                                    @if($al->status == 'Occupied')
                                    <a href="{{ route('hostel.allotment.vacate', $al->id) }}" class="btn btn-sm btn-outline-danger">
                                        <i class="feather icon-log-out me-1"></i> Vacate Bed
                                    </a>
                                    @else
                                    <span class="text-muted small">Vacated</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No student hostel allotments recorded.</td>
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
