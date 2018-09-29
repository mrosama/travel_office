@extends ('admin.layouts.master')
@section('content')

<!-- END PAGE HEADER-->

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
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light portlet-fit portlet-form ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bubble font-green"></i>
					<span class="caption-subject font-green bold uppercase">  اضافه  مكتب جديد</span>
				</div>

			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				{!!Form::open(array('url' => 'admin/offices','method'=>'post','class'=>'form-horizontal'))!!}
				<div class="form-body">

					@if(Session::has('success'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('success')}}
					</div>
					@endif

					<div class="form-group">
						<label class="control-label col-md-3">اسم المستخدم
						</label>
						<div class="col-md-7">
							{{Form::text('user_name' , '' , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" , 'required'])}}
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">كلمة المرور
						</label>
						<div class="col-md-7">
							<div class="input-group">
								<input type="text" class="form-control" name="password" id="generatedPass" required="">
								<span class="input-group-btn">
									<button class="btn btn-inverse btn-md" type="button" id="generatePass" style="padding: 8px 15px;">توليد</button>
								</span>
							</div>
							<font color="red">{{$errors->first('password')}}</font>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<label class="control-label col-md-3">اسم المكتب
						</label>
						<div class="col-md-7">
							{!!Form::text('name','',array('placeholder'=>'اسم المكتب',
							'class'=>'form-control',"autocomplete" =>"on"   , "autofocus"=>"autofocus"))!!}
							<font color="red">{!! $errors->first('name')!!}</font>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">الدولة</label>
						<div class="col-md-7">
							{{Form::select('country' , $countries , '' , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار الدولة' , "class"=>"bs-select form-control" , "data-live-search"=>"true"])}}
							<font color="red">{{$errors->first('country')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">المدينة</label>
						<div class="col-md-7">
							{{Form::select('city' , [''=>'من فضلك قم باختيار الدولة اولا'] , '' , ['class'=>'form-control' , "autocomplete" =>"on" , "data-live-search"=>"true"])}}
							<font color="red">{{$errors->first('city')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">اسم الشارع  
						</label>
						<div class="col-md-7">
							{!!Form::text('street_name','',array('placeholder'=>'اسم الشارع ',
							'class'=>'form-control',"autocomplete" =>"on" ))!!}
							<font color="red">{!! $errors->first('street_name')!!}</font>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">البريد الالكترونى  
						</label>
						<div class="col-md-7">
							{!!Form::text('email','',array('placeholder'=>'info@employee.com ',
							'class'=>'form-control',"autocomplete" =>"on" ))!!}
							<font color="red">{!! $errors->first('email')!!}</font>
						</div>
					</div>


					<div class="form-group" style="min-height: 25px;">
						{{ Form::label('map',' موقع المكتب :',array('class'=>'control-label col-md-3')) }}
						<div class="col-md-7">
							<input type="hidden" id="val1" value="20.5904603">
							<input type="hidden" id="val2" value="44.9751636">
							<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=ar"></script>
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
									if (!lat && !lng) {
										var v1 = document.getElementById('val1').value;
										var v2 = document.getElementById('val2').value;
										var latLng = new google.maps.LatLng(v1, v2);
									}
									else {
										var latLng = new google.maps.LatLng(lat, lng);
									}

									map = new google.maps.Map(document.getElementById('mapCanvas'), {
										zoom: 5,
										center: latLng,
										mapTypeId: google.maps.MapTypeId.ROADMAP
									});

									var marker = new google.maps.Marker({
										position: new google.maps.LatLng(v1, v2),
										title: "Hello World!"
									});
									marker.setMap(map);

									updateMarkerPosition(latLng);

									google.maps.event.addListener(map, 'click', function(event) {
										marker.setMap(null);
										placeMarker(event.latLng);
										updateMarkerPosition(event.latLng);
									});


								}

								google.maps.event.addDomListener(window, 'load', initialize);
							</script>

							<div id="mapCanvas" style="width:100%; height:300px;"></div>
							{{ Form::hidden('lat','' ,['id' => 'lat']) }}
							{{ Form::hidden('lang','' ,['id' => 'lng']) }}
						</div>

						<div class="clearfix"></div>


					</div>

					<div class="form-actions">
						<div class="row">
							<div class="text-center">
								<button type="submit" class="btn green">حفظ</button>
								<button type="reset" class="btn default">الغاء </button>
							</div>
						</div>
					</div>

				</form>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END VALIDATION STATES-->
	</div>
</div>
@section('JsScripts')
<script type="text/javascript" src="{{URL::to('/assets/getCityAjax.js')}}"></script>
<script type="text/javascript">
	$('#generatedPass').val(Math.random().toString(36).slice(-10));
	$('#generatePass').click(function(event) {
		$('#generatedPass').val(Math.random().toString(36).slice(-10));
	});
</script>
@stop

@stop