@extends ('admin.layouts.master')
@section('content')

<!-- END PAGE HEADER-->

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
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light portlet-fit portlet-form ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bubble font-green"></i>
					<span class="caption-subject font-green bold uppercase"> تعديل  موظف</span>
				</div>

			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				{{Form::open(['route'=>['admin.employee.update' , $employee->id] , 'method'=>'put' , 'class'=>'form-horizontal','files'=>true])}}
				<div class="form-body">
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
								{{Form::text('user_name' , $employee->user->user_name , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">كلمة المرور
							</label>
							<div class="col-md-7">
								<div class="input-group">
									<input type="text" class="form-control" name="password" value="{{$employee->user->shown_password}}" id="generatedPass"  >
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
								{{Form::select('office_id', $offices , $employee->office_id ,array('placeholder'=>'من فضلك اختر المكتب التابع له الموظف',
								'class'=>"bs-select form-control" , "data-live-search"=>"true" , 'required'))}}
								<font color="red">{{$errors->first('office_id')}}</font>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">اسم الموظف
							</label>
							<div class="col-md-7">
								{!!Form::text('name',$employee->name,array('placeholder'=>'اسم الموظف',
								'class'=>'form-control',"autocomplete" =>"on"   , "autofocus"=>"autofocus" , 'required'))!!}
								<font color="red">{{$errors->first('name')}}</font>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">البريد الالكترونى
							</label>
							<div class="col-md-7">
								{!!Form::email('email',$employee->email,array('placeholder'=>'البريد الالكترونى',
								'class'=>'form-control',"autocomplete" =>"on"   , "autofocus"=>"autofocus" , 'required' , 'email'))!!}
								<font color="red">{{$errors->first('email')}}</font>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">طبيعة العمل
							</label>
							<div class="col-md-7">
								{!!Form::text('work_type',$employee->work_type,array('placeholder'=>'طبيعة العمل',
								'class'=>'form-control',"autocomplete" =>"on"   , "autofocus"=>"autofocus" , 'required'))!!}
								<font color="red">{{$errors->first('work_type')}}</font>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">الجنسية
							</label>
							<div class="col-md-7">
								{!!Form::text('nationality',$employee->nationality,array('placeholder'=>'الجنسية',
								'class'=>'form-control',"autocomplete" =>"on"   , "autofocus"=>"autofocus" , 'required'))!!}
								<font color="red">{{$errors->first('nationality')}}</font>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">رقم الجوال 
							</label>
							<div class="col-md-7">
								{!!Form::text('mobile',$employee->mobile,array('placeholder'=>'054987987987 ',
								'class'=>'form-control',"autocomplete" =>"on" , 'required' , 'number'))!!}
								<font color="red">{{$errors->first('mobile')}}</font>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">الشارع
							</label>
							<div class="col-md-7">
								{!!Form::text('street',$employee->street,array('placeholder'=>'الشارع ',
								'class'=>'form-control',"autocomplete" =>"on" ))!!}
								<font color="red">{{$errors->first('street')}}</font>
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
								{{ Form::hidden('latitude',$employee->latitude ,['id' => 'lat']) }}
								{{ Form::hidden('longitude',$employee->longitude ,['id' => 'lng']) }}
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">الصورة شخصية</label>
							<div class="col-md-7">
								{{Form::file('profile_img' , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
								<p>
									@if($employee->profile_img != null)
									لرؤية الصورة المرفوع من قبل <a href="{{URL::to($employee->profile_img)}}"> اضغط هنا</a>
									@else
									لا يوجد ملف مرفوع من قبل
									@endif
								</p>
								<font color="red">{{$errors->first('profile_img')}}</font><br>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">الراتب   
							</label>
							<div class="col-md-7">
								{!!Form::text('salary',$employee->salary,array('placeholder'=>'4000 ',
								'class'=>'form-control',"autocomplete" =>"on" ))!!}
								<font color="red">{{$errors->first('salary')}}</font>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">الجنس
							</label>
							<div class="col-md-7">
								ذكر  {{Form::radio('gender', 'male' , ($employee->gender == "male")?true:false )}}
								انثى {{Form::radio('gender' , 'female' , ($employee->gender == "female")?true:false)}} 
								<font color="red">{{$errors->first('gender')}}</font>
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-md-3">تاريخ الميلاد
							</label>
							<div class="col-md-7">
								{!!Form::date('birth_date',$employee->birth_date,array('class'=>'form-control',"autocomplete" =>"on" ))!!}
								<font color="red">{{$errors->first('birth_date')}}</font>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">رقم السجل المدني / الاقامة
							</label>
							<div class="col-md-7">
								{!!Form::text('civil_registry_number',$employee->civil_registry_number,array('placeholder'=>'رقم السجل المدني / الاقامة','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								<font color="red">{{$errors->first('civil_registry_number')}}</font>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">تاريخ انتهاء السجل المدني / الاقامة
							</label>
							<div class="col-md-7">
								{!!Form::date('expireResidence',$employee->expireResidence,array('class'=>'form-control',"autocomplete" =>"on" ))!!}
								<font color="red">{{$errors->first('expireResidence')}}</font>
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-md-3">مصدر السجل المدني / الاقامة
							</label>
							<div class="col-md-7">
								{!!Form::text('sourceResidence',$employee->sourceResidence,array('placeholder'=>'مصدر السجل المدني / الاقامة','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								<font color="red">{{$errors->first('sourceResidence')}}</font>
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-md-3">الصورة شخصية</label>
							<div class="col-md-7">
								{{Form::file('civil_registry_image' , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
								<p>
									@if($employee->civil_registry_image != null)
									لرؤية الصورة المرفوع من قبل <a href="{{URL::to($employee->civil_registry_image)}}"> اضغط هنا</a>
									@else
									لا يوجد ملف مرفوع من قبل
									@endif
								</p>
								<font color="red">{{$errors->first('civil_registry_image')}}</font><br>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">رقم الجواز
							</label>
							<div class="col-md-7">
								{!!Form::text('passportNumber',$employee->passportNumber,array('placeholder'=>'رقم الجواز','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								<font color="red">{{$errors->first('passportNumber')}}</font>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">تاريخ اصدار الجواز
							</label>
							<div class="col-md-7">
								{!!Form::date('passport_issue_date',$employee->passport_issue_date,array('class'=>'form-control',"autocomplete" =>"on" ))!!}
								<font color="red">{{$errors->first('passport_issue_date')}}</font>
							</div>
						</div>	
						<div class="form-group">
							<label class="control-label col-md-3">تاريخ انتهاء الجواز
							</label>
							<div class="col-md-7">
								{!!Form::date('passport_finish_date',$employee->passport_finish_date,array('class'=>'form-control',"autocomplete" =>"on" ))!!}
								<font color="red">{{$errors->first('passport_finish_date')}}</font>
							</div>
						</div>	

						<div class="form-group">
							<label class="control-label col-md-3">مصدر الجواز
							</label>
							<div class="col-md-7">
								{!!Form::text('sourcePassport',$employee->sourcePassport,array('placeholder'=>'مصدر الجواز','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								<font color="red">{{$errors->first('sourcePassport')}}</font>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">صورة الجواز</label>
							<div class="col-md-7">
								{{Form::file('photoPassport' , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
								<p>
									@if($employee->photoPassport != null)
									لرؤية الصورة المرفوع من قبل <a href="{{URL::to($employee->photoPassport)}}"> اضغط هنا</a>
									@else
									لا يوجد ملف مرفوع من قبل
									@endif
								</p>
								<font color="red">{{$errors->first('photoPassport')}}</font><br>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3"> اسم البنك       
							</label>
							<div class="col-md-7">
								{!!Form::text('bank_name',$employee->bank_name,array('placeholder'=>'الراجحى ',
								'class'=>'form-control',"autocomplete" =>"on" ))!!}
								<font color="red">{{$errors->first('bank_name')}}</font>
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-md-3"> رقم الاى بان        
							</label>
							<div class="col-md-7">
								{!!Form::text('iban',$employee->iban,array('placeholder'=>'546456 ',
								'class'=>'form-control',"autocomplete" =>"on" ))!!}
								<font color="red">{{$errors->first('iban')}}</font>
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-md-3"> رقم  الحساب        
							</label>
							<div class="col-md-7">
								{!!Form::text('account_number',$employee->account_number,array('placeholder'=>'546456 ',
								'class'=>'form-control',"autocomplete" =>"on" ))!!}
								<font color="red">{{$errors->first('account_number')}}</font>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3"> عدد ايام الاجازه        
							</label>
							<div class="col-md-7">
								{!!Form::text('holidays_number',$employee->holidays_number,array(
								'class'=>'form-control',"autocomplete" =>"on" ))!!}
								<font color="red">{{$errors->first('holidays_number')}}</font>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">تاريخ الالتحاق        
							</label>
							<div class="col-md-7">
								{!!Form::date('hire_date',$employee->hire_date,array(
								'class'=>'form-control',"autocomplete" =>"on" ))!!}
								<font color="red">{{$errors->first('hire_date')}}</font>
							</div>
						</div>

						<fieldset>
							<legend>فترة الدوام</legend>

							<div class="form-group">
								<label class="control-label col-md-3">الايام
								</label>
								<div class="col-md-3">
									{!!Form::text('days',$employee->days,array('placeholder'=>'الايام','class'=>'form-control',  "autocomplete" =>"on" ))!!}
									<font color="red">{{$errors->first('days')}}</font>
								</div>

								<label class="control-label col-md-3">الساعات
								</label>
								<div class="col-md-1">
									{!!Form::text('hours_from',$employee->hours_from,array('placeholder'=>'من','class'=>'form-control',  "autocomplete" =>"on" ))!!}
									<font color="red">{{$errors->first('hours_from')}}</font>
								</div>
								<div class="col-md-1">
									{!!Form::text('hours_to',$employee->hours_to,array('placeholder'=>'الى','class'=>'form-control',  "autocomplete" =>"on" ))!!}
									<font color="red">{{$errors->first('hours_to')}}</font>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3">سعر الساعة للاوفر تايم 
								</label>
								<div class="col-md-3">
									{!!Form::text('over_time_price',$employee->over_time_price,array('placeholder'=>'سعر الساعة للاوفر تايم','class'=>'form-control',  "autocomplete" =>"on" ))!!}
									<font color="red">{{$errors->first('over_time_price')}}</font>
								</div>

								<label class="control-label col-md-3">عدد الساعات الاضافية
								</label>
								<div class="col-md-3">
									{!!Form::text('extra_hours_numbers',$employee->extra_hours_numbers,array('placeholder'=>'عدد الساعات الاضافية','class'=>'form-control',  "autocomplete" =>"on" ))!!}
									<font color="red">{{$errors->first('extra_hours_numbers')}}</font>
								</div>
							</div>
						</fieldset>
						<hr><br><br>
						<div class="form-group">
							<label class="control-label col-md-3">ملاحظات
							</label>
							<div class="col-md-7">
								{!!Form::textarea('notes',$employee->notes,array('placeholder'=>'ملاحظات','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								<font color="red">{{$errors->first('notes')}}</font>
							</div>
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