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
					<span class="caption-subject font-green bold uppercase">  تعديل  مكتب</span>
				</div>

			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				{{Form::open(['route'=>['admin.offices.update' , $office->id] , 'method'=>'put' , 'class'=>'form-horizontal'])}}	
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
							{{Form::text('user_name' , $office->user->user_name , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">كلمة المرور
						</label>
						<div class="col-md-7">
							<div class="input-group">
								<input type="text" class="form-control" name="password" value="{{$office->user->shown_password}}" id="generatedPass"  >
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
							{!!Form::text('name',$office->name,array('placeholder'=>'اسم المكتب',
							'class'=>'form-control',"autocomplete" =>"on"   , "autofocus"=>"autofocus"))!!}
							<font color="red">{!! $errors->first('name')!!}</font>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">الدولة</label>
						<div class="col-md-7">
							{{Form::select('country' , $countries , $office->country  , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار الدولة' , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'required'])}}
							<font color="red">{{$errors->first('country')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">المدينة</label>
						<div class="col-md-7">
							{{Form::select('city' , $cities , $office->city , ['class'=>'bs-select form-control' , "autocomplete" =>"on" , "data-live-search"=>"true" , 'required'])}}
							<font color="red">{{$errors->first('city')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">اسم الشارع  
						</label>
						<div class="col-md-7">
							{!!Form::text('street_name',$office->street_name,array('placeholder'=>'اسم الشارع ',
							'class'=>'form-control',"autocomplete" =>"on" ))!!}
							<font color="red">{!! $errors->first('street_name')!!}</font>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">البريد الالكترونى  
						</label>
						<div class="col-md-7">
							{!!Form::text('email',$office->email,array('placeholder'=>'info@employee.com ',
							'class'=>'form-control',"autocomplete" =>"on" ))!!}
							<font color="red">{!! $errors->first('email')!!}</font>
						</div>
					</div>


					<div class="form-group" style="min-height: 25px;">
						{{ Form::label('map','الاحداثيات',array('class'=>'control-label col-md-3')) }}
						<div class="col-md-7">
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
							{{ Form::hidden('lat',$office->lat ,['id' => 'lat']) }}
							{{ Form::hidden('lang',$office->lang ,['id' => 'lng']) }}
						</div>
					</div>

					<div class="clearfix"></div>

				</div>
				<div class="form-actions text-center">
					<div class="row">
						<div class="col-md-offset-2 col-md-9">
							<button type="submit" class="btn green">تعديل</button>
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


<script type="text/javascript">
	$('#generatePass').click(function(event) {
		$('#generatedPass').val(Math.random().toString(36).slice(-10));
	});
</script>
@stop

@stop