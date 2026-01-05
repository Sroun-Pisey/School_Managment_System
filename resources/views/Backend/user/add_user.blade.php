@extends('admin.admin_master')
@section('admin')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
    <!-- Main content -->
    <section class="content">

    <!-- Basic Forms -->
        <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">បន្ថែមអ្នកប្រើប្រាស់</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form method="post" action="{{ route('user.store') }}">
                        @csrf

                        <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5 class="fontadd">Role អ្នកប្រើប្រាស់<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="role" id="role" required class="form-control">
                                                <option value="" selected="" disabled="">Select Role</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Operator">Operator</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><!-- End Col-6 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5 class="fontadd">ឈ្មោះអ្នកប្រើប្រាស់ <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control" required="" aria-invalid="false"> </div>
                                    </div>
                                </div><!-- End Col-6 -->
                            </div><!-- End Row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5 class="fontadd">អ៊ីម៉ែលអ្នកប្រើប្រាស់ <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="email" class="form-control" required="" aria-invalid="false"> </div>
                                    </div>
                                </div><!-- End Col-6 -->
                                <div class="col-md-6">
                                    
                                </div><!-- End Col-6 -->
                            </div><!-- End Row -->
                        </div>
                        <div class="col-12">
                            <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
                        </div>
                    </form>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->






@endsection