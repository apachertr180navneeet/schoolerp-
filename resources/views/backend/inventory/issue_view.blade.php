@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Inventory Issue & Asset Handover Log</h5>
                    <p class="text-muted small mb-0">Record items distributed to teachers, labs, and staff members</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('inventory.item.view') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="feather icon-list me-1"></i> Stock Catalog
                    </a>
                    <a href="{{ route('inventory.issue.add') }}" class="btn btn-primary btn-sm">
                        <i class="feather icon-plus me-1"></i> Issue Item to Staff
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>Item Issued</th>
                                <th>Issued To (Staff)</th>
                                <th>Quantity</th>
                                <th>Issue Date</th>
                                <th>Return Date</th>
                                <th>Status</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $issue)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <strong>{{ $issue->item->item_name ?? 'Item' }}</strong>
                                    <span class="badge bg-secondary ms-1">{{ $issue->item->item_code ?? '' }}</span>
                                </td>
                                <td><strong>{{ $issue->user->name ?? 'Staff' }}</strong></td>
                                <td>{{ $issue->quantity_issued }} {{ $issue->item->unit ?? 'Pcs' }}</td>
                                <td>{{ date('d-M-Y', strtotime($issue->issue_date)) }}</td>
                                <td>{{ $issue->return_date ? date('d-M-Y', strtotime($issue->return_date)) : '-' }}</td>
                                <td>
                                    @if($issue->status == 'Returned')
                                    <span class="badge bg-success">Returned</span>
                                    @else
                                    <span class="badge bg-warning text-dark">Issued / In Use</span>
                                    @endif
                                </td>
                                <td>
                                    @if($issue->status != 'Returned')
                                    <a href="{{ route('inventory.issue.return', $issue->id) }}" class="btn btn-sm btn-outline-success">
                                        <i class="feather icon-corner-down-left me-1"></i> Mark Returned
                                    </a>
                                    @else
                                    <span class="text-muted small">Closed</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No inventory issues logged.</td>
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

