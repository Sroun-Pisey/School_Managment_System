@extends('admin.admin_master')
@section('admin')


<div class="content-wrapper">
	<div class="container-full">
		<!-- Content Header (Page header) -->
		<section class="content">
			<!-- Basic Forms -->
			<div class="box">
				<div class="box-header with-border">
				<h4 class="box-title">Change Password</h4>
				
				
				@if (count($errors))
					@foreach ( $errors->all() as $error)
					<p class="alert alert-danger alert-dismissible fade show">{{ $error }}</p> 
					@endforeach
					
				@endif

			</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col">
							<form method="post" action="{{ route('password.update') }}">
							@csrf
								<div class="row">
									<div class="col-12">	
										<div class="form-group">
											<h5>Current Password <span class="text-danger">*</span></h5>
										<div class="controls">
										<input type="password" name="oldpassword" id="oldpassword" class="form-control" >
										</div>
										
										</div>

										<div class="form-group">
											<h5>New Password <span class="text-danger">*</span></h5>
											<div class="controls">
												<input type="password" name="new_password" id="new_password" class="form-control"  >
											</div>
										</div>

										<div class="form-group">
											<h5>Confirm Password  <span class="text-danger">*</span></h5>
											<div class="controls">
												<input type="password" name="confirm_password" id="confirm_password" class="form-control" >
											</div>
										
										</div>
										<div class="text-xs-right">
											<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Change Password">
										</div>
									</div>
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
	</div>
</div>





@endsection
