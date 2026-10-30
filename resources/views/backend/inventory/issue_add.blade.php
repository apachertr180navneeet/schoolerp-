@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Issue Store Item to Staff</h5>
                    <p class="text-muted small mb-0">Deduct item quantity from stock and assign custodial accountability</p>
                </div>
                <a href="{{ route('inventory.issue.view') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="feather icon-arrow-left me-1"></i> Back to Issues
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('inventory.issue.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Select Item (Available Stock) <span class="text-danger">*</span></label>
                            <select name="item_id" class="form-control" required>
                                <option value="" disabled selected>Select Item</option>
                                @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->item_name }} (Stock: {{ $item->quantity }} {{ $item->unit }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Issue To (Staff / Teacher) <span class="text-danger">*</span></label>
                            <select name="user_id" class="form-control" required>
                                <option value="" disabled selected>Select Staff Member</option>
                                @foreach($staffs as $staff)
                                <option value="{{ $staff->id }}">{{ $staff->name }} ({{ $staff->usertype }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quantity to Issue <span class="text-danger">*</span></label>
                            <input type="number" name="quantity_issued" class="form-control" value="1" min="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Issue Date <span class="text-danger">*</span></label>
                            <input type="date" name="issue_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Purpose / Room / Remarks</label>
                        <textarea name="remarks" class="form-control" rows="3" placeholder="Department, purpose, expected return date..."></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="feather icon-check me-1"></i> Confirm Issue
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
