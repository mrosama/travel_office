@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light portlet-fit portlet-form ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bubble font-green"></i>
					<span class="caption-subject font-green bold uppercase">  اضافه طلب للمكتب السياحي / الديني</span>
				</div>

			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				{!!Form::open(array('url' => 'admin/travel_orders','method'=>'post','class'=>'form-horizontal'))!!}
				<div class="form-body">
					@if(Session::has('success'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('success')}}
					</div>
					@endif


					<div class="form-group">
						<label class="control-label col-md-3">اسم المكتب
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::select('travel_officeId', $all_office , '',array('placeholder'=>'اسم المكتب','class'=>'form-control bs-select','data-live-search' => 'true' ,  "autofoucs" => "autofoucs" , 'id' => 'travel_officeId' , 'onchange' =>'getSection()' ))!!}
								{!! $errors->first('travel_officeId','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">اسم القسم
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<select name="sectionId" id="sectionId" onchange="getEmpName()" class="form-control bs-select" data-live-search='true' >
								<option selected="" disabled="">اختر المؤسسة / الشركة اولا ...</option>
							</select>
							{!! $errors->first('sectionId','<div class="alert alert-danger">:message</div>')!!}                            
						</div>
					</div>



					<div class="form-group">
						<label class="col-md-3 control-label">اسم الموظف
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<select id="empId" name="empId[]" multiple="" class="form-control bs-select" data-live-search="true">
								<option selected="" disabled="">اختر قسم المؤسسة / الشركة اولا ...</option>
							</select>
							{!! $errors->first('empId','<div class="alert alert-danger">:message</div>')!!}   
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">
							نوع الطلب
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							{{Form::select('order_type' , $orders_types , '' , array('placeholder' =>  'نوع الطلب' , 'class' => 'form-control bs-select' , 'data-live-search' => 'true'))}}
							{!! $errors->first('order_type' , '<div class="alert alert-danger">:message</div>')!!}
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">تاريخ الذهاب
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<input class="form-control form-control-inline date-picker"  name="date_takeoff" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" size="16" type="text">
							{!! $errors->first('date_takeoff','<div class="alert alert-danger">:message</div>')!!}                            

						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">تاريخ العودة
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							
							<input class="form-control form-control-inline date-picker"  name="date_arrival" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" size="16" type="text">
							{!! $errors->first('date_arrival','<div class="alert alert-danger">:message</div>')!!}                            

						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">عدد الايام
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('dayNumbers','',array('placeholder'=>'عدد الايام','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('dayNumbers','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">دولة الاقلاع
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							{!!Form::select('country_takeoff', $countries , '',array('placeholder'=>'دولة الاقلاع ....','class'=>'bs-select form-control', 'data-live-search' => 'true' ,  'id' => 'country_takeoff' , 'onchange' =>'getCityTakeOff()'))!!}
							{!! $errors->first('country_takeoff','<div class="alert alert-danger">:message</div>')!!}                            
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">مدينة الاقلاع
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">

							<select name="city_takeoff" id="city_takeoff" class="form-control bs-select" data-live-search="true">
								<option selected="" disabled="">اختر دولة الاقلاع اولا ...</option>
							</select>
							{!! $errors->first('city_takeoff','<div class="alert alert-danger">:message</div>')!!}                            
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">دولة الوصول
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							{!!Form::select('country_arrival', $countries , '',array('placeholder'=>'دولة الوصول ....','class'=>'bs-select form-control', 'data-live-search'=> 'true' , 'id' => 'country_arrival' , 'onchange' =>'getCityArrival()'))!!}
							{!! $errors->first('country_arrival','<div class="alert alert-danger">:message</div>')!!}    
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">مدينة الوصول
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">

							<select name="city_arrival" id="city_arrival" class="form-control bs-select" data-live-search = 'true'>
								<option selected="" disabled="">اختر دولة الوصول اولا ...</option>
							</select>
							{!! $errors->first('city_arrival','<div class="alert alert-danger">:message</div>')!!}                            
						</div>
					</div>
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
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
<script type="text/javascript">
	function getSection()
	{
		var travel_officeId =  $('#travel_officeId').val();
		var baseurl = document.getElementById('baseurl').value;
		$.ajax({
			url:  baseurl+'/Travel_employees/getTravelSection', 
			type: 'GET',
			data: {travel_officeId},
			success : function(data){
				console.log(data);
				$('#sectionId').empty();
				if(data == '')
				{
					var empty = "<option selected disabled>عفوا لا يوجد اقسام داخل هذا المكتب !</option>";
					$('#sectionId').html(empty);
				}
				else
				{
					$('#sectionId').html('<option value="0">جميع الاقسام</option>');
					$.each(data , function(i , val)
					{
						$('#sectionId').append('<option value='+val.id+'>'+val.sectionName+'</option>')
					});
				}
				$('#sectionId').selectpicker('refresh');
			},
			error : function(e){
				console.log(e);
			}
		});




		// get All employees in this section
		$.ajax({
			url  : baseurl + '/Travel_employees/getEmployeesBySectionId',
			type : 'GET',
			data : {travel_officeId},
			success : function(data){
				console.log(data);	

				if(data != '')
				{
					$('#empId').empty();
					$('#empId').append('<option disabled vlaue="">اختر اسماء الموظفين</oprion>');
					$.each(data , function(i , val)
					{
						$('#empId').append('<option value='+val.id+'>'+val.empName+'</option>')
					});
				}
				else
				{
					$('#empId').empty();
					$('#empId').html('<option vlaue="">عفوا لا يوجد موظفين لهذه الشركة حاليا !</oprion>');
				}
				$('#empId').selectpicker('refresh');
			}  
		});
		
	}


	function getEmpName()
	{
		var travel_officeId =  $('#travel_officeId').val();
		var sectionId =  $('#sectionId').val();
		var baseurl = document.getElementById('baseurl').value;

		if(sectionId == 0)
		{
					// get All employees in this section
					$.ajax({
						url  : baseurl + '/Travel_employees/getEmployeesBySectionId',
						type : 'GET',
						data : {travel_officeId},
						success : function(data){
							console.log(data);	
							if(data != '')
							{
								$('#empId').empty();
								$('#empId').append('<option disabled vlaue="">اختر اسماء الموظفين</oprion>');
								$.each(data , function(i , val)
								{
									$('#empId').append('<option value='+val.id+'>'+val.empName+'</option>')
								});
							}
							else
							{
								$('#empId').empty();
								$('#empId').html('<option vlaue="">عفوا لا يوجد موظفين لهذه الشركة حاليا !</oprion>');
							}
							$('#empId').selectpicker('refresh');
						}  
					});
				}

				else 
				{
					$.ajax({
						url:  baseurl+'/travel_orders/getEmpName', 
						type: 'GET',
						data: {travel_officeId : travel_officeId , sectionId , sectionId},
						success : function(data){
							console.log(data);
							$('#empId').empty();
							if(data == '')
							{
								var empty = "<option selected disabled>عفوا لا يوجد موظفين داخل هذا القسم!</option>";
								$('#empId').html(empty);
							}
							else
							{
								$('#empId').append('<option disabled vlaue="">اختر اسماء الموظفين</oprion>');
								$.each(data , function(i , val)
								{
									$('#empId').append('<option value='+val.id+'>'+val.empName+'</option>')
								});
							}
							$('#empId').selectpicker('refresh');
						},
						error : function(e){
							console.log(e);
						}
					});		
				}		
			}

			function getCityTakeOff()
			{
				var country =  $('#country_takeoff').val();
				var baseurl = document.getElementById('baseurl').value;
				$.ajax({
					url:  baseurl+'/city/getCity', 
					type: 'GET',
					data: {country},
					success : function(data){
						console.log(data);
						$('#city_takeoff').empty();
						if(data == '')
						{
							var empty = "<option selected disabled>عفوا لا يوجد مدن لهذه الدولة!</option>";
							$('#city_takeoff').html(empty);
						}
						else
						{
							$('#city_takeoff').html('<option value="" disabled>اختر مدينة الاقلاع</option>');
							$.each(data , function(i , val)
							{
								$('#city_takeoff').append('<option value='+val.id+'>'+val.name+'</option>')
							});
						}
						$('#city_takeoff').selectpicker('refresh');
					},
					error : function(e){
						console.log(e);
					}
				});

			}


			function getCityArrival()
			{
				var country =  $('#country_arrival').val();
				var baseurl = document.getElementById('baseurl').value;
				$.ajax({
					url:  baseurl+'/city/getCity', 
					type: 'GET',
					data: {country},
					success : function(data){
						console.log(data);
						$('#city_arrival').empty();
						if(data == '')
						{
							var empty = "<option selected disabled>عفوا لا يوجد مدن لهذه الدولة!</option>";
							$('#city_arrival').html(empty);
						}
						else
						{
							$('#city_arrival').html('<option value="" disabled>اختر مدينة الوصو</option>');
							$.each(data , function(i , val)
							{
								$('#city_arrival').append('<option value='+val.id+'>'+val.name+'</option>')
							});
						}
						$('#city_arrival').selectpicker('refresh');
					},
					error : function(e){
						console.log(e);
					}
				});
			}



		</script>
		@stop

		@stop