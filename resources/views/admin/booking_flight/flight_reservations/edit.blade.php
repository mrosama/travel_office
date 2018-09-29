@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
@section('CssLinks')
<link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.client-reserved-seat{
		background-color: rgba(0, 128, 0, 0.68);
	}
</style>
@stop

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/flight/reservations">الطلبات</a>
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
					<span class="caption-subject font-green bold uppercase"> تعديل حجز رحلة</span>
				</div>
			</div>

			<div class="portlet-body">
				
				<!-- BEGIN FORM-->
				{{Form::open(array('route' => ['admin.flight.reservations.update' , $flight_reservation->id], 'method'=>'put' , 'class'=>'form-horizontal' , 'id'=>'theForm'))}}
				<div class="form-body">

					@if(Session::has('global_s'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('global_s')}}
					</div>
					@endif

					@if(Session::has('global_r'))
					<div class="alert alert-danger" style="text-align : right;">
						<strong>خطأ! </strong> {{Session::get('global_r')}}
					</div>
					@endif

					{{Form::hidden('' , $flight_reservation->id , ['id'=>'flight_id'])}}
					
					<div class="form-group">
						<label class="control-label col-md-3">العميل</label>
						<div class="col-md-8">
							{{Form::select('client_id' , $clients , $flight_reservation->client_id , ["class"=>"bs-select form-control" , "data-live-search"=>"true" , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'من فضلك اختر العميل'])}}
							<font color="red">{{$errors->first('client_id')}}</font><br>
							<div id="ClientProgramInfo"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">البرنامج السياحى</label>
						<div class="col-md-8">
							{{Form::select('tourist_program_id' , $tourist_programmes , $flight_reservation->tourist_program_id , ["class"=>"form-control" , "data-live-search"=>"true" , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'من فضلك اختر البرنامج السياحى'])}}
							<font color="red">{{$errors->first('tourist_program_id')}}</font><br>

							<div id="TouristProgramInfo"></div>

						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الباص</label>
						<div class="col-md-8">
							{{Form::select('bus_id' , $buses , $flight_reservation->bus_id , ["class"=>"form-control" , "data-live-search"=>"true" , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'من فضلك اختر باص'])}}
							<font color="red">{{$errors->first('bus_id')}}</font><br>

							<div id="BusInfo"></div>

						</div>
					</div>


					<div id="reserveSeat">
						<div class="form-group">
							<label class="control-label col-md-3">المقعد</label>
							<div class="col-md-8" style="margin-top: 6px">
								من فضلك اختر الباص اولا
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">ملاحظات</label>
						<div class="col-md-8">
							{{Form::textarea('notes' , $flight_reservation->notes , ["class"=>"form-control" , "autofocus"=>"autofocus" , "autocomplete" =>"on"])}}
							<font color="red">{{$errors->first('notes')}}</font><br>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">تنبيه</label>
						<div class="col-md-8">
							<button type="button" class="btn btn-default" style="">1</button> المقعد غير محجوز<br><br>
							<button type="button" title="" class="btn btn-default" style="background-color: rgb(50, 197, 210);">1</button> المقعد تم اختياره للحجز<br><br>
							<button type="button" class="btn btn-reverse disabled" style="">1</button> المقعد محجوز لعميل اخر <small>(عند الوقوف قليلا على المقعد ستظهر بيانات العميل الذى قام بحجز المقعد)</small><br><br>
							<button type="button" title="" class="btn btn-default" style="background-color: rgba(0, 128, 0, 0.68);">1</button> المقعد محجوز لهذا العميل ويمكن تعديله
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

	<script type="text/javascript" src="{{URL::to('/')}}/assets/editFlightReservationAjax.js"></script>

	@stop

	@stop