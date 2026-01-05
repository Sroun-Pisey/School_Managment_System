@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.8/handlebars.min.js"></script>

<div class="content-wrapper">
    <div class="container-full"> 
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                        <h4 class="box-title">បន្ថែមសិស្សបង់ប្រាក់</h4>
                        </div>
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h5 class="fontadd">ឆ្នាំសិក្សា<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <select name="year_id" id="year_id" required class="form-control">
                                            <option value="" selected="" disabled="">Select Year</option>
                                            @foreach ($years as $year)
                                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                </div><!-- End Col-md-3 -->


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h5 class="fontadd">ថ្នាក់<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <select name="class_id" id="class_id" required class="form-control">
                                            <option value="" selected="" disabled="">Select Class</option>
                                            @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                </div><!-- End Col-md-3 -->

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <h5 class="fontadd">ប្រភេទសិក្សា<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <select name="study_type_id" id="study_type_id" required class="form-control">
                                            <option value="" selected="" disabled="">Select Fee Category</option>
                                            @foreach ($study_types as $study_type)
                                            <option value="{{ $study_type->id }}">{{ $study_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                </div><!-- End Col-md-2 -->

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <h5 class="fontadd">កាលបរិច្ឆទ<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="date" id="date" class="form-control" >                                                                                           </div>
                                    </div>
                                </div><!-- End Col-md-2 -->

                                <div class="col-md-2 pt-25">
                                    <a id="search" class="btn btn-primary" name="search">Search</a>
                                </div><!-- End Col-md-2 -->
                            </div><!-- End Row-->

                            <div class="row>
                                <div class="col-md-12">
                                    <div id="DocumentResults">
                                        <script id="document-template" type="text/x-handlebars-template">
                                            <form method="post" action="{{ route('account.fee.store') }}" >
                                                @csrf
                                                <table class="table table-bordered table-striped" style="width: 100%">
                                                    <thead>
                                                        <tr>
                                                            @{{{thSource}}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @{{#each this}}
                                                        <tr>
                                                            @{{{tdSource}}}
                                                        </tr>
                                                        @{{/each}}
                                                    </tbody>
                                                </table>  
                                                <button type="submit" class="btn btn-primary" style="margin-top: 10px">Submit</button>                                          
                                            </form>
                                        </script>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div><!-- End Col-12-->         
            </div><!-- End row -->
        </section>
    </div><!-- End content -->
</div>


<script type="text/javascript">
$(document).on('click','#search',function(){
    var year_id = $('#year_id').val();
    var class_id = $('#class_id').val();
    var study_type_id = $('#study_type_id').val();
    var date = $('#date').val();
    $.ajax({
    url: "{{ route('account.fee.getstudent')}}",
    type: "get",
    data: {'year_id':year_id,'class_id':class_id,'study_type_id':study_type_id,'date':date,},
    beforeSend: function() {       
    },
    success: function (data) {
        var source = $("#document-template").html();
        var template = Handlebars.compile(source);
        var html = template(data);
        $('#DocumentResults').html(html);
        $('[data-toggle="tooltip"]').tooltip();
    }
    });
});

</script>


@endsection