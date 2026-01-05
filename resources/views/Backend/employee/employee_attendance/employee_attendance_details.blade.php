@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full"> 
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><Span class="fontadd">បង្ហាញព័ត៌មានការឈប់សម្រាកបុគ្គលិកប្រចាំថ្ងៃ</Span></h3>
                        </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="treeview">
                                        <th width="5%">SL</th>
                                        <th>ឈ្មោះ</th>
                                        <th>ID No</th>
                                        <th>ពេលវេលា</th>
                                        <th>វត្តមាន</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details  as $key => $attend)
                                    <tr>
                                        <td>{{ $key+1 }} </td>
                                        <td>{{$attend['user']['name']}}</td>
                                        <td>{{$attend['user']['id_no']}}</td>
                                        <td>{{ date('d-m-Y',strtotime($attend->date)) }}</td>
                                        <td>{{ $attend->attend_status }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                            
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- End col -->          
            </div>
            <!-- End row -->
        </section>
    </div>
</div>




@endsection