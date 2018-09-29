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
			<a href="{{URL::to('/')}}/admin/busses">الباصات</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>
						عرض بيانات الباص <font color="red" size="6">{{$bus->number}}</font>
						
					</div>

					<table class="table dola">
						<tr>
							<td>صورة الباص</td>
							<td><a href="{{URL::to($bus->photo)}}" id="single_image"><img src="{{URL::to($bus->photo)}}" width="100" height="100" class="img-circle"></a></td>
						</tr>

						<tr>
							<td>مزود الباص</td>
							<td><a target="_blank" href="{{URL::to("/admin/busses/suppliers" , $bus->supplier->id)}}">{{$bus->supplier->name}}</a></td>
						</tr>

						<tr>
							<td>رقم الباص</td>
							<td>{{$bus->number}}</td>
						</tr>

						<tr>
							<td>موديل الباص</td>
							<td>{{$bus->model}}</td>
						</tr>

						<tr>
							<td>لون الباص</td>
							<td>{{$bus->color}}</td>
						</tr>

						<tr>
							<td>حجم الباص</td>
							<td>{{$bus->size}}</td>
						</tr>
						<tr>
							<td>رقم الرخصة</td>
							<td>{{$bus->license_number}}</td>
						</tr>
						<tr>
							<td>رقم كارت التشغيل</td>
							<td>{{$bus->run_card_number}}</td>
						</tr>
						<tr>
							<td>تصريح الحج</td>
							<td>{{$bus->hajj_permit}}</td>
						</tr>
						<tr>
							<td>رقم التصريح</td>
							<td>{{$bus->permit_number}}</td>
						</tr>
						<tr>
							<td>مدة التصريح</td>
							<td>{{$bus->permit_duration}}</td>
						</tr>
						<tr>
							<td>تاريخ التصريح</td>
							<td>{{$bus->permit_date}}</td>
						</tr>
						<tr>
							<td>تاريخ انتهاء التصريح</td>
							<td>{{$bus->permit_end_date}}</td>
						</tr>
						<tr>
							<td>ملاحظات</td>
							<td>{{$bus->notes}}</td>
						</tr>
						
						<tr>
							<td>الاحداثيات</td>
							<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABaErEWtegygkQxPJh_t0oMIxHjbfPJw4"></script>
							<script type="text/javascript">
								var marker;
								var lat;
								var lng;
								var map;

								function updateMarkerPosition(latLng) {
									document.getElementById('lat').value = latLng.lat();
									document.getElementById('lng').value = latLng.lng();
								}

								function placeMarker(location) {
									if (marker) {
										marker.setPosition(location);
									} else {
										marker = new google.maps.Marker({
											position: location,
											map: map
										});
									}
								}

								function initialize() {
									var lat = document.getElementById('lat').value;
									var lng = document.getElementById('lng').value;
									if(lat == "" && lng == "")
										var latLng = new google.maps.LatLng("20.5904603", "44.9751636");
									else
										var latLng = new google.maps.LatLng(lat , lng);

									map = new google.maps.Map(document.getElementById('mapCanvas'), {
										zoom: 5,
										center: latLng,
										mapTypeId: google.maps.MapTypeId.ROADMAP
									});

									var marker = new google.maps.Marker({
										position: latLng,
										title: "مكانك هنا!"
									});
									marker.setMap(map);

									updateMarkerPosition(latLng);

								}

								google.maps.event.addDomListener(window, 'load', initialize);
							</script>

							<td id="mapCanvas" style="width:100%; height:300px;"></td>
							{{Form::hidden('latitude', $bus->latitude , ['id' => 'lat']) }}
							{{Form::hidden('longitude', $bus->longitude , ['id' => 'lng']) }}
						</tr>
					</table>

				</div>
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