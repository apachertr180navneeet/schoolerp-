@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Add Student Section</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('student.section.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Section Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. A, B, C, Rose, Lotus" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Class Capacity</label>
                        <input type="number" name="capacity" class="form-control" value="40">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Section</button>
                    <a href="{{ route('student.section.view') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
