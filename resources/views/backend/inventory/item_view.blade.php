@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Store Inventory & Stock Assets</h5>
                    <p class="text-muted small mb-0">Track campus hardware, stationery, lab consumables, and low stock thresholds</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('inventory.issue.view') }}" class="btn btn-outline-primary btn-sm">
                        <i class="feather icon-repeat me-1"></i> Issue Log
                    </a>
                    <a href="{{ route('inventory.item.add') }}" class="btn btn-primary btn-sm">
                        <i class="feather icon-plus me-1"></i> Add Inventory Item
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Unit</th>
                                <th>Available Qty</th>
                                <th>Unit Price</th>
                                <th>Stock Status</th>
                                <th width="12%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><span class="badge bg-secondary">{{ $item->item_code }}</span></td>
                                <td><strong>{{ $item->item_name }}</strong></td>
                                <td><span class="badge bg-light text-dark">{{ $item->category->name ?? 'General' }}</span></td>
                                <td>{{ $item->unit }}</td>
                                <td><strong>{{ $item->quantity }}</strong></td>
                                <td>₹{{ number_format($item->unit_price, 2) }}</td>
                                <td>
                                    @if($item->quantity <= 0)
                                    <span class="badge bg-danger">Out of Stock</span>
                                    @elseif($item->quantity <= $item->min_quantity_alert)
                                    <span class="badge bg-warning text-dark">Low Stock ({{ $item->quantity }})</span>
                                    @else
                                    <span class="badge bg-success">In Stock</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('inventory.item.delete', $item->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete">
                                        <i class="feather icon-trash-2"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">No inventory items registered in catalog.</td>
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
