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
			<a href="{{URL::to('/')}}/admin/courses">الدورات</a>
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
					<span class="caption-subject font-green bold uppercase">تعديل بيانات دورة</span>
				</div>
			</div>

			<div class="portlet-body">
				
				<!-- BEGIN FORM-->
				{{Form::open(array('route' => ['admin.courses.update' , $data['course']->id], 'method'=>'put' , 'files'=>'true' , 'class'=>'form-horizontal'))}}
				<div class="form-body">

					@if(Session::has('global_s'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('global_s')}}
					</div>
					@endif

					<div class="form-group">
						<label class="control-label col-md-3">اسم الدورة</label>
						<div class="col-md-8">
							{{Form::text('name' , $data['course']->name , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" ])}}
							<font color="red">{{$errors->first('name')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الدولة</label>
						<div class="col-md-8">
							{{Form::select('country' , $data['countries'] , $data['course']->country , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار الدولة' , "class"=>"bs-select form-control" , "data-live-search"=>"true"])}}
							<font color="red">{{$errors->first('country')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">المدينة</label>
						<div class="col-md-8">
							{{Form::select('city' , $data['cities'] , $data['course']->city , ["class"=>"bs-select form-control" , "data-live-search"=>"true"  , "data-live-search"=>"true"])}}
							<font color="red">{{$errors->first('city')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">نوع الدورة</label>
						<div class="col-md-8">
							{{Form::text('type', $data['course']->type , ['class'=>'form-control'])}}
							<font color="red">{{$errors->first('type')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">مدة الدورة باﻷيام</label>
						<div class="col-md-8">
							{{Form::text('duration_in_days', $data['course']->duration_in_days , ['class'=>'form-control'])}}
							<font color="red">{{$errors->first('duration_in_days')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">مدة الدورة بالاسابيع</label>
						<div class="col-md-8">
							{{Form::text('duration_in_weeks', $data['course']->duration_in_weeks , ['class'=>'form-control'])}}
							<font color="red">{{$errors->first('duration_in_weeks')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">مدة الدورة بالشهور</label>
						<div class="col-md-8">
							{{Form::text('duration_in_month', $data['course']->duration_in_month , ['class'=>'form-control'])}}
							<font color="red">{{$errors->first('duration_in_month')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">تاريخ البداية</label>
						<div class="col-md-8">
							{{Form::text('start_date' , $data['course']->start_date , ["autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"form-control form-control-inline  date-picker" , "placeholder"=>"dd/mm/yyyy"])}}
							<font color="red">{{$errors->first('start_date')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">تاريخ النهاية</label>
						<div class="col-md-8">
							{{Form::text('end_date' , $data['course']->end_date , ["autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"form-control form-control-inline  date-picker" , "placeholder"=>"dd/mm/yyyy"])}}
							<font color="red">{{$errors->first('end_date')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">مستوى الدورة</label>
						<div class="col-md-8">
							{{Form::select('level',  ["b"=>"مبتدء" , "m"=>"متوسط" , "a"=>"متقدم"] , $data['course']->level , ['class'=>'form-control' , 'placeholder'=>'من فضلك اختر مستوى الدورة'])}}
							<font color="red">{{$errors->first('level')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">لغة الدورة</label>
						<div class="col-md-8">
							{{Form::select('language', ["a"=>"عربى" , "e"=>"انجليزى"] , $data['course']->language , ['class'=>'form-control' , 'placeholder'=>'من فضلك اختر لغة الدورة'])}}
							<font color="red">{{$errors->first('language')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">عدد الساعات اليومية</label>
						<div class="col-md-8">
							{{Form::text('dayly_hours' , $data['course']->dayly_hours , ["autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"form-control"])}}
							<font color="red">{{$errors->first('dayly_hours')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">اجمالى الساعات</label>
						<div class="col-md-8">
							{{Form::text('total_hours' , $data['course']->total_hours , ["autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"form-control"])}}
							<font color="red">{{$errors->first('total_hours')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">سعر الدورة</label>
						<div class="col-md-8">
							{{Form::text('price' , $data['course']->price , ["autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"form-control"])}}
							<font color="red">{{$errors->first('price')}}</font><br>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">متطلبات و شروط الدورة</label>
						<div class="col-md-8">
							{{Form::textarea('conditions' , $data['course']->conditions , ["autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"form-control"])}}
							<font color="red">{{$errors->first('conditions')}}</font><br>
						</div>
					</div>


					<div class="form-group">
						<center>
							<label for="inputEmail3" class="col-sm-3 control-label">صورة اعلان الدورة</label>
							<div class="col-md-8">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="fileinput-new thumbnail" style="width: 265px; height: 200px;">
										<img src="{{URL::to($data['course']->advertisment_photo)}}" alt="" width="265" />
									</div>
									<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 265px; max-height: 200px;">
									</div>
									<div>
										<span class="btn  btn-large btn-primary btn-file">
											<span class="fileinput-new">
												تغيير الصورة </span>
												<span class="fileinput-exists">
													تغيير </span>
													<input type="file" name="advertisment_photo"  class="btn btn-danger">
												</span>
												<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
													مسح </a>
												</div>
												<span style="color:red">{{$errors->first('advertisment_photo')}}</span>
											</div>
										</div>
									</center>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">تاريخ اعلان الدورة</label>
									<div class="col-md-8">
										{{Form::text('advertisment_date' , $data['course']->advertisment_date , ["autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"form-control form-control-inline  date-picker" , "placeholder"=>"dd/mm/yyyy"])}}
										<font color="red">{{$errors->first('advertisment_date')}}</font><br>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">مدة الاعلان</label>
									<div class="col-md-8">
										{{Form::text('advertisment_duration' , $data['course']->advertisment_duration , ["autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"form-control"])}}
										<font color="red">{{$errors->first('advertisment_duration')}}</font><br>
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