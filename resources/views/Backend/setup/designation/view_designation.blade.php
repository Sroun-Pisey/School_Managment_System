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
                        <h3 class="box-title">បញ្ជីឈ្មោះមុខតំណែង</h3>
                        <a href="{{ route('designation.add') }}" class="btn btn-rounded btn-success mb-5" style="float: right"><span class="fontadd">បន្ថែមមុខតំណែង</span></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Name</th>
                                    <th width="25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allData  as $key => $designation)
                                <tr>
                                    <td>{{ $key+1 }} </td>
                                    <td>{{$designation->name }}</td>
                                    <td>
                                        <a href="{{ route('designation.edit',$designation->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>
                                        <a href="{{ route('designation.delete',$designation->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>
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