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
					<span class="caption-subject font-green bold uppercase">  انشاء فاتورة جديدة</span>
				</div>
			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				{!!Form::open(['route' => ['admin.bill.update' , $bill->id ] , 'method'=>'put','class'=>'form-horizontal' , 'files' => 'true'])!!}

				<div class="form-body">
					@if(Session::has('success'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('success')}}
					</div>
					@endif

					<div class="form-group  margin-top-20">
						<label class="control-label col-md-3">اسم العميل
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::select('client_id', $all_client , $bill->getClientName->username ,array( "autofocus"=>"autofocus",'class'=>'form-control' , 'id' => "client_id", 'onchange' => 'getClientInfo()'))!!}
								{!! $errors->first('client_id','<div class="alert alert-danger">:message</div>')!!}
							</div>
							<div id="clientInfo"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">رقم سند القبض
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('receipt', $bill->receipt ,array('placeholder'=>'رقم سند القبض','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('receipt','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class= "control-label col-md-3"> صورة سند القبض
							<span class="required"> * </span>
						</label>
						<div class="col-md-4"> 
							<div class="input-icon right">
								<i class="fa"></i>
								{{Form::file('receipt_photo')}}
								{!! $errors->first('receipt_photo','<div class="alert alert-danger">:message</div>')!!}     
							</div>
						</div>	
						<div class="col-md-3">
							{{HTML::image($bill->receipt_photo , '',  ['width' => '100px'])}}
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">الدولة
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							{!!Form::select('country', $all_country , $bill->getCountryName->name ,array('class'=>' form-control bs-select' , 'data-live-search' => 'true'  ,'id' => 'country'))!!}
							{!! $errors->first('country','<div class="alert alert-danger">:message</div>')!!}                            
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">المدينة
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<select name="city" id="city" class="form-control bs-select" data-live-search="true">
								<option value="{{$bill->city}}">{{$bill->getCityName->name}}</option>
							</select>
							{!! $errors->first('city','<div class="alert alert-danger">:message</div>')!!}                            
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">نوع الطيران
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('flight_type', $bill->flight_type ,array('class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('flight_type','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">عدد المسافرون
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('traveles', $bill->traveles ,array('class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('traveles','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">تاريخ الذهاب
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control form-control-inline date-picker"  name="date_go" value="{{$bill->date_go}}" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" size="16" type="text">
								{!! $errors->first('date_go','<div class="alert alert-danger">:message</div>')!!}
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">تاريخ العودة
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control form-control-inline date-picker"  name="date_back" value="{{$bill->date_back}}" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" size="16" type="text">
								{!! $errors->first('date_back','<div class="alert alert-danger">:message</div>')!!}
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">عدد الايام
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('dayNumbers', $bill->dayNumbers ,array('class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('dayNumbers','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">عدد الليالي
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('dayNights', $bill->dayNights ,array('class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('dayNights','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>



					<div class="form-group">
						<label class="control-label col-md-3">بيانات التواصل
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('phone', $bill->phone ,array('class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('phone','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('mobile', $bill->mobile ,array('class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('mobile','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('email', $bill->email ,array('class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('email','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">اجمالي المبلغ المطلوب
							<span class="required"> * </span>
						</label>
						<div class="col-md-3">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('price_sa', $bill->price_sa ,array('class'=>'form-control', 'id' =>'price_sa'  ,  "autocomplete" =>"on" ))!!}
								{!! $errors->first('price_sa','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
						<div class="col-md-3">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('price_ba', $bill->price_ba ,array('class'=>'form-control', 'id' =>'price_ba' ,  "autocomplete" =>"on" ))!!}
								{!! $errors->first('price_ba','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
						<div class="col-md-3">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('price_us', $bill->price_us ,array('class'=>'form-control', 'id' => 'price_us' ,  "autocomplete" =>"on" ))!!}
								{!! $errors->first('price_us','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn green">حفظ</button>
							<button  class="btn default">{{link_to_route('admin.bill.index', 'عودة' )}} </button>

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
	function getClientInfo(){
		var client_id = $('#client_id').val();
		$.ajax({
			url:  $('#baseurl').val() + '/clients/getClientInfo',
			type: 'GET',
			data: {client_id : client_id},
		})
		.done(function(data) {
			if(data == 0)
				document.getElementById('clientInfo').innerHTML = '';
			else 
			{
				document.getElementById('clientInfo').innerHTML = '<div  class="well" style="display: block;">'
				+'اسم العميل :'+data.username
				+' <br> الجنسية : '+data.nationality
				+' <br> البريد الالكتروني : '+data.email_address
				+'<br> رقم الهاتف : '+data.phone+'</div>';
				console.log(data);
			}	
		})
		.fail(function() {
			console.log("error");
		})
	}


	$('#country').change(function(){
		var country_code = $('#country').val();
		var baseurl = document.getElementById('baseurl').value;
		$.ajax({
			url:  baseurl+'/city/getCity', 
			type: 'GET',
			data: {country_code},
			success : function(data){
				console.log(data);
				$('#city').empty();
				if(data == '')
				{
					var empty = "<option selected disabled>عفوا لا يوجد مدن لهذه الدولة!</option>";
					$('#city').html(empty);
				}
				else
				{
					$.each(data , function(i , val)
					{
						$('#city').append('<option value='+val.id+'>'+val.name+'</option>')
					});
				}
				$('#city').selectpicker('refresh');
			},
			error : function(e){
				console.log(e);
			}
		});
	});


	$('#price_sa').keyup(function()
	{
		var price_sa = $('#price_sa').val();
		var price_ba = Number(price_sa) * 10 ;
		var price_us = Number(price_sa) * 3.75 ;
		if(isNaN(price_ba))
		{
			document.getElementById('price_ba').value = '';
		}else {
			document.getElementById('price_ba').value = price_ba;
		}
		if(isNaN(price_us))
		{
			document.getElementById('price_us').value = '';
		}else {
			document.getElementById('price_us').value = price_us;
		}
	});

</script>
@stop


@stop