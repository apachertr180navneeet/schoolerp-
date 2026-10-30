@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Add Transport Route</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('transport.route.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label font-weight-bold">Route Title <span class="text-danger">*</span></label>
                            <input type="text" name="route_title" class="form-control" placeholder="e.g. Route 1 - Civil Lines to Campus" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Starting Point <span class="text-danger">*</span></label>
                            <input type="text" name="start_point" class="form-control" placeholder="e.g. Civil Lines Chowk" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Ending Point / Campus <span class="text-danger">*</span></label>
                            <input type="text" name="end_point" class="form-control" value="Main Campus Gate 1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Monthly Fare (₹) <span class="text-danger">*</span></label>
                            <input type="number" name="fare" class="form-control" value="1200" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label font-weight-bold">En-route Stoppages</label>
                            <textarea name="stops" class="form-control" rows="2" placeholder="e.g. Model Town (7:10 AM) -> Metro Station (7:25 AM) -> Sector 14 (7:40 AM)"></textarea>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">Save Route</button>
                        <a href="{{ route('transport.route.view') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
