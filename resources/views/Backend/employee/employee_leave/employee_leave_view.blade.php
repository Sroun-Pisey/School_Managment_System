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
                        <h3 class="box-title">បញ្ជីបុគ្គលិកសុំច្បាប់</h3>
                        <a href="{{ route('employee.leave.add') }}" class="btn btn-rounded btn-success mb-5" style="float: right"> <span class=" fontadd">បន្ថែមច្បាប់បុគ្គលិក</span></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Name</th>
                                    <th>ID No</th>
                                    <th>Purpose</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Image</th>
                                    <th width="25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allData  as $key => $leave)
                                <tr>
                                    <td>{{ $key+1 }} </td>
                                    <td>{{$leave['user']['name'] }}</td>
                                    <td>{{$leave['user']['id_no'] }}</td>
                                    <td>{{$leave['purpose']['name'] }}</td>
                                    <td>{{$leave->start_date }}</td>
                                    <td>{{$leave->end_date	 }}</td>
                                    <td>
                                        <img id="showImage" src="{{ (!empty($leave['user']['image']))? url('upload/employee_images/'.$leave['user']['image']):url('upload/no_image.jpg') }}" style="width: 60px; width: 60px;">
                                    </td>
                                    <td>
                                        <a href="{{ route('employee.leave.edit',$leave->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>
                                        <a href="{{ route('employee.leave.delete',$leave->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>
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