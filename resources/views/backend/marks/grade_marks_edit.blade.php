@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<div class="row">
    <div class="col-12">
		 <div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
			  <h5 class="card-title mb-0">Edit Grade Marks</h5>
			  
			</div>
			<div class="card-body">
			  <div class="row">
				<div class="col">

 <form method="post" action="{{ route('update.marks.grade',$editData->id) }}"  >
	 	@csrf
					  <div class="row">
						<div class="col-12">	

 	
 		<div class="row"> <!-- 1st Row -->
 			
 			<div class="col-md-4">

 		 <div class="mb-3">
		<label class="form-label">Grade Name <span class="text-danger">*</span></label>
	 <input type="text" name="grade_name" class="form-control" required="" value="{{ $editData->grade_name }}" > 
	  </div>

 			</div> <!-- End Col md 4 -->


	<div class="col-md-4">

 		 <div class="mb-3">
		<label class="form-label">Grade Point <span class="text-danger">*</span></label>
	 <input type="text" name="grade_point" class="form-control" required="" value="{{ $editData->grade_point }}" > 
	  </div>
	  
 			</div> <!-- End Col md 4 -->



	<div class="col-md-4">

 		 <div class="mb-3">
		<label class="form-label">Start Marks <span class="text-danger">*</span></label>
	 <input type="text" name="start_marks" class="form-control" required="" value="{{ $editData->start_marks }}"> 
	  </div>
	  
 			</div> <!-- End Col md 4 --> 
 
 			
 		</div> <!-- End 1stRow -->





	<div class="row"> <!-- 2nd Row -->
 			
 			 


	<div class="col-md-4">

 		 <div class="mb-3">
		<label class="form-label">End Marks <span class="text-danger">*</span></label>
	 <input type="text" name="end_marks" class="form-control" required="" value="{{ $editData->end_marks }}"  > 
	  </div>
	  
 			</div> <!-- End Col md 4 -->



	<div class="col-md-4">

 	 <div class="mb-3">
		<label class="form-label">Start Point <span class="text-danger">*</span></label>
	 <input type="text" name="start_point" class="form-control" required="" value="{{ $editData->start_point }}"  > 
	  </div>
	  
 			</div> <!-- End Col md 4 --> 



<div class="col-md-4">

 		 <div class="mb-3">
		<label class="form-label">End Point <span class="text-danger">*</span></label>
	 <input type="text" name="end_point" class="form-control" required=""  value="{{ $editData->end_point }}"> 
	  </div>
	  
 			</div> <!-- End Col md 4 --> 

 
 			
 		</div> <!-- End 2nd Row -->



<div class="row"> <!-- 3rd Row -->

 
 			
 			<div class="col-md-4">

 		<div class="mb-3">
		<label class="form-label">Remarks <span class="text-danger">*</span></label>
	 <input type="text" name="remarks" class="form-control" required="" value="{{ $editData->remarks }}" > 
	  </div>

 			</div> <!-- End Col md 4 -->


	<div class="col-md-4">

 		  
 			</div> <!-- End Col md 4 --> 
 
 			
 		</div> <!-- End 3rd Row -->

 
 							 
						<div class="text-end">
	 <button type="submit" class="btn btn-primary">Update</button>
						</div>
					</form>

				</div>
			  </div>
			</div>
		  </div>
	</div>
</div>
@endsection 
