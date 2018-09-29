@extends ('admin.layouts.master')
@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> طلبات العملاء
	<small>اضافة طلب جديد</small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="index.html">الرئيسية</a>
			<i class="fa fa-angle-left"></i>
		</li>
		<li>
			<span>طلبات العملاء</span>
			<i class="fa fa-angle-left"></i>
		</li>
		<li>
			<espan>اضافة طلب جديد</span>
			</li>
		</ul>

	</div>
	<!-- END PAGE HEADER-->


	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN VALIDATION STATES-->
			<div class="portlet light portlet-fit portlet-form ">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-bubble font-green"></i>
						<span class="caption-subject font-green bold uppercase">  اضافه طلب جديد</span>
					</div>

				</div>
				<div class="portlet-body">
					<!-- BEGIN FORM-->
					{!!Form::open(array('url' => 'admin/clients_orders','method'=>'post','class'=>'form-horizontal'))!!}
					<div class="form-body">
						@if(Session::has('success'))
						<div class="alert alert-success" style="text-align : right;">
							<strong>شكرا لك ! </strong> {{Session::get('success')}}
						</div>
						{!! link_to_route('admin.clients_orders.index', 'لتنفيذ الطلب اضغط هنا' , [Session::get('order_id')]) !!}
						@endif

						<div class="form-group">
							<label class="control-label col-md-3">اسم العميل
								<span class="required"> * </span>
							</label>
							<div class="col-md-9">
								<div class="input-icon right">
									<i class="fa"></i>
									{{Form::select('client_id' , $all_clients , '' , ['class' => 'bs-select form-control' , 'data-live-search' =>'true' , "autofocus"=>"autofocus",  'required' , 'placeholder' => 'اختر العميل' , 'id' => 'client_id', 'onchange' => 'getClientInfo()'])}}
									{!! $errors->first('client_id','<div class="alert alert-danger">:message</div>')!!}                            
								</div>
								<div id="clientInfo"></div>
							</div>
						</div>


						<div  id="clientWife">
						</div>

						<div  id="clientChild">
						</div>

<!-- 
						<div  id="client_family">
						</div> -->



						<div class="form-group">
							<label class="control-label col-md-3">نوع الطلب
								<span class="required"> * </span>
							</label>
							<div class="col-md-9">
								<div class="input-icon right">
									<i class="fa"></i>
									{!!Form::select('order_type[]', $orders_type , '' , array( 'required' , 'class'=>'form-control bs-select' , 'multiple'  ))!!}
									{!! $errors->first('order_type','<div class="alert alert-danger">:message</div>')!!}                            
								</div>
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-md-3">الدول المطلوبة 
								<span class="required"> * </span>
								<br><br>
								<button type="button" id="addNewCountry" class="btn btn-danger btn-xs" style="margin-bottom:10px">اضف المزيد من الدول</button>
							</label>
						</div>
						<div class="form-group">
							<div class="col-md-3 sss">
								الدولة من {{Form::select('country_from[]' , $all_countries , '' , ['class'=>' form-control country_from' ,  'required' , 'placeholder' => 'اختر الدولة ..'   ])}}
							</div>
							<div class="col-md-3">
								المدينة من 
								<select  name="city_from[]"  required  class="form-control " >
									<option disabled="" id="city_from_msg" selected="" value=""> اختر الدولة اولا ...</option>
								</select> 
							</div>

							<div class="col-md-3 sss">
								الدولة الى {{Form::select('country_to[]' , $all_countries , '' , ['class'=>' form-control country_to' ,  'required' , 'placeholder' => 'اختر الدولة ..'   ])}}
							</div>

							<div class="col-md-3">
								المدينة الى
								<select  name="city_to[]" required  class="form-control city_to"  >
									<option disabled="" id="city_to_msg" selected="" value=""> اختر الدولة اولا ...</option>
								</select>
							</div>
						</div>

						<div id="newCountry"></div>
					</div>



					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button type="submit" class="btn green">حفظ</button>
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

	$(document).on('change' ,'.country_from'  , function(){
		var country = $(this).closest("div").find(".country_from").val();
		var index_country = $('.country_from').index(this);
		var baseurl = document.getElementById('baseurl').value;
		$.ajax({
			url:  baseurl+'/city/getCity', 
			type: 'GET',
			data: {country},
			success : function(data){
				if(data == '')
				{
					var empty = "<option selected disabled>عفوا لا يوجد مدن لهذه الدولة!</option>";
					$('select[name="city_from[]"]').eq(index_country).html(empty);
				}
				else
				{
					$('select[name="city_from[]"]').eq(index_country).empty();
					$.each(data, function(i, val)
					{
						$('select[name="city_from[]"]').eq(index_country).append( "<option value="+val.id+">"+val.name+"</option>");
					});
				}
				$('#city_from').selectpicker('refresh');
			},
			error : function(e){
				console.log(e);
			}
		});
	});

	$(document).on('change' ,'.country_to'  , function(){
		var country = $(this).closest("div").find(".country_to").val();
		var index_country_to = $('.country_to').index(this);
		var baseurl = document.getElementById('baseurl').value;
		$.ajax({
			url:  baseurl+'/city/getCity', 
			type: 'GET',
			data: {country},
			success : function(data){
				$('#city_to').empty();
				if(data == '')
				{
					var empty = "<option selected disabled>عفوا لا يوجد مدن لهذه الدولة!</option>";
					$('select[name="city_to[]"]').eq(index_country_to).html(empty);
				}
				else
				{
					$('select[name="city_to[]"]').eq(index_country_to).empty();
					$.each(data, function(i, val)
					{
						$('select[name="city_to[]"]').eq(index_country_to).append( "<option value="+val.id+">"+val.name+"</option>");
					});
				}
				$('#city_to').selectpicker('refresh');
			},
			error : function(e){
				console.log(e);
			}
		});
	});


	$('#addNewCountry').click(function(event) 
	{
		var new_country = '<div class="form-group">'+
		'<div class="col-md-3">'+
		'الدولة من {{Form::select("country_from[]" , $all_countries , "" , ["class"=>" form-control country_from" , "placeholder" => "اختر الدولة .."  , "data-live-search"=>"true" ])}}'+
		'</div>'+
		'<div class="col-md-3">'+
		'المدينة من  <select  name="city_from[]"  class="form-control" id="city_from" >'+
		'<option disabled="" id="city_from_msg" selected="" value=""> اختر الدولة اولا ...</option>'+
		'</select>'+
		'</div>'+
		'<div class="form-group">'+
		'<div class="col-md-3">'+
		'الدولة الى {{Form::select("country_to[]" , $all_countries , "" , ["class"=>" form-control country_to" , "placeholder" => "اختر الدولة .."  , "data-live-search"=>"true" ])}}'+
		'</div>'+
		'<div class="col-md-3">'+
		'المدينة الى  <select  name="city_to[]"  class="form-control  city_to" >'+
		'<option disabled="" id="city_to_msg" selected="" value=""> اختر الدولة اولا ...</option>'+
		'</select>'+
		'</div>';
		$('#newCountry').append(new_country); 		

	}); 


	function getClientInfo(){
	// get Client Info 
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



$(document).on('change' ,'#client_id'  , function(){
	var client_id = $(this).val();
	$.ajax({
		url:  $('#baseurl').val() + '/clients/getClientWife',
		type: 'GET',
		data: {client_id : client_id},
	})
	.done(function(data) {
		console.log(data);
		if(data == 0)
			document.getElementById('clientWife').innerHTML = '';
		else 
		{
			$.each(data, function(i, val)
			{
				var id_wife =  val.id;
				var name 	  = val.username;
				var wife = 
				'<div class="form-group"><label class="control-label col-md-3">الزوجة</label>'+
				'<div class="col-md-3">'+
				'<input type="checkbox" name="id_wife"  value="'+id_wife+'" />  <b>'+name+'</b>'+
				'</div></div>';
				$('#clientWife').append(wife);
			});
		}
	})
	.fail(function() {
		console.log("error");
	})
});



$(document).on('change' ,'#client_id'  , function(){
	var client_id = $(this).val();
	$.ajax({
		url:  $('#baseurl').val() + '/clients/getClientChild',
		type: 'GET',
		data: {client_id : client_id},
	})
	.done(function(data) {
		console.log(data);
		if(data == 0)
			document.getElementById('clientChild').innerHTML = '';
		else 
		{
			$.each(data, function(i, val)
			{
				var id_wife =  val.id;
				var name 	  = val.username;
				var wife = 
				'<div class="form-group"><label class="control-label col-md-3">الزوجة</label>'+
				'<div class="col-md-3">'+
				'<input type="checkbox" name="id_wife"  value="'+id_wife+'" />  <b>'+name+'</b>'+
				'</div></div>';
				$('#clientChild').append(wife);
			});
		}
	})
	.fail(function() {
		console.log("error");
	})
});


/*$(document).on('change' ,'#client_id'  , function(){
	var client_id = $(this).val();
	$.ajax({
		url:  $('#baseurl').val() + '/clients/getClientFamily',
		type: 'GET',
		data: {client_id : client_id},
	})
	.done(function(data) {
		console.log(data);
		if(data == 0)
			document.getElementById('clientFamily').innerHTML = '';
		else 
		{
			$.each(data, function(i, val)
			{
				var type 	  = val.type;
				if(type == 0)
				{
					var id_wife =  val.id;
					var name 	  = val.name;
					var wife = 
					'<div class="form-group"><label class="control-label col-md-3">الزوجة</label>'+
					'<div class="col-md-3">'+
					'<input type="checkbox" name="id_wife"  value="'+id_wife+'" />  <b>'+name+'</b>'+
					'</div></div>';
					$('#client_family').append(wife);
				}
				else if(type == 1)
				{
					var id_child =  val.id;
					var name 	  = val.name;
					var child = 
					'<div class="form-group"><label class="control-label col-md-3">الابناء</label>'+
					'<div class="col-md-3">'+
					'<input type="checkbox" name="id_child[]"  value="'+id_child+'" />  <b>'+name+'</b>'+
					'</div></div>';
					$('#client_family').append(child);
				}
			});
		}
	})
	.fail(function() {
		console.log("error");
	})
});*/




</script>
@stop




@section('JsScripts')
<script src="{{URL::to('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
@stop



@stop