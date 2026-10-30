@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Add Fee Amount</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('store.fee.amount') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="add_item">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Fee Category <span class="text-danger">*</span></label>
                                        <select name="fee_category_id" required="" class="form-control">
                                            <option value="" selected="" disabled="">Select Fee Category</option>
                                            @foreach($fee_categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 mb-3">
                                        <label class="form-label">Student Class <span class="text-danger">*</span></label>
                                        <select name="class_id[]" required="" class="form-control">
                                            <option value="" selected="" disabled="">Select Fee Category</option>
                                            @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label class="form-label">Amount <span class="text-danger">*</span></label>
                                        <input type="text" name="amount[]" class="form-control">
                                    </div>
                                    <div class="col-md-2" style="padding-top: 32px;">
                                        <span class="btn btn-success addeventmore"><i class="bi bi-plus-circle"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div style="visibility: hidden;">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <div class="row">
                <div class="col-md-5 mb-3">
                    <label class="form-label">Student Class <span class="text-danger">*</span></label>
                    <select name="class_id[]" required="" class="form-control">
                        <option value="" selected="" disabled="">Select Fee Category</option>
                        @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5 mb-3">
                    <label class="form-label">Amount <span class="text-danger">*</span></label>
                    <input type="text" name="amount[]" class="form-control">
                </div>
                <div class="col-md-2" style="padding-top: 32px;">
                    <span class="btn btn-success addeventmore"><i class="bi bi-plus-circle"></i></span>
                    <span class="btn btn-danger removeeventmore"><i class="bi bi-dash-circle"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>


 <script type="text/javascript">
 	$(document).ready(function(){
 		var counter = 0;
 		$(document).on("click",".addeventmore",function(){
 			var whole_extra_item_add = $('#whole_extra_item_add').html();
 			$(this).closest(".add_item").append(whole_extra_item_add);
 			counter++;
 		});
 		$(document).on("click",'.removeeventmore',function(event){
 			$(this).closest(".delete_whole_extra_item_add").remove();
 			counter -= 1
 		});

 	});
 </script>


@endsection
