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
			<a href="{{URL::to('/')}}/admin/employee">الموظفين</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>
						عرض بيانات الموظف <font color="red" size="6">{{$employee->name}}</font>
						
					</div>

					<table class="table dola">
						<tr>
							<td>اسم المكتب</td>
							<td>{{$employee->office->name}}</td>
						</tr>

						<tr>
							<td>الصورة شخصية</td>
							<td>
								<a href="{{URL::to($employee->profile_img)}}" id="single_image"><img src="{{URL::to($employee->profile_img)}}" width="100" height="100" class="img-circle"></a>
							</td>
						</tr>

						<tr>
							<td>اسم الموظف</td>
							<td>{{$employee->name}}</td>
						</tr>

						<tr>
							<td>البريد الالكترونى</td>
							<td>{{$employee->email}}</td>
						</tr>

						<tr>
							<td>طبيعة العمل</td>
							<td>{{$employee->work_type}}</td>
						</tr>

						<tr>
							<td>الجنسية</td>
							<td>{{$employee->nationality}}</td>
						</tr>

						<tr>
							<td>رقم الجوال </td>
							<td>{{$employee->mobile}}</td>
						</tr>

						<tr>
							<td>الشارع</td>
							<td>{{$employee->street}}</td>
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
							{{Form::hidden('lat', $employee->latitude , ['id' => 'lat']) }}
							{{Form::hidden('lang', $employee->longitude , ['id' => 'lng']) }}
						</tr>

						<tr>
							<td>الراتب</td>
							<td>{{$employee->salary}}</td>
						</tr>

						<tr>
							<td>الجنس</td>
							<td>
								@if($employee->gender == "male")ذكر 
								@else
								انثى
								@endif
							</td>
						</tr>

						<tr>
							<td>تاريخ الميلاد</td>
							<td>{{$employee->birth_date}}</td>
						</tr>

						<tr>
							<td>رقم السجل المدني / الاقامة</td>
							<td>{{$employee->civil_registry_number}}</td>
						</tr>

						<tr>
							<td>تاريخ انتهاء السجل المدني / الاقامة</td>
							<td>{{$employee->expireResidence}}</td>
						</tr>

						<tr>
							<td>مصدر السجل المدني / الاقامة</td>
							<td>{{$employee->sourceResidence}}</td>
						</tr>

						<tr>
							<td>صورة السجل المدني / الاقامة</td>
							<td>
								<a href="{{URL::to($employee->civil_registry_image)}}" id="single_image"><img src="{{URL::to($employee->civil_registry_image)}}" width="100" height="100" class="img-circle"></a>
							</td>
						</tr>

						<tr>
							<td>رقم الجواز</td>
							<td>{{$employee->passportNumber}}</td>
						</tr>

						<tr>
							<td>تاريخ اصدار الجواز</td>
							<td>{{$employee->passport_issue_date}}</td>
						</tr>

						<tr>
							<td>تاريخ انتهاء الجواز</td>
							<td>{{$employee->passport_finish_date}}</td>
						</tr>

						<tr>
							<td>مصدر الجواز</td>
							<td>{{$employee->sourcePassport}}</td>
						</tr>

						<tr>
							<td>ملاحظات</td>
							<td>{{$employee->notes}}</td>
						</tr>

						<tr>
							<td>صورة الجواز</td>
							<td>
								<a href="{{URL::to($employee->photoPassport)}}" id="single_image"><img src="{{URL::to($employee->photoPassport)}}" width="100" height="100" class="img-circle"></a>
							</td>
						</tr>

						<tr>
							<td> اسم البنك</td>
							<td>{{$employee->bank_name}}</td>
						</tr>

						<tr>
							<td>رقم الاى بان</td>
							<td>{{$employee->iban}}</td>
						</tr>

						<tr>
							<td>رقم  الحساب</td>
							<td>{{$employee->account_number}}</td>
						</tr>

						<tr>
							<td>عدد ايام الاجازه</td>
							<td>{{$employee->holidays_number}}</td>
						</tr>

						<tr>
							<td>تاريخ الالتحاق</td>
							<td>{{$employee->hire_date}}</td>
						</tr>

						<tr>
							<td>ملاحظات</td>
							<td>{{$employee->notes}}</td>
						</tr>

					</table>
					<div class="text-center">
						<h2>فترة الدوام</h2>
					</div>

					<table class="table dola">
						<tr>
							<td>الايام</td>
							<td>{{$employee->days}}</td>
						</tr>

						<tr>
							<td>الساعات</td>
							<td>
								من:  {{$employee->hours_from}}
								-- الى: {{$employee->hours_to}}
							</td>
						</tr>

						<tr>
							<td>سعر الساعة للاوفر تايم </td>
							<td>{{$employee->over_time_price}}</td>
						</tr>

						<tr>
							<td>عدد الساعات الاضافية</td>
							<td>{{$employee->extra_hours_numbers}}</td>
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