@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Transport Route — {{ $editData->route_title }}</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('transport.route.update', $editData->id) }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label font-weight-bold">Route Title <span class="text-danger">*</span></label>
                            <input type="text" name="route_title" class="form-control" value="{{ $editData->route_title }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Starting Point <span class="text-danger">*</span></label>
                            <input type="text" name="start_point" class="form-control" value="{{ $editData->start_point }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Ending Point / Campus <span class="text-danger">*</span></label>
                            <input type="text" name="end_point" class="form-control" value="{{ $editData->end_point }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Monthly Fare (₹) <span class="text-danger">*</span></label>
                            <input type="number" name="fare" class="form-control" value="{{ $editData->fare }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label font-weight-bold">En-route Stoppages</label>
                            <textarea name="stops" class="form-control" rows="2">{{ $editData->stops }}</textarea>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">Update Route</button>
                        <a href="{{ route('transport.route.view') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
