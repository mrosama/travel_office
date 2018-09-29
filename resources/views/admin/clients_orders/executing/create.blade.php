@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
@section('CssLinks')
<link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.dola td{
		text-align: center !important;
	}
	.dola td{
		width: 10%;
	}
	.table-activity td{
		width: 0;
	}
</style>
@stop

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/clients_orders">الطلبات</a>
		</li>
		<i class="fa fa-angle-left"></i>
		<li>تنفيذ طلب</li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="tabbable-line boxless tabbable-reversed">
			<ul class="nav nav-tabs getList">
				@if(in_array(1, json_decode($order->order_type)))
				<li class="active">
					<a href="#tab_0" data-toggle="tab"> طيران دولى </a>
				</li>
				@endif
				@if(in_array(2, json_decode($order->order_type)))
				<li>
					<a href="#tab_1" data-toggle="tab"> طيران داخلى </a>
				</li>
				@endif
				@if(in_array(3, json_decode($order->order_type)))
				<li>
					<a href="#tab_2" data-toggle="tab"> حجز فندق </a>
				</li>
				@endif
				@if(in_array(4, json_decode($order->order_type)))
				<li>
					<a href="#tab_3" data-toggle="tab"> حجز مواصلات من المطار الى الفندق </a>
				</li>
				@endif
				@if(in_array(5, json_decode($order->order_type)))
				<li>
					<a href="#tab_4" data-toggle="tab"> حجز مواصلات بين الدول </a>
				</li>
				@endif
				@if(in_array(6, json_decode($order->order_type)))
				<li>
					<a href="#tab_5" data-toggle="tab"> حجز مواصلات بين المدن </a>
				</li>
				@endif
				@if(in_array(7, json_decode($order->order_type)))
				<li>
					<a href="#tab_6" data-toggle="tab"> حجز رحلة سياحية </a>
				</li>
				@endif
				@if(in_array(8, json_decode($order->order_type)))
				<li>
					<a href="#tab_7" data-toggle="tab"> حجز فيزا (تأشيرة دخول) </a>
				</li>
				@endif
				@if(in_array(9, json_decode($order->order_type)))
				<li>
					<a href="#tab_8" data-toggle="tab"> حجز سيارة خاصة مع سائق </a>
				</li>
				@endif
				@if(in_array(10, json_decode($order->order_type)))
				<li>
					<a href="#tab_9" data-toggle="tab"> حجز سيارة خاصة بدون سائق </a>
				</li>
				@endif
				@if(in_array(11, json_decode($order->order_type)))
				<li>
					<a href="#tab_10" data-toggle="tab"> المباريات </a>
				</li>
				@endif
			</ul>

			<div class="tab-content">
				@if(in_array(1, json_decode($order->order_type)))
				@include('admin.clients_orders.executing.external_aviation')
				@endif
				@if(in_array(2, json_decode($order->order_type)))
				@include('admin.clients_orders.executing.internal_aviation')
				@endif
				@if(in_array(3, json_decode($order->order_type)))
				@include('admin.clients_orders.executing.hotel_reservation')
				@endif
				@if(in_array(4, json_decode($order->order_type)))
				@include('admin.clients_orders.executing.booking_transportation_port_hot')
				@endif
				@if(in_array(5, json_decode($order->order_type)))
				@include('admin.clients_orders.executing.booking_transportation_countries')
				@endif
				@if(in_array(6, json_decode($order->order_type)))
				@include('admin.clients_orders.executing.booking_transportation_cities')
				@endif
				@if(in_array(7, json_decode($order->order_type)))
				@include('admin.clients_orders.executing.booking_tourist_trip')
				@endif
				@if(in_array(8, json_decode($order->order_type)))
				@include('admin.clients_orders.executing.booking_visa')
				@endif
				@if(in_array(9, json_decode($order->order_type)))
				@include('admin.clients_orders.executing.booking_car_driver')
				@endif
				@if(in_array(10, json_decode($order->order_type)))
				@include('admin.clients_orders.executing.booking_car')
				@endif
				@if(in_array(11, json_decode($order->order_type)))
				@include('admin.clients_orders.executing.booking_sports')
				@endif

			</div>
		</div>
	</div>
</div>
@section('JsScripts')
<script src="{{URL::to('/')}}/assets/form-validation.js" type="text/javascript"></script>
<script type="text/javascript" src="{{URL::to('/assets/getCityAjax.js')}}"></script>

<script type="text/javascript">
	$('.screen').each(function(event) {
		$(this).click(function(event) {
			$(this).parent().parent().find('.showScreen').closest().children().remove();
			$(this).parent().parent().find('.showScreen').html('<div class="form-group"><label class="control-label col-md-3">ملف</label><div class="col-md-8">{{Form::file("file" , ["class"=>"form-control" , "autocomplete" =>"on" , "required"])}}<br></div></div><div class="form-group"><label class="control-label col-md-3">ملاحظات</label><div class="col-md-8">{{Form::textarea("notes" ,"", ["class"=>"form-control" , "autocomplete" =>"on" , "required"])}}<br></div></div><div><div class="form-group"><label class="control-label col-md-1">السعر</label><div class="col-md-2">{{Form::number('price' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}<font color="red">{{$errors->first('price')}}</font></div><label class="control-label col-md-1">الربح</label><div class="col-md-2">{{Form::number('profit' , '' , ['class'=>'form-control' , "autocomplete" =>"on" ])}}<font color="red">{{$errors->first('profit')}}</font></div><label class="control-label col-md-1">النسبة</label><div class="col-md-2">{{Form::text('percentage' , '' , ['class'=>'form-control' , "autocomplete" =>"on" ])}}<font color="red">{{$errors->first('percentage')}}</font></div><label class="control-label col-md-1">الاجمالى</label><div class="col-md-2">{{Form::number('total' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}<font color="red">{{$errors->first('total')}}</font></div></div></div><div class="form-actions text-center"><div class="row"><div class="col-md-offset-2 col-md-9"><button  class="btn green">حفظ</button><button type="reset" class="btn default">الغاء </button></div></div></div>');
		});
	});
	
	$('.code').each(function(event) {
		$(this).click(function(event) {
			$(this).parent().parent().find('.showScreen').children().remove();
		});
	});

	$('input[name="price"]').each(function(event) {
		$(this).keyup(function(event) {
			price  = $(this).val();
			profit = $(this).parent().parent().find('input[name="profit"]').val();
			percentage = $(this).parent().parent().find('input[name="percentage"]').val();
			total  = $(this).parent().parent().find('input[name="total"]');

			if(percentage == "" && profit != "")
				total.val(parseInt(profit) + parseInt(price));
			else if(percentage != "" && profit == "")
				total.val((parseInt(percentage)/100) * parseInt(price));

		});
	});

	$('input[name="profit"]').each(function(event) {
		$(this).keyup(function(event) {
			$(this).parent().parent().find('input[name="percentage"]').val("");

			profit  = $(this).val();
			price   = $(this).parent().parent().find('input[name="price"]').val();
			total   = $(this).parent().parent().find('input[name="total"]');
			total.val(parseInt(profit) + parseInt(price));
		});
	});

	$('input[name="percentage"]').each(function(event) {
		$(this).keyup(function(event) {
			percentage  = $(this).val();
			$(this).parent().parent().find('input[name="profit"]').val("");

			price       = $(this).parent().parent().find('input[name="price"]').val();
			total       = $(this).parent().parent().find('input[name="total"]');
			total.val((parseInt(percentage)/100) * parseInt(price));
		});
	});

</script>
@yield('hotelJs')
@yield('transferJs')
@yield('sportJs')
<script type="text/javascript">
	var i = 0;
	$.each($('.getList').children(), function(index, val) {
		if($(this).hasClass('active'))
			++i;
	});
	if(i == 0)
		$('.getList').children().first().children('a').trigger('click');
</script>
@stop

@stop