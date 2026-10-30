@extends('admin.admin_master')
@section('admin')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Assign Subject Details</h5>
                <a href="{{ route('assign.subject.add') }}" class="btn btn-success btn-sm">Add Assign Subject</a>
            </div>
            <div class="card-body">
                <h4><strong>Assign Subject : </strong>{{ $detailsData['0']['student_class']['name'] }} </h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">SL</th>
                                <th width="20%">Subject</th>
                                <th width="20%">Full Mark</th>
                                <th width="20%">Pass Mark</th>
                                <th width="20%">Subjective Mark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detailsData as $key => $detail )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $detail['school_subject']['name'] }}</td>
                                <td>{{ $detail->full_mark }}</td>
                                <td>{{ $detail->pass_mark }}</td>
                                <td>{{ $detail->subjective_mark }}</td>
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
