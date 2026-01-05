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
                        <h3 class="box-title">បញ្ជីបុគ្គលិក</h3>
                        <a href="{{ route('employee.registration.add') }}" class="btn btn-rounded btn-success mb-5" style="float: right"><spanc class="fontadd">បន្ថែមបុគ្គលិក</span></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>  
                                    <th>Name</th> 
                                    <th>ID NO</th>
                                    <th>Mobile</th>
                                    <th>Gender</th>
                                    <th>Join Date</th>
                                    <th>Salary</th>
                                    <th>image</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allData  as $key => $employee)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td> {{ $employee->name }}</td>	
                                    <td> {{ $employee->id_no }}</td>	
                                    <td> {{ $employee->mobile }}</td>	
                                    <td> {{ $employee->gender }}</td>	
                                    <td> {{ $employee->join_date }}</td>	
                                    <td> {{ $employee->salary }}</td>
                                    <td>
                                        <img id="showImage" src="{{ (!empty($employee->image))? url('upload/employee_images/'.$employee->image):url('upload/no_image.jpg') }}" style="width: 60px; width: 60px;">
                                    </td>
                                    <td>
                                        <a href="{{ route('employee.registration.edit',$employee->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>
                                        <a href="{{ route('employee.registration.details',$employee->id) }}" class="btn btn-danger sm" target="_blank" title="Details Data"><i class="fa-regular fa-eye"></i> </a>
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