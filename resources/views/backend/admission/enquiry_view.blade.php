@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white mb-0">
                    <div class="card-body py-3">
                        <h6 class="text-white-50">Total Enquiries</h6>
                        <h3 class="mb-0 text-white">{{ $stats['total'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white mb-0">
                    <div class="card-body py-3">
                        <h6 class="text-white-50">New Leads</h6>
                        <h3 class="mb-0 text-white">{{ $stats['new'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark mb-0">
                    <div class="card-body py-3">
                        <h6 class="text-muted">In Follow-Up / Contacted</h6>
                        <h3 class="mb-0">{{ $stats['contacted'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white mb-0">
                    <div class="card-body py-3">
                        <h6 class="text-white-50">Admitted Students</h6>
                        <h3 class="mb-0 text-white">{{ $stats['admitted'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Admission Enquiries & Lead Pipeline</h5>
                    <p class="text-muted small mb-0">Track prospect student inquiries from walk-in, portal, and campaigns</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admission.enquiry.add') }}" class="btn btn-success btn-sm">
                        <i class="feather icon-plus me-1"></i> Log New Enquiry
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="10%">Enquiry #</th>
                                <th>Candidate Name</th>
                                <th>Parent / Guardian</th>
                                <th>Contact Phone</th>
                                <th>Class</th>
                                <th>Source</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $item)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $item->enquiry_no }}</span></td>
                                <td><strong>{{ $item->student_name }}</strong></td>
                                <td>{{ $item->parent_name }}</td>
                                <td>{{ $item->mobile }}</td>
                                <td>{{ $item->student_class->name ?? 'Class' }}</td>
                                <td><span class="badge bg-light text-dark">{{ $item->source }}</span></td>
                                <td>{{ date('d-m-Y', strtotime($item->enquiry_date)) }}</td>
                                <td>
                                    @if($item->status == 'New')
                                        <span class="badge bg-primary">New Lead</span>
                                    @elseif($item->status == 'Contacted')
                                        <span class="badge bg-info">Contacted</span>
                                    @elseif($item->status == 'Assessment Scheduled')
                                        <span class="badge bg-warning text-dark">Assessment</span>
                                    @elseif($item->status == 'Admitted')
                                        <span class="badge bg-success">Admitted</span>
                                    @else
                                        <span class="badge bg-danger">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admission.enquiry.edit', $item->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{ route('admission.enquiry.delete', $item->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">No admission enquiries recorded yet.</td>
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
