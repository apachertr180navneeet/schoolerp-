@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Notice Board & Circular Management</h5>
                    <p class="text-muted small mb-0">Broadcast institutional notices, holiday announcements, and academic circulars</p>
                </div>
                <div>
                    <a href="{{ route('notice.add') }}" class="btn btn-primary btn-sm">
                        <i class="feather icon-plus me-1"></i> Post New Notice
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>Circular Title</th>
                                <th>Type</th>
                                <th>Target Audience</th>
                                <th>Publish Date</th>
                                <th>Expiry Date</th>
                                <th>Status</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $n)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <strong>{{ $n->title }}</strong>
                                    <p class="text-muted small mb-0">{{ Str::limit($n->message, 80) }}</p>
                                </td>
                                <td><span class="badge bg-info text-dark">{{ $n->notice_type }}</span></td>
                                <td><span class="badge bg-secondary">{{ $n->target_audience }}</span></td>
                                <td>{{ date('d-M-Y', strtotime($n->publish_date)) }}</td>
                                <td>{{ $n->expiry_date ? date('d-M-Y', strtotime($n->expiry_date)) : 'Indefinite' }}</td>
                                <td>
                                    @if($n->is_active)
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-dark">Archived</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('notice.delete', $n->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete">
                                        <i class="feather icon-trash-2"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No active notices found on board.</td>
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
