@extends('admin.admin_master')
@section('admin')


<div class="row">
    <div class="col-12">
		 <div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
			  <h5 class="card-title mb-0">Add User</h5>
			  
			</div>
			<div class="card-body">
			  <div class="row">
				<div class="col">

	 <form method="post" action="{{ route('users.store') }}">
	 	@csrf
					  <div class="row">
						<div class="col-12">	


<div class="row">
	<div class="col-md-6" >

		<div class="mb-3">
	<label class="form-label">User Role <span class="text-danger">*</span></label>
	 <select name="role" id="role" required="" class="form-select">
			<option value="" selected="" disabled="">Select Role</option>
			<option value="Admin">Admin</option>
			<option value="Operator">Operator</option>
			 
		</select>
          </div>
	</div> <!-- End Col Md-6 -->

	<div class="col-md-6" >		
	<div class="mb-3">
		<label class="form-label">User Name <span class="text-danger">*</span></label>
	 <input type="text" name="name" class="form-control" required="">  

	</div>

	</div><!-- End Col Md-6 -->
	

</div> <!-- End Row -->



    <div class="row">
	<div class="col-md-6" >

		<div class="mb-3">
		<label class="form-label">User Email <span class="text-danger">*</span></label>
	 <input type="email" name="email" class="form-control" required="">  

	</div>

	</div> <!-- End Col Md-6 -->

	<div class="col-md-6" >
	 
	</div><!-- End Col Md-6 -->
	

</div> <!-- End Row -->

 
   
							 
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



@endsection
