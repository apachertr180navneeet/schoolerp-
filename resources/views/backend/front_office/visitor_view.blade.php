@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Front Office & Visitor Gate Pass System</h5>
                    <p class="text-muted small mb-0">Track campus visitors, purpose of visit, check-in timestamps, and security passes</p>
                </div>
                <div>
                    <a href="{{ route('visitor.add') }}" class="btn btn-primary btn-sm">
                        <i class="feather icon-user-plus me-1"></i> Register New Visitor
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>Pass #</th>
                                <th>Visitor Name</th>
                                <th>Phone Number</th>
                                <th>Person to Meet</th>
                                <th>Purpose of Visit</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Status</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $v)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><span class="badge bg-dark">{{ $v->pass_number }}</span></td>
                                <td><strong>{{ $v->name }}</strong> ({{ $v->number_of_persons }} pers)</td>
                                <td>{{ $v->phone }}</td>
                                <td>{{ $v->person_to_meet }}</td>
                                <td>{{ $v->purpose }}</td>
                                <td>{{ date('d-M H:i', strtotime($v->check_in)) }}</td>
                                <td>
                                    @if($v->check_out)
                                    {{ date('d-M H:i', strtotime($v->check_out)) }}
                                    @else
                                    <span class="badge bg-warning text-dark">On Campus</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$v->check_out)
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-secondary">Checked Out</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$v->check_out)
                                    <a href="{{ route('visitor.checkout', $v->id) }}" class="btn btn-sm btn-outline-warning" title="Check Out">
                                        <i class="feather icon-log-out"></i> Out
                                    </a>
                                    @endif
                                    <a href="{{ route('visitor.gatepass', $v->id) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Print Gate Pass">
                                        <i class="feather icon-printer"></i>
                                    </a>
                                    <a href="{{ route('visitor.delete', $v->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete">
                                        <i class="feather icon-trash-2"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">No visitors registered today.</td>
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
