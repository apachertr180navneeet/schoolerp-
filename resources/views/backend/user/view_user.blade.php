@extends('admin.admin_master')
@section('admin')


<div class="row">

			<div class="col-12">

			 <div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
				  <h5 class="card-title mb-0">User List</h5>
	<a href="{{ route('users.add') }}" class="btn btn-success"><i class="bi bi-plus-lg me-1"></i>Add User</a>			  

				</div>
				<div class="card-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
			<tr>
				<th width="5%">SL</th>
				<th>Role</th>
				<th>Name</th>
				<th>Email</th>
				<th>Code</th>
				<th width="25%">Action</th>
				 
			</tr>
		</thead>
		<tbody>
			@foreach($allData as $key => $user )
			<tr>
				<td>{{ $key+1 }}</td>
				<td> {{ $user->role }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->code }}</td>
				<td>
<a href="{{ route('users.edit',$user->id) }}" class="btn btn-info btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
<a href="{{ route('users.delete',$user->id) }}" class="btn btn-danger btn-sm" id="delete"><i class="bi bi-trash"></i> Delete</a>

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
