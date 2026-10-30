@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>

 <div class="row">

    <div class="col-12">
        <div class="card border-warning">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Employee <strong>Monthly Salary</strong></h5>
            </div>
            <div class="card-body">

                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Attendance Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" id="date" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6" style="padding-top: 25px;">
                        <a id="search" class="btn btn-primary" name="search">Search</a>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div id="DocumentResults">

                            <script id="document-template" type="text/x-handlebars-template">

                                <table class="table table-bordered table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            @{{{thsource}}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @{{#each this}}
                                        <tr>
                                            @{{{tdsource}}}
                                        </tr>
                                        @{{/each}}
                                    </tbody>
                                </table>
                            </script>


                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>



<script type="text/javascript">
  $(document).on('click','#search',function(){
    var date = $('#date').val();   
     $.ajax({
      url: "{{ route('employee.monthly.salary.get')}}",
      type: "get",
      data: {'date':date},
      beforeSend: function() {       
      },
      success: function (data) {
        var source = $("#document-template").html();
        var template = Handlebars.compile(source);
        var html = template(data);
        $('#DocumentResults').html(html);
        $('[data-bs-toggle="tooltip"]').tooltip();
      }
    });
  });

</script>



@endsection
