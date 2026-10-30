@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<div class="row">
    <div class="col-12">
		 <div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
			  <h5 class="card-title mb-0">Add Other Cost</h5>
			  
			</div>
			<div class="card-body">
			  <div class="row">
				<div class="col">

	 <form method="post" action="{{ route('store.other.cost') }}" enctype="multipart/form-data">
	 	@csrf
					  <div class="row">
						<div class="col-12">	

  	 


<div class="row"> <!-- 1st Row -->


<div class="col-md-3">

 		 <div class="mb-3">
		<label class="form-label">Amount <span class="text-danger">*</span></label>
	 <input type="text" name="amount" class="form-control" required="" > 
	  </div>
	  
 			</div> <!-- End Col md 3 --> 



 			
 		<div class="col-md-3">

 		<div class="mb-3">
		<label class="form-label"> Date <span class="text-danger">*</span></label>
	 <input type="date" name="date" class="form-control" required="" > 
	  </div>
	  
 			</div> <!-- End Col md 3 --> 


           <div class="col-md-3">

<div class="mb-3">
		<label class="form-label">  Image <span class="text-danger">*</span></label>
	 <input type="file" name="image" class="form-control" id="image" >  
	 </div>
 		 
	  
 			</div> <!-- End Col md 3 --> 


 			<div class="col-md-3">

 		 <div class="mb-3">
	<img id="showImage" src="{{ url('upload/no_image.jpg') }}" style="width: 100px; width: 100px; border: 1px solid #000000;"> 
	 </div>
	  
 			</div> <!-- End Col md 3 --> 
 
 			
 		</div> <!-- End 1st Row -->


			<div class="row"> <!--  // 2nd row -->
				 <div class="col-md-12">

 	<div class="mb-3">
		<label class="form-label">Description <span class="text-danger">*</span></label>
		 <textarea name="description" id="description" class="form-control" required="" placeholder="Textarea text" aria-invalid="false"></textarea>
			</div>
				 	
				 </div>

			</div>  <!-- End 2nd Row -->



 
							 
						<div class="text-end">
	 <button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>

				</div>
			  </div>
			</div>
		  </div>
	</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>

@endsection
