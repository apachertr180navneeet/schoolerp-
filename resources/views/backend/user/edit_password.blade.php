@extends('admin.admin_master')
@section('admin')


<div class="row">
    <div class="col-12">
		 <div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
			  <h5 class="card-title mb-0">Change Password</h5>
			  
			</div>
			<div class="card-body">
			  <div class="row">
				<div class="col">

	 <form method="post" action="{{ route('password.update') }}">
	 	@csrf
					  <div class="row">
						<div class="col-12">	
 

 

		<div class="mb-3">
		<label class="form-label">Current Password <span class="text-danger">*</span></label>
	 <input type="password" name="oldpassword" id="current_password" class="form-control" > 
	 @error('oldpassword')
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
		 
	</div>
  
	 
		
	<div class="mb-3">
		<label class="form-label">New Password <span class="text-danger">*</span></label>
	 <input type="password" name="password" id="password" class="form-control"  >
      @error('password')
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
		 
	</div>

		<div class="mb-3">
		<label class="form-label">Confirm Password  <span class="text-danger">*</span></label>
	 <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" >
    @error('password_confirmation')
	 <span class="text-danger">{{ $message }}</span>
	 @enderror

		 
	</div>
  
   
							 
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
