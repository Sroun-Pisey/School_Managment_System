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
                        <h3 class="box-title">បញ្ជីប្រាក់ខែបុគ្គលិក</h3>
                        <a href="{{ route('employee.registration.add') }}" class="btn btn-rounded btn-success mb-5" style="float: right"><span class="fontadd">បន្ថែមបុគ្គលិក</span></a>
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
                                        <th>Image</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allData  as $key => $value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td> {{ $value->name }}</td>	
                                        <td> {{ $value->id_no }}</td>	
                                        <td> {{ $value->mobile }}</td>	
                                        <td> {{ $value->gender }}</td>	
                                        <td> {{ date('d-m-Y',strtotime($value->join_date)) }}</td>	
                                        <td> {{ $value->salary }}</td>
                                        <td>
                                            <img id="showImage" src="{{ (!empty($value->image))? url('upload/employee_images/'.$value->image):url('upload/no_image.jpg') }}" style="width: 60px; width: 60px;">
                                        </td>
                                        <td>
                                            <a href="{{ route('employee.salary.increment',$value->id) }}" class="btn btn-info sm" title="Increment">  <i class="fas fa-plus-circle"></i> </a>
                                            <a href="{{ route('employee.increment.details',$value->id) }}" class="btn btn-danger sm" target="_blank" title="Details Data"><i class="fa-regular fa-eye"></i> </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
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