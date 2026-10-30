@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">System Audit & Activity Logs</h5>
                    <p class="text-muted small mb-0">Traceability of all system events, data updates, and security logs</p>
                </div>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('system.activity.log') }}" class="row g-2 mb-4">
                    <div class="col-md-4">
                        <select name="module" class="form-control form-control-sm">
                            <option value="">All Modules</option>
                            @foreach($modules as $mod)
                            <option value="{{ $mod }}" {{ request('module') == $mod ? 'selected' : '' }}>{{ $mod }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="action_type" class="form-control form-control-sm">
                            <option value="">All Actions</option>
                            <option value="CREATE" {{ request('action_type') == 'CREATE' ? 'selected' : '' }}>CREATE</option>
                            <option value="UPDATE" {{ request('action_type') == 'UPDATE' ? 'selected' : '' }}>UPDATE</option>
                            <option value="DELETE" {{ request('action_type') == 'DELETE' ? 'selected' : '' }}>DELETE</option>
                            <option value="LOGIN" {{ request('action_type') == 'LOGIN' ? 'selected' : '' }}>LOGIN</option>
                            <option value="APPROVE" {{ request('action_type') == 'APPROVE' ? 'selected' : '' }}>APPROVE</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-sm btn-primary w-100">
                            <i class="feather icon-filter me-1"></i> Filter
                        </button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>Timestamp</th>
                                <th>User</th>
                                <th>Action</th>
                                <th>Module</th>
                                <th>Description</th>
                                <th>IP Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ date('d-M-Y H:i:s', strtotime($log->created_at)) }}</td>
                                <td><strong>{{ $log->user_name ?? 'System' }}</strong></td>
                                <td>
                                    @if(in_array($log->action_type, ['CREATE', 'APPROVE']))
                                    <span class="badge bg-success">{{ $log->action_type }}</span>
                                    @elseif($log->action_type == 'DELETE')
                                    <span class="badge bg-danger">{{ $log->action_type }}</span>
                                    @elseif($log->action_type == 'UPDATE')
                                    <span class="badge bg-warning text-dark">{{ $log->action_type }}</span>
                                    @else
                                    <span class="badge bg-info text-dark">{{ $log->action_type }}</span>
                                    @endif
                                </td>
                                <td><span class="badge bg-secondary">{{ $log->module }}</span></td>
                                <td>{{ $log->description }}</td>
                                <td><code>{{ $log->ip_address ?? '127.0.0.1' }}</code></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No audit logs recorded.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $allData->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
