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
                        <h3 class="box-title">បញ្ជីប្រាក់ខែបុគ្គលិកបើកហើយ</h3>
                        <a href="{{ route('account.salary.add') }}" class="btn btn-rounded btn-success mb-5" style="float: right"><span class="fontadd">បន្ថែម/កែប្រាក់ខែបុគ្គលិកបើកហើយ</span></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>  
                                    <th>ID No</th> 
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allData  as $key => $value)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td> {{ $value['user']['id_no'] }}</td>	
                                    <td> {{ $value['user']['name'] }}</td>	
                                    <td> {{ $value->amount }}</td>	
                                    <td> {{ date('M Y', strtotime($value->date))}}</td>	
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