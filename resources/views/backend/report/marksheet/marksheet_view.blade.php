@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="row">

<div class="col-12">
<div class="card border-warning">
				  <div class="card-header">
					<h5 class="card-title mb-0">Manage <strong>MarkSheet Generate</strong></h5>
				  </div>

				  <div class="card-body">
				
 <form method="GET" action="{{ route('report.marksheet.get') }}" target="_blank">
			@csrf
			<div class="row">



<div class="col-md-3">

 		 <div class="mb-3">
		<label class="form-label">Year <span class="text-danger"> </span></label>
	 <select name="year_id" id="year_id" required="" class="form-select">
			<option value="" selected="" disabled="">Select Year</option>
			 @foreach($years as $year)
  <option value="{{ $year->id }}" >{{ $year->name }}</option>
		 	@endforeach
			 
		</select>	 
	  </div>
	  
 			</div> <!-- End Col md 3 --> 



 			
 		<div class="col-md-3">

 		 <div class="mb-3">
		<label class="form-label">Class <span class="text-danger"> </span></label>
	 <select name="class_id" id="class_id"  required="" class="form-select">
			<option value="" selected="" disabled="">Select Class</option>
			 @foreach($classes as $class)
			<option value="{{ $class->id }}">{{ $class->name }}</option>
		 	@endforeach
			 
		</select>	 
	  </div>
	  
 			</div> <!-- End Col md 3 --> 


 		


<div class="col-md-3">

 		 <div class="mb-3">
		<label class="form-label">Exam Type <span class="text-danger"> </span></label>
 <select name="exam_type_id" id="exam_type_id"  required="" class="form-select">
			<option value="" selected="" disabled="">Select Class</option>
			 @foreach($exam_type as $exam)
			<option value="{{ $exam->id }}">{{ $exam->name }}</option>
		 	@endforeach
			 
		</select>	 
	  </div>
	  
 			</div> <!-- End Col md 3 --> 



 <div class="col-md-3">

 		 <div class="mb-3">
		<label class="form-label">ID No <span class="text-danger">*</span></label>
	 <input type="text" name="id_no" class="form-control" required="" > 
	  </div>
	  
 			</div> <!-- End Col md 3 --> 			




 			<div class="col-md-3"  >

  <input type="submit" class="btn btn-primary" value="Search">

	  
 			</div> <!-- End Col md 3 --> 		
			</div><!--  end row --> 


 

		</form> 

			       
			</div>
@endsection
