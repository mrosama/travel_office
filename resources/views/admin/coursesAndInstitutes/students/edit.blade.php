@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
@section('CssLinks')
<link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@stop

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/institute">المعاهد والجامعات</a>
		</li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light portlet-fit portlet-form ">
			<div class="portlet-title">
				<div class="caption" style="float:right">
					<i class="fa fa-user font-green"></i>
					<span class="caption-subject font-green bold uppercase">اضافه  طالب جديد</span>
				</div>
			</div>

			<div class="portlet-body">
				
				<!-- BEGIN FORM-->
				{{Form::open(array('route' => ['admin.students.update' , $data['institute']->id , $data['student']->id], 'method'=>'put' , 'files'=>'true' , 'class'=>'form-horizontal'))}}
				<div class="form-body">

					@if(Session::has('global_s'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('global_s')}}
					</div>
					@endif

					<div class="form-group">
						<center>
							<label for="inputEmail3" class="col-sm-3 control-label">الصورة الشخصية</label>
							<div class="col-md-8">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="fileinput-new thumbnail" style="width: 265px; height: 200px;">
										<img src="{{URL::to($data['student']->photo)}}" alt="" width="265" />
									</div>
									<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 265px; max-height: 200px;">
									</div>
									<div>
										<span class="btn  btn-large btn-primary btn-file">
											<span class="fileinput-new">
												تغيير الصورة </span>
												<span class="fileinput-exists">
													تغيير </span>
													<input type="file" name="photo"  class="btn btn-danger">
												</span>
												<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
													مسح </a>
												</div>
												<span style="color:red">{{$errors->first('photo')}}</span>
											</div>
										</div>
									</center>
								</div>


								<div class="form-group">
									<label class="control-label col-md-3">الاسم</label>
									<div class="col-md-8">
										{{Form::text('name' , $data['student']->name , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" ])}}
										<font color="red">{{$errors->first('name')}}</font><br>
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-md-3">الدولة</label>
									<div class="col-md-8">
									{{Form::select('country' , $data['countries'] , $data['student']->country , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار الدولة' , "class"=>"bs-select form-control" , "data-live-search"=>"true"])}}
										<font color="red">{{$errors->first('country')}}</font><br>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">المدينة</label>
									<div class="col-md-8">
									{{Form::select('city' , $data['cities'] , $data['student']->city , ["class"=>"bs-select form-control" , "data-live-search"=>"true"  , "data-live-search"=>"true"])}}
										<font color="red">{{$errors->first('city')}}</font><br>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">تاريخ الميلاد</label>
									<div class="col-md-8">
										{{Form::text('birth_date' , $data['student']->birth_date , ["autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"form-control form-control-inline  date-picker" , "placeholder"=>"dd/mm/yyyy"])}}
										<font color="red">{{$errors->first('birth_date')}}</font><br>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">الجنسية</label>
									<div class="col-md-8">
										{{Form::text('nationality' , $data['student']->nationality , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" ])}}
										<font color="red">{{$errors->first('nationality')}}</font><br>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">البريد الالكترونى</label>
									<div class="col-md-8">
										{{Form::email('email' , $data['student']->email , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" ])}}
										<font color="red">{{$errors->first('email')}}</font><br>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">الجوال</label>
									<div class="col-md-8">
										{{Form::text('mobile' , $data['student']->mobile , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" ])}}
										<font color="red">{{$errors->first('mobile')}}</font><br>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">ملاحظات</label>
									<div class="col-md-8">
										{{Form::textarea('notes' , $data['student']->notes , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" ])}}
										<font color="red">{{$errors->first('notes')}}</font><br>
									</div>
								</div>


								<div class="form-actions">
									<div class="row">
										<div class="text-center">
											<button type="submit" class="btn green">تعديل</button>
											<button type="reset" class="btn default">الغاء </button>
										</div>
									</div>
								</div>

								{{Form::close()}}
								<!-- END FORM-->
							</div>
						</div>
						<!-- END VALIDATION STATES-->
					</div>
				</div>

				@section('JsScripts')
				<script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
				<script type="text/javascript" src="{{URL::to('/assets/getCityAjax.js')}}"></script>
				@stop

				@stop