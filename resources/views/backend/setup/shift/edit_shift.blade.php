@extends('admin.admin_master')
@section('admin')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Student Shift</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('update.student.shift',$editData->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Student Shift Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $editData->name }}">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
