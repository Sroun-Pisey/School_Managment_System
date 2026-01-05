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
                        <h4 class="box-title">គ្រប់គ្រង់ប្រាក់ណូល-ចំណាយ-ចំណេញប្រចាំខែ/ឆ្នាំ</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5 class="fontadd">ចាប់ផ្តើម<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="start_date" id="start_date" class="form-control" >                                                                                           </div>
                                    </div>
                                </div><!-- End Col-md-6 -->


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5 class="fontadd">បញ្ចប់<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="end_date" id="end_date" class="form-control" >                                                                                           </div>
                                    </div>
                                </div><!-- End Col-md-6 -->


                                <div class="col-md-4 pt-25">
                                    <a id="search" class="btn btn-primary" name="search" >Search</a>
                                </div><!-- End Col-md-4 -->
                            </div><!-- End Row-->

                       <!-- /////////////////// Registration Fee table ///////////////// -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="DocumentResults">
                                        <script id="document-template" type="text/x-handlebars-template">
                                            <table class="table table-bordered table-striped" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        @{{{thSource}}}
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        @{{{tdSource}}}
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </script>

                                    </div>
                                </div><!-- End Col-12-->  
                            </div><!-- End row -->

                        <!-- /////////////////// End Registration Fee table ///////////////// -->

                        
                        </div>
                    </div>
                </div><!-- End Col-12-->         
            </div><!-- End row -->
        </section>
    </div><!-- End content -->
</div>

<!-- ============ Get Registration Fee Method And View Page =================== -->

<script type="text/javascript">
$(document).on('click','#search',function(){
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    $.ajax({
    url: "{{ route('report.profit.datewais.get')}}",
    type: "get",
    data: {'start_date':start_date,'end_date':end_date,},
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