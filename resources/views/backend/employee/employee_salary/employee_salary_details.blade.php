@extends('admin.admin_master')
@section('admin')


 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Employee Salary Details</h5>
                <div>
                    <span class="me-3"><strong>Employee Name:</strong> {{ $details->name }}</span>
                    <span><strong>Employee ID No:</strong> {{ $details->id_no }}</span>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th>Previous Salary</th>
                                <th>Increment Salary</th>
                                <th>Present Salary</th>
                                <th>Effected Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($salary_log as $key => $log)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $log->previous_salary }}</td>
                                <td>{{ $log->increment_salary }}</td>
                                <td>{{ $log->present_salary }}</td>
                                <td>{{ $log->effected_salary }}</td>
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
