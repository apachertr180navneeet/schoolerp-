@extends('admin.admin_master')
@section('admin')


<div class="row">

			<div class="col-12">

			 <div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
				  <h5 class="card-title mb-0">Grade Marks List</h5>
	<a href="{{ route('marks.grade.add') }}" class="btn btn-success"><i class="bi bi-plus-lg me-1"></i>Add Grade Marks</a>			  

				</div>
				<div class="card-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
			<tr>
				<th width="5%">SL</th>  
				<th>Grade Name</th> 
				<th>Grade Point</th>
				<th>Start Marks</th>
				<th>End Marks </th>
				<th>Point Range</th>
				<th>Remarks</th>
				 
				<th width="15%">Action</th>
				 
			</tr>
		</thead>
		<tbody>
			@foreach($allData as $key => $value )
			<tr>
				<td>{{ $key+1 }}</td>
				<td> {{ $value->grade_name }}</td>	
				<td> {{ number_format((float)$value->grade_point,2)  }}</td>	
				<td> {{ $value->start_marks }}</td>	
				<td> {{ $value->end_marks }}</td>	
				<td> {{ $value->start_point }} -  {{ $value->end_point }}</td>	
				<td> {{ $value->remarks }}</td>
				 			 
				<td>
<a href="{{ route('marks.grade.edit',$value->id) }}" class="btn btn-info btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
  

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
