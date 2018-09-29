@extends('admin.layouts.master')
@section('content')

@section('CssLinks')
<link href="{{URL::to('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />

<style type="text/css">
	.dola td{
		text-align: center !important;
	}
	td{
		width: 50%;
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
		<?php $j=1; ?>
		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>
						عرض بيانات الطلب 
					</h2>
					
				</div>

				<table class="table dola">

					<tr>
						<td>البرنامج السياحى</td>
						<td>
							@if($flight_reservation->touristProgram != null)
							<a target="_blank" href="{{URL::to('/admin/tourist/programmes' , $flight_reservation->touristProgram->id)}}">{{$flight_reservation->touristProgram->name}}</a>
							@else
							<font color="red"><del>تم حذف البرنامج السياحى</del></font>
							@endif
						</td>
					</tr>

					<tr>
						<td>العميل</td>
						<td>
							@if($flight_reservation->client != null)
							<a target="_blank" href="{{URL::to('/admin/clients' , $flight_reservation->client->id)}}">{{$flight_reservation->client->username}}</a>
							@else
							<font color="red"><del>تم حذف العميل</del></font>
							@endif
						</td>
					</tr>

					<tr>
						<td>الباص</td>
						<td>
							@if($flight_reservation->bus != null)
							<a target="_blank" href="{{URL::to('/admin/busses' , $flight_reservation->bus->id)}}">{{$flight_reservation->bus->number}}</a>
							@else
							<font color="red"><del>تم حذف الباص</del></font>
							@endif
						</td>
					</tr>

					<tr>
						<td>المقاعد المحجوزة</td>
						<td>@foreach(json_decode($flight_reservation->resrved_seats) as $seat)
							{{$seat->seat_no}}
							@if($j < sizeof(json_decode($flight_reservation->resrved_seats)))
							<?php ++$j ?>
							|
							@else
							<?php $j=1 ?>
							@endif
							@endforeach</td>
						</tr>
						<tr>
							<td>ملاحظات</td>
							<td>{{$flight_reservation->notes}}</td>
						</tr>
						
					</table>
				</div>
			</div>

		</div>
	</div>

	@section('JsScripts')
	<script src="{{URL::to('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$("a#single_image").fancybox();
		});
	</script>
	@stop

	@stop