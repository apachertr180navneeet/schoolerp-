@extends('admin.admin_master')
@section('admin')


<div class="row">

			<div class="col-12">

			 <div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
				  <h5 class="card-title mb-0">Student Fee List</h5>
	<a href="{{ route('student.fee.add') }}" class="btn btn-success"><i class="bi bi-plus-lg me-1"></i>Add / Edit Student Fee</a>			  

				</div>
				<div class="card-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
			<tr>
				<th width="5%">SL</th>  
				<th>ID No</th> 
				<th>Name </th>
				<th>Year</th>
				<th>Class </th>
				<th>Fee Type</th>
				<th>Amount</th>
				<th>Date</th> 
				 
				 
			</tr>
		</thead>
		<tbody>
			@foreach($allData as $key => $value )
			<tr>
				<td>{{ $key+1 }}</td>
				<td> {{ $value['student']['id_no'] }}</td>	
				<td> {{ $value['student']['name'] }}</td>	
				<td> {{ $value['student_year']['name'] }}</td>	
				<td> {{ $value['student_class']['name'] }}</td>	
				<td> {{ $value['fee_category']['name'] }} </td>	
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
