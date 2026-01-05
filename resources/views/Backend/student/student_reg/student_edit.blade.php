@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <section class="content">
            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                <h4 class="box-title">កែប្រែសិស្ស</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('update.student.registration',$editData->student_id) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $editData->id}}">
                            <div class="row">
                                <div class="col-12">	
                                    
                                    <div class="row"> <!-- 1st Row -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5 class="fontadd">គោតនាម<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                <input type="text" name="name" class="form-control" required="" value="{{ $editData['student']['name'] }}" > 
                                                </div>		 
                                            </div>
                                        </div> <!-- End Col md 4 -->
                        
                                        <div class="col-md-4">     
                                            <div class="form-group">
                                                <h5 class="fontadd">ឪពុកឈ្មោះ<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                <input type="text" name="fname" class="form-control" required=""value="{{ $editData['student']['fname'] }}" > 
                                                </div>		 
                                            </div>
                                        </div> <!-- End Col md 4 -->
                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5 class="fontadd">ម្តាយឈ្មោះ<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                <input type="text" name="mname" class="form-control" required="" value="{{ $editData['student']['mname'] }}"> 
                                                </div>		 
                                            </div>
                                        </div> <!-- End Col md 4 -->    
                                    </div> <!-- End 1stRow -->


                                    <div class="row"><!-- 2st Row Start -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5 class="fontadd">ភេទ<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="gender" id="gender " required class="form-control">
                                                    <option value="" selected="" disabled="">Select Gender </option>
                                                    <option value="Male" {{ ($editData['student']['gender'] == 'Male')? 'selected':''}}>Male</option>
                                                    <option value="Female" {{ ($editData['student']['gender'] == 'Female')? 'selected':''}}>Female</option>
                                                </select>
                                            </div>
                                            </div>
                                        </div><!-- End Col-md-4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5 class="fontadd">ខែ-ថ្ងៃ-ឆ្នាំកំណើត<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="dob" class="form-control" required="" value="{{ $editData['student']['dob'] }}"> 
                                            </div>
                                            </div>
                                        </div><!-- End Col-md-4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5 class="fontadd">ទីកន្លែងកំណើត<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="address" class="form-control" required="" value="{{ $editData['student']['address'] }}"> 
                                            </div>
                                            </div>
                                        </div><!-- End Col-md-4 -->
                                    </div><!-- End 2st Row -->


                                    <div class="row"><!-- 3rd Row Start -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5 class="fontadd">លេខទូរសព្ទ<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="mobile" class="form-control" required="" value="{{ $editData['student']['mobile'] }}" > 
                                            </div>
                                            </div>
                                        </div><!-- End Col-md-4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5 class="fontadd">មុខវិជ្ជា<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="subject_id" required class="form-control">
                                                    <option value="" selected="" disabled="">ជ្រើសមុខវិជ្ជា</option>
                                                    @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}" {{ ($editData->subject_id == $subject->id)? 'selected':'' }}>{{ $subject->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>
                                        </div><!-- End Col-md-4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5 class="fontadd">ប្រភេទសិក្សា<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="study_type_id" required class="form-control">
                                                    <option value="" selected="" disabled=""><h5 class="fontadd">ប្រភេទសិក្សា</option>
                                                    @foreach ($study_types as $study_type)
                                                    <option value="{{ $study_type->id }}" {{ ($editData->study_type_id == $study_type->id)? 'selected':'' }}>{{ $study_type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>
                                        </div><!-- End Col-md-4 -->
                                    </div><!-- End 3rd Row -->


                                    <div class="row"><!-- 4th Row Start -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5 class="fontadd">ថ្នាក់<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="class_id" required class="form-control">
                                                    <option value="" selected="" disabled="">Select Class</option>
                                                    @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}" {{ ($editData->class_id == $class->id)? 'selected':'' }}>{{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>
                                        </div><!-- End Col-md-4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5 class="fontadd">ឆ្នាំសិក្សា<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="year_id" required class="form-control">
                                                    <option value="" selected="" disabled="">Select Year</option>
                                                    @foreach ($years as $year)
                                                    <option value="{{ $year->id }}" {{ ($editData->year_id == $year->id)? 'selected':'' }}> {{ $year->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>
                                        </div><!-- End Col-md-4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5 class="fontadd">រូបភាព <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="image" class="form-control" id="image">
                                                </div>
                                            </div>
                                        </div><!-- End Col-md-4 -->
                                    </div><!-- End 4th Row -->


                                    <div class="row"><!-- 5th Row Start -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5 class="fontadd">ម៉ោងសិក្សា<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="study_time_id" required class="form-control">
                                                    <option value="" selected="" disabled="">ជ្រើសម៉ោងសិក្សា</option>
                                                    @foreach ($study_times as $study_time)
                                                    <option value="{{ $study_time->id }}" {{ ($editData->study_time_id == $study_time->id)? 'selected':'' }}>{{ $study_time->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>
                                        </div><!-- End Col-md-4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5 class="fontadd">បញ្ចុះតម្លៃ<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="discount" class="form-control" required="" value="{{ $editData['discount']['discount'] }}"> 
                                            </div>
                                            </div>
                                        </div><!-- End Col-md-4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="controls">
                                            <img id="showImage" src="{{ (!empty($editData['student']['image']))? url('upload/student_images/'.$editData['student']['image']):url('upload/no_image.jpg') }}" style="width: 100px; width: 100px; border: 1px solid #000000;"> 
                                            </div>
                                            </div>
                                        </div><!-- End Col-md-4 -->

                                    </div><!-- End 5th Row -->


                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info mb-5" value="Update">
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


<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>


@endsection
