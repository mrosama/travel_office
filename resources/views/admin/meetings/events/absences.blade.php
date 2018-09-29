@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->

@section('CssLinks')
<link href="{{URL::to('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />

<style type="text/css">
	.dola td{
		text-align: center !important;
	}
	
</style>
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
					<i class="fa fa-user font-green"></i>الاشخاص الذين لم يحضروا الاجتماع
				</div>
			</div>

			<div class="portlet-body">
				
				<div class="form-horizontal">

					<div class="form-body">

						@if(Session::has('global_s'))
						<div class="alert alert-success" style="text-align : right;">
							<strong>شكرا لك ! </strong> {{Session::get('global_s')}}
						</div>
						@endif
						@if(count($absences) != 0 )
						<table class="table dola">
							<tr>
								<td>م</td>
								<td>الاسم</td>
								<td>البريد الالكترونى</td>
								<td>سبب عدم الحضور</td>
								<td></td>
							</tr>
							@foreach($absences as $absence)
							<tr>
								<?php $getReason = \App\Meeting_Reason::where('meeting_event_id' , $event_id)->where('employee_id' , $absence->id)->first(); ?>
								<td>{{++$i}}</td>
								<td>{{$absence->name}}</td>
								<td>{{$absence->email}}</td>
								{{Form::open(['route'=>['store.reason' , $event_id , $absence->id] , 'method'=>'post'])}}
								<td>
									<textarea class="form-control" name="reason" rows="3">
										@if($getReason!=null)
										{{$getReason->reason}}
										@endif
									</textarea>
								</td>
								<td>{{Form::submit('حفظ' , ['class'=>'btn green'])}}</td>
								{{Form::close()}}
							</tr>
							@endforeach
						</table>
						@else
						<h2><center><font color="green">جميع الموظفين قد حضروا الاجتماع</font></center></h2>
						@endif

					</div>
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
	<!-- END PAGE LEVEL PLUGINS -->


	<script src="{{URL::to('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
	<script src="{{URL::to('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
	@stop

	@stop