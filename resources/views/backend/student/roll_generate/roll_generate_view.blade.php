@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="row">
    <div class="col-12">
        <div class="card border-warning">
            <div class="card-header">
                <h5 class="card-title mb-0">Student <strong>Roll Generator</strong></h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('roll.generate.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Year <span class="text-danger"> </span></label>
                                <select name="year_id" id="year_id" required="" class="form-select">
                                    <option value="" selected="" disabled="">Select Year</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year->id }}" >{{ $year->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Class <span class="text-danger"> </span></label>
                                <select name="class_id" id="class_id"  required="" class="form-select">
                                    <option value="" selected="" disabled="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-top: 25px;">
                            <a id="search" class="btn btn-primary" name="search"> Search</a>
                        </div>
                    </div>

                    <div class="row d-none" id="roll-generate">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>ID No</th>
                                        <th>Student Name </th>
                                        <th>Father Name </th>
                                        <th>Gender</th>
                                        <th>Roll</th>
                                    </tr>
                                </thead>
                                <tbody id="roll-generate-tr"></tbody>
                            </table>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Roll Generator</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).on('click','#search',function(){
    var year_id = $('#year_id').val();
    var class_id = $('#class_id').val();
     $.ajax({
      url: "{{ route('student.registration.getstudents')}}",
      type: "GET",
      data: {'year_id':year_id,'class_id':class_id},
      success: function (data) {
        $('#roll-generate').removeClass('d-none');
        var html = '';
        $.each( data, function(key, v){
          html +=
          '<tr>'+
          '<td>'+v.student.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
          '<td>'+v.student.name+'</td>'+
          '<td>'+v.student.fname+'</td>'+
          '<td>'+v.student.gender+'</td>'+
          '<td><input type="text" class="form-control form-control-sm" name="roll[]" value="'+v.roll+'"></td>'+
          '</tr>';
        });
        html = $('#roll-generate-tr').html(html);
      }
    });
  });
</script>

@endsection
