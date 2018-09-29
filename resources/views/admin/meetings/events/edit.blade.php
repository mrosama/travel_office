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
			<a href="{{URL::to('/')}}/admin/meetings">الاجتماعات</a>
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
					<span class="caption-subject font-green bold uppercase">تعديل احداث الاجتماع <b><font color="red">{{$data['event_meeting']->meeting->address}}</font></b></span>
				</div>
			</div>

			<div class="portlet-body">
				
				<!-- BEGIN FORM-->
				{{Form::open(array('route' => ['admin.meetings.events.update' , $data['event_meeting']->id], 'method'=>'put' , 'files'=>'true' , 'class'=>'form-horizontal'))}}
				<div class="form-body">

					@if(Session::has('global_s'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('global_s')}}
					</div>
					@endif

					<div class="form-group">
					<div class=" col-md-12 text-center">
						<font color="red"><a href="{{URL::to('admin/meetings' , [$data['event_meeting']->id , 'event' , 'absences'])}}">عرض الاشخاص الذين لم يحضروا الاجتماع وتحديد سبب عدم الحضور</a></font>
					</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الحاضرين</label>
						<div class="col-md-8">
							{{Form::select('attendants[]' , $data['employees'] , json_decode($data['event_meeting']->attendants) , ['class'=>'form-control select2-multiple' , 'id'=>'multiple' , 'multiple' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "data-live-search"=>"true" ])}}
							<font color="red">{{$errors->first('attendants')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">ملف</label>
						<div class="col-md-8">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="input-group input-large">
									<div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
										<i class="fa fa-file fileinput-exists"></i>&nbsp;
										<span class="fileinput-filename"></span>
									</div>
									<span class="input-group-addon btn default btn-file">
										<span class="fileinput-new"> Select file </span>
										<span class="fileinput-exists"> Change </span>
										<input type="hidden" value="" name="..."><input type="file" name="file" value=""> </span>
										<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
									</div>
								</div>						
								<font color="red">{{$errors->first('file')}}</font>
								<br>
								<p>
									@if($data['event_meeting']->file != null)
									لرؤية الملف المرفوع من قبل <a href="{{URL::to($data['event_meeting']->file)}}"> اضغط هنا</a>
									@else
									لا يوجد ملف مرفوع من قبل
									@endif
								</p>
							</div>
						</div>



						<div class="form-group">
							<label class="control-label col-md-3">الملاحظات الايجابية</label>
							<div class="col-md-8">
								{{Form::textarea('positive_remarks' , $data['event_meeting']->positive_remarks , ['class'=>'form-control'])}}
								<font color="red">{{$errors->first('positive_remarks')}}</font><br>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">الملاحظات السلبية</label>
							<div class="col-md-8">
								{{Form::textarea('negative_remarks' , $data['event_meeting']->negative_remarks , ['class'=>'form-control'])}}
								<font color="red">{{$errors->first('negative_remarks')}}</font><br>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">التوصيات و الاقتراحات</label>
							<div class="col-md-8">
								{{Form::textarea('recommendations' , $data['event_meeting']->recommendations , ['class'=>'form-control'])}}
								<font color="red">{{$errors->first('recommendations')}}</font><br>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">ملاحظات</label>
							<div class="col-md-8">
								{{Form::textarea('notes' , $data['event_meeting']->notes , ['class'=>'form-control'])}}
								<font color="red">{{$errors->first('notes')}}</font><br>
							</div>
						</div>


						<div class="form-actions">
							<div class="row">
								<div class="text-center">
									<button type="submit" class="btn green">تعديل و ارسال</button>
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

		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<script src="{{URL::to('/')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
		<script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
		<script src="{{URL::to('/')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
		<script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL PLUGINS -->

		<script src="{{URL::to('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
		<script src="{{URL::to('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
		@stop

		@stop