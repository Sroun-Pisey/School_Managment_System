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
                        <h4 class="box-title">បើកប្រាក់ខែបុគ្គលិក</h4>
                        </div>
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5 class="fontadd">កាលបរិច្ឆេទបើកប្រាក់ខែបុគ្គលិក<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="date" id="date" class="form-control" >                                                                                           </div>
                                    </div>
                                </div><!-- End Col-md-6 -->
                                

                                <div class="col-md-6 pt-25">
                                    <a id="search" class="btn btn-primary" name="search" >Search</a>
                                </div><!-- End Col-md-6 -->
                            </div><!-- End Row-->

                    
                            <div class="row>
                                <div class="col-md-12">
                                    <div id="DocumentResults">
                                        <script id="document-template" type="text/x-handlebars-template">
                                            <form method="post" action="{{ route('account.salary.store') }}" >
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
    var date = $('#date').val();
    $.ajax({
    url: "{{ route('account.salary.getemployee')}}",
    type: "get",
    data: {'date':date,},
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