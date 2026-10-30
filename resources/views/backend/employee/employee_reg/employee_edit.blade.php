@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Edit Employee</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('update.employee.registration',$editData->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Employee Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" required="" value="{{ $editData->name }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Father's Name <span class="text-danger">*</span></label>
                                        <input type="text" name="fname" class="form-control" required="" value="{{ $editData->fname }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Mother's Name <span class="text-danger">*</span></label>
                                        <input type="text" name="mname" class="form-control" required="" value="{{ $editData->mname }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                        <input type="text" name="mobile" class="form-control" required="" value="{{ $editData->mobile }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Address <span class="text-danger">*</span></label>
                                        <input type="text" name="address" class="form-control" required="" value="{{ $editData->address }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                                        <select name="gender" id="gender" required="" class="form-select">
                                            <option value="" selected="" disabled="">Select Gender</option>
                                            <option value="Male" {{ ($editData->gender == 'Male')? 'selected': '' }}>Male</option>
                                            <option value="Female" {{ ($editData->gender == 'Female')? 'selected': '' }}>Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Religion <span class="text-danger">*</span></label>
                                        <select name="religion" id="religion" required="" class="form-select">
                                            <option value="" selected="" disabled="">Select Religion</option>
                                            <option value="Islam" {{ ($editData->religion == 'Islam')? 'selected': '' }}>Islam</option>
                                            <option value="Hindu" {{ ($editData->religion == 'Hindu')? 'selected': '' }}>Hindu</option>
                                            <option value="Christan" {{ ($editData->religion == 'Christan')? 'selected': '' }}>Christan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date" name="dob" class="form-control" required="" value="{{ $editData->dob }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Designation <span class="text-danger">*</span></label>
                                        <select name="designation_id" required="" class="form-select">
                                            <option value="" selected="" disabled="">Select Year</option>
                                            @foreach($designation as $desi)
                                            <option value="{{ $desi->id }}" {{ ($editData->designation_id == $desi->id)?'selected':'' }}>{{ $desi->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if(!@$editData)
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Salary <span class="text-danger">*</span></label>
                                        <input type="text" name="salary" class="form-control" required="" value="{{ $editData->salary }}">
                                    </div>
                                </div>
                                @endif
                                @if(!@$editData)
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Joining Date <span class="text-danger">*</span></label>
                                        <input type="date" name="join_date" class="form-control" required="" value="{{ $editData->join_date }}">
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Profile Image</label>
                                        <input type="file" name="image" class="form-control" id="image">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <img id="showImage" src="{{ (!empty($editData->image))? url('upload/employee_images/'.$editData->image):url('upload/no_image.jpg') }}" style="width: 100px; width: 100px; border: 1px solid #000000;">
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
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
