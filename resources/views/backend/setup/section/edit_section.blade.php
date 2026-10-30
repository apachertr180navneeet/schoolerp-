@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Student Section</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('student.section.update', $editData->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Section Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $editData->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Class Capacity</label>
                        <input type="number" name="capacity" class="form-control" value="{{ $editData->capacity }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Section</button>
                    <a href="{{ route('student.section.view') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
