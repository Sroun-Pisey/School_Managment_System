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
                        <h3 class="box-title">ការចំណាយផ្សេងៗ</h3>
                        <a href="{{ route('other.cost.add') }}" class="btn btn-rounded btn-success mb-5" style="float: right"><span class="fontadd">បន្ថែមការចំណាយផ្សេងៗ</span></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>  
                                    <th>Date</th> 
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allData  as $key => $value)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td> {{ date('d-m-Y', strtotime($value->date)) }}</td>	
                                    <td> {{ $value->amount }} $</td>
                                    <td> {{ $value->description }}</td>		
                                    <td> 
                                        <img src="{{ (!empty($value->image))? url('upload/cost_images/'.$value->image):url('upload/no_image.jpg') }}" style="width: 70px; height: 50px">
                                    </td>
                                    <td> 
                                        <a href="{{ route('edit.other.cost',$value->id ) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i></a>
                                        <a href="{{ route('delete.other.cost',$value->id ) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i></a>
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