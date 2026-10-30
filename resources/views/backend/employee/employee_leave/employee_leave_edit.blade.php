@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Edit Employee Leave</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('update.employee.leave',$editData->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Employee Name <span class="text-danger">*</span></label>
                                        <select name="employee_id" required="" class="form-select">
                                            <option value="" selected="" disabled="">Select Employee Name</option>
                                            @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}" {{ ($editData->employee_id == $employee->id)? 'selected':'' }}>{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Start Date <span class="text-danger">*</span></label>
                                        <input type="date" name="start_date" class="form-control" value="{{ $editData->start_date }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Leave Purpose <span class="text-danger">*</span></label>
                                        <select name="leave_purpose_id" id="leave_purpose_id" required="" class="form-select">
                                            <option value="" selected="" disabled="">Select Employee Name</option>
                                            @foreach($leave_purpose as $leave)
                                            <option value="{{ $leave->id }}" {{ ($editData->leave_purpose_id == $leave->id)?'selected':'' }}>{{ $leave->name }}</option>
                                            @endforeach
                                            <option value="0">New Purpose</option>
                                        </select>
                                        <input type="text" name="name" id="add_another" class="form-control" placeholder="Write Purpose" style="display: none;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">End Date <span class="text-danger">*</span></label>
                                        <input type="date" name="end_date" class="form-control" value="{{ $editData->end_date }}">
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
		$(document).on('change','#leave_purpose_id',function(){
			var leave_purpose_id = $(this).val();
			if (leave_purpose_id == '0') {
				$('#add_another').show();
			}else{
				$('#add_another').hide();
			}
		});
	});
</script>



@endsection
