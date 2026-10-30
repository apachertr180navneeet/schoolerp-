@extends('admin.admin_master')
@section('admin')


 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Employee Attendance Details</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th>Name</th>
                                <th>ID No</th>
                                <th>Date</th>
                                <th>Attend Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $key => $value)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value['user']['name'] }}</td>
                                <td>{{ $value['user']['id_no'] }}</td>
                                <td>{{ date('d-m-Y', strtotime($value->date)) }}</td>
                                <td>{{ $value->attend_status }}</td>
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
