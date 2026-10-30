@extends('admin.admin_master')
@section('admin')


 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Employee Salary List</h5>
                <a href="{{ route('employee.registration.add') }}" class="btn btn-success"><i class="bi bi-plus-lg me-1"></i>Add Employee Salary</a>
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
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allData as $key => $value)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->id_no }}</td>
                                <td>{{ $value->mobile }}</td>
                                <td>{{ $value->gender }}</td>
                                <td>{{ date('d-m-Y',strtotime($value->join_date)) }}</td>
                                <td>{{ $value->salary }}</td>
                                <td>
                                    <a title="Increment" href="{{ route('employee.salary.increment',$value->id) }}" class="btn btn-info btn-sm"><i class="bi bi-plus-circle"></i></a>
                                    <a title="Details" target="_blank" href="{{ route('employee.salary.details',$value->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-eye"></i></a>
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
