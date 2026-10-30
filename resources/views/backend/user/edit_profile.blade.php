@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="row">
    <div class="col-12">
		 <div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
			  <h5 class="card-title mb-0">Manage Profile</h5>
			  
			</div>
			<div class="card-body">
			  <div class="row">
				<div class="col">

	 <form method="post" action="{{ route('profile.store') }}" enctype="multipart/form-data">
	 	@csrf
					  <div class="row">
						<div class="col-12">	

 

    <div class="row">
	<div class="col-md-6" >

		<div class="mb-3">
		<label class="form-label">User Name <span class="text-danger">*</span></label>
	 <input type="text" name="name" class="form-control" value="{{ $editData->name }}" required="">  

	</div>

	</div> <!-- End Col Md-6 -->

	<div class="col-md-6" >
		
 <div class="mb-3">
		<label class="form-label">User Email <span class="text-danger">*</span></label>
	 <input type="email" name="email" class="form-control" value="{{ $editData->email }}" required="">  

	</div>

	</div><!-- End Col Md-6 -->
	

</div> <!-- End Row -->


 <div class="row">
	<div class="col-md-6" >

		<div class="mb-3">
		<label class="form-label">User Mobile <span class="text-danger">*</span></label>
	 <input type="text" name="mobile" class="form-control" value="{{ $editData->mobile }}" required="">  

	</div>

	</div> <!-- End Col Md-6 -->

	<div class="col-md-6" >
		
 <div class="mb-3">
		<label class="form-label">User Address <span class="text-danger">*</span></label>
	 <input type="text" name="address" class="form-control" value="{{ $editData->address }}" required="">  

	</div>

	</div><!-- End Col Md-6 -->
	

</div> <!-- End Row -->







<div class="row">
	<div class="col-md-6" >

		<div class="mb-3">
	<label class="form-label">User Gender <span class="text-danger">*</span></label>
	 <select name="gender" id="gender" required="" class="form-select">
			<option value="" selected="" disabled="">Select Gender</option>
 <option value="Male" {{ ($editData->gender == "Male" ? "selected": "") }}  >Male</option>
 <option value="Female" {{ ($editData->gender == "Female" ? "selected": "") }} >Female</option>
			 
		</select>
          </div>
	</div> <!-- End Col Md-6 -->

	<div class="col-md-6" >		
	<div class="mb-3">
		<label class="form-label">Profile Image <span class="text-danger">*</span></label>
	 <input type="file" name="image" class="form-control" id="image" >  
	 </div>

	 	<div class="mb-3">
	<img id="showImage" src="{{ (!empty($user->image))? url('upload/user_images/'.$user->image):url('upload/no_image.jpg') }}" style="width: 100px; width: 100px; border: 1px solid #000000;"> 

	 </div>


	</div><!-- End Col Md-6 -->
	

</div> <!-- End Row -->



 
 
   
							 
						<div class="text-end">
	 <button type="submit" class="btn btn-primary">Update</button>
						</div>
					</form>


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
