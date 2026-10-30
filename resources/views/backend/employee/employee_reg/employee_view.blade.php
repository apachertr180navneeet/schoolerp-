@extends('admin.admin_master')
@section('admin')


 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Employee List</h5>
                <a href="{{ route('employee.registration.add') }}" class="btn btn-success"><i class="bi bi-plus-lg me-1"></i>Add Employee</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th>Name</th>
                                <th>ID NO</th>
                                <th>Mobile</th>
                                <th>Gender</th>
                                <th>Join Date</th>
                                <th>Salary</th>
                                @if(Auth::user()->role == "Admin")
                                <th>Code</th>
                                @endif
                                <th width="25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allData as $key => $employee)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->id_no }}</td>
                                <td>{{ $employee->mobile }}</td>
                                <td>{{ $employee->gender }}</td>
                                <td>{{ $employee->join_date }}</td>
                                <td>{{ $employee->salary }}</td>
                                @if(Auth::user()->role == "Admin")
                                <td>{{ $employee->code }}</td>
                                @endif
                                <td>
                                    <a href="{{ route('employee.registration.edit',$employee->id) }}" class="btn btn-info btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <a target="_blank" href="{{ route('employee.registration.details',$employee->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-eye"></i> Details</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection
