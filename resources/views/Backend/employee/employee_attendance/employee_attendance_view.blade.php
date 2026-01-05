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
                        <h3 class="box-title">បញ្ជីសម្រង់វត្តមានប្រចាំថ្ងៃបុគ្គលិក</h3>
                        <a href="{{ route('employee.attendance.add') }}" class="btn btn-rounded btn-success mb-5" style="float: right"><span class="fontadd">បន្ថែមវត្តមាន</span></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Date</th>
                                    <th width="25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allData  as $key => $attend)
                                <tr>
                                    <td>{{ $key+1 }} </td>

                                    <td>{{ date('d-m-Y',strtotime($attend->date)) }}</td>
                                    <td>
                                        <a href="{{ route('employee.attendance.edit',$attend->date) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>
                                        <a href="{{ route('employee.attendance.delete',$attend->date) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i> </a>
                                        <a href="{{ route('employee.attendance.details',$attend->date) }}" class="btn btn-danger sm" title="Detial Data" id="detial"><i class="fa-regular fa-eye"></i> </a>
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