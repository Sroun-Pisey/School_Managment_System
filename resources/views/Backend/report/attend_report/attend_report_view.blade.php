@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
    <div class="container-full"> 
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                        <h4 class="box-title">របាយការណ៍គ្រប់គ្រង់វត្តមានបុគ្គលិក</h4>
                        </div>
                        <div class="box-body">
                            <form method="GET" action="{{ route('report.attendance.get') }}" target="_blank">
                                @csrf
                                <div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<h5 class="fontadd">ឈ្មោះបុគ្គលិក<span class="text-danger"></span></h5>
										<div class="controls">
											<select name="employee_id" id="employee_id" required class="form-control">
												<option value="" selected="" disabled="">ជ្រើសបុគ្គលិក</option>
												@foreach ($employees as $employee)
												<option value="{{ $employee->id }}">{{ $employee->name }}</option>
												@endforeach
											</select>
										</div>
										</div>
									</div><!-- End Col-md-4 -->

									<div class="col-md-4">
										<div class="form-group">
											<h5 class="fontadd"> ខែ-ថ្ងៃ-ឆ្នាំ <span class="text-danger">*</span></h5>
											<div class="controls">
											<input type="date" name="date" class="form-control" required=""> 
											</div>		 
										</div>
									</div><!-- End Col-md-4 -->
								
									<div class="col-md-4 pt-25">
										<input type="submit" class="btn btn-rounded btn-primary" value="Search">
									</div><!-- End Col-md-4 -->
                                </div><!-- End Row-->
                            </form>
                        </div>
                    </div>
                </div><!-- End Col-12-->         
            </div><!-- End row -->
        </section>
    </div><!-- End content -->
</div>


@endsection