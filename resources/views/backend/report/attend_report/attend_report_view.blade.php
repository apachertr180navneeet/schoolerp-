@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="row">

<div class="col-12">
<div class="card border-warning">
				  <div class="card-header">
	 <h5 class="card-title mb-0">Manage <strong>Employee Attendance Report</strong></h5>
				  </div>

				  <div class="card-body">
				
 <form method="GET" action="{{ route('report.attendance.get') }}" target="_blank">
			@csrf
			<div class="row">



<div class="col-md-4">

 		 <div class="mb-3">
		<label class="form-label">Employee Name <span class="text-danger"> </span></label>
	 <select name="employee_id" id="employee_id" required="" class="form-select">
			<option value="" selected="" disabled="">Select Employee</option>
			 @foreach($employees as $employee)
  <option value="{{ $employee->id }}" >{{ $employee->name }}</option>
		 	@endforeach
			 
		</select>	 
	  </div>
	  
 			</div> <!-- End Col md 4 --> 

 



 <div class="col-md-4">

 		 <div class="mb-3">
		<label class="form-label">Date<span class="text-danger">*</span></label>
	 <input type="date" name="date" class="form-control" required="" > 
	  </div>
	  
 			</div> <!-- End Col md 4 --> 			




 			<div class="col-md-4" style="padding-top: 25px;" >

  <input type="submit" class="btn btn-primary" value="Search">

	  
 			</div> <!-- End Col md 4 --> 		
			</div><!--  end row --> 

 

		</form> 

			       
			</div>
@endsection
