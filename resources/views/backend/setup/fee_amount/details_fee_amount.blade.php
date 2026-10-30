@extends('admin.admin_master')
@section('admin')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Fee Amount Details</h5>
                <a href="{{ route('fee.amount.add') }}" class="btn btn-success btn-sm">Add Fee Amount</a>
            </div>
            <div class="card-body">
                <h4><strong>Fee Category : </strong>{{ $detailsData['0']['fee_cateogry']['name'] }} </h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">SL</th>
                                <th>Class Name</th>
                                <th width="25%">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detailsData as $key => $detail )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $detail['student_class']['name'] }}</td>
                                <td>{{ $detail->amount }}</td>
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
