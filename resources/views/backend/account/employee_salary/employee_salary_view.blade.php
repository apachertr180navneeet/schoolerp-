@extends('admin.admin_master')
@section('admin')


<div class="row">

			<div class="col-12">

			 <div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
				  <h5 class="card-title mb-0">Employee Salary List</h5>
	<a href="{{ route('account.salary.add') }}" class="btn btn-success"><i class="bi bi-plus-lg me-1"></i>Add / Edit Employee Salary</a>			  

				</div>
				<div class="card-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
			<tr>
				<th width="5%">SL</th>  
				<th>ID No</th> 
				<th>Name </th>
				<th>Amount</th>
				<th>Date</th> 
				 
				 
			</tr>
		</thead>
		<tbody>
			@foreach($allData as $key => $value )
			<tr>
				<td>{{ $key+1 }}</td>
				<td> {{ $value['user']['id_no'] }}</td>	
				<td> {{ $value['user']['name'] }}</td>	
				<td> {{ $value->amount }}</td>	 
				<td> {{ date('M Y', strtotime($value->date))  }}</td>
				 		  
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
