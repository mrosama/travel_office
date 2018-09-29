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
			<a href="{{URL::to('/')}}/admin/offices">المكاتب</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>
						عرض بيانات المكتب <font color="red" size="6">{{$office->name}}</font>
						
					</div>

					<table class="table dola">
						<tr>
							<td>اسم المكتب</td>
							<td>{{$office->name}}</td>
						</tr>

						<tr>
							<td>البريد الالكترونى</td>
							<td>{{$office->email}}</td>
						</tr>

						<tr>
							<td>الدوله</td>
							<td>{{$office->getCountry->name}}</td>
						</tr>

						<tr>
							<td>المدينه</td>
							<td>{{$office->getCity->name}}</td>
						</tr>

						<tr>
							<td>الشارع</td>
							<td>{{$office->street_name}}</td>
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
							{{Form::hidden('lat', $office->lat , ['id' => 'lat']) }}
							{{Form::hidden('lang', $office->lang , ['id' => 'lng']) }}
						</tr>
					</table>

				</div>
			</div>
		</div>

	</div>
</div>

@stop