@extends('admin.admin_master')
@section('admin')


 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Employee Salary Increment</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('update.increment.store',$editData->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Salary Amount <span class="text-danger">*</span></label>
                                        <input type="text" name="increment_salary" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Effected Date <span class="text-danger">*</span></label>
                                        <input type="date" name="effected_salary" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





@endsection
