@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Add Inventory Item</h5>
                    <p class="text-muted small mb-0">Record a new stock or consumable item in campus store</p>
                </div>
                <a href="{{ route('inventory.item.view') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="feather icon-arrow-left me-1"></i> Back to Inventory
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('inventory.item.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Item Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control" required>
                                <option value="" disabled selected>Select Category</option>
                                @foreach($categories as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKU / Item Code <span class="text-danger">*</span></label>
                            <input type="text" name="item_code" class="form-control" value="INV-{{ rand(1000, 9999) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Item Name <span class="text-danger">*</span></label>
                            <input type="text" name="item_name" class="form-control" placeholder="e.g. A4 Paper Rim 75 GSM / HDMI Projector Cable" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Measurement Unit</label>
                            <input type="text" name="unit" class="form-control" value="Pcs" placeholder="Pcs, Box, Set, Rim">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Initial Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" class="form-control" value="10" min="0" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Min Alert Threshold</label>
                            <input type="number" name="min_quantity_alert" class="form-control" value="5" min="1">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Unit Price (₹)</label>
                            <input type="number" step="0.01" name="unit_price" class="form-control" value="0.00">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Item Description / Specifications</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Vendor specifications, model number, location in storeroom..."></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="feather icon-save me-1"></i> Add to Inventory
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
