@extends('admin.admin_master')
@section('admin')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">School Subject List</h5>
                <a href="{{ route('school.subject.add') }}" class="btn btn-success btn-sm">Add Subject</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th>Name</th>
                                <th width="25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allData as $key => $subject )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>
                                    <a href="{{ route('school.subject.edit',$subject->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{ route('school.subject.delete',$subject->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
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
