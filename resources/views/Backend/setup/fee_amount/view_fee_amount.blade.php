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
                        <h3 class="box-title">ប្រភេទបង់ថ្លៃសិក្សា</h3>
                        <a href="{{ route('fee.amount.add') }}" class="btn btn-rounded btn-success mb-5" style="float: right"><span class="fontadd">បន្ថែមប្រភេទបង់ថ្លៃ</span></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Fee Category</th>
                                    <th width="25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allData  as $key => $amount)
                                <tr>
                                    <td>{{ $key+1 }} </td>
                                    <td>{{$amount ["fee_category"]['name'] ?? 'N/A'}}</td>
                                    <td>
                                        <a href="{{ route('fee.amount.edit',$amount->fee_category_id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>
                                        <a href="{{ route('fee.amount.details',$amount->fee_category_id) }}" class="btn btn-primary sm" title="Details Data" id="Details"><i class="fa-regular fa-eye"></i> </a>
                                    </td>
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