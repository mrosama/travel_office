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
			<span> <a href="{{URL::to('/admin/clients_orders')}}">طلبات العملاء</a></span>
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
						<div style="text-align:center;margin:10px 0;font-size: 16px;">
						<a href="{{URL::to('/admin/executing/orders' , Session::get('order_id'))}}">لتنفيذ الطلب اضغط هنا</a>
						</div>
						@endif

						<div class="form-group">
							<label class="control-label col-md-3">اسم العميل
								<span class="required"> * </span>
							</label>
							<div class="col-md-8">
								{{Form::select('client_id' , $all_clients , '' , ['class' => 'bs-select form-control' , 'data-live-search' =>'true' , "autofocus"=>"autofocus",  'required' , 'placeholder' => 'اختر العميل' , 'id' => 'client_id', 'onchange' => 'getClientInfo()'])}}
								{!! $errors->first('client_id','<div class="alert alert-danger">:message</div>')!!}                            
								<div id="clientInfo"></div>
							</div>
							<div  id="clientWife" ></div>
							<div  id="clientChild"></div>
						</div>



						<div class="form-group">
							<label class="control-label col-md-3">نوع الطلب
								<span class="required"> * </span>
							</label>
							<div class="col-md-8">
								{!!Form::select('order_type[]', $orders_type , '' , array( 'required' , 'class'=>'form-control bs-select' , 'multiple'  ))!!}
								{!! $errors->first('order_type','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>

					</div>



					<div class="form-actions">
						<div class="row">
							<div class="text-center">
								<button type="submit" class="btn green">انشاء طلب</button>
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
			document.getElementById('clientInfo').innerHTML = '<div  class="well " >'
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
				var id_child =  val.id;
				var name 	  = val.username;
				var child = 
				'<div class="form-group"><label class="control-label col-md-3">الاولاد</label>'+
				'<div class="col-md-3" style="margin-top: 6px;">'+
				'<input type="checkbox" name="id_child"  value="'+id_child+'" />  <b>'+name+'</b>'+
				'</div></div>';
				$('#clientChild').append(child);
			});
		}
	})
	.fail(function() {
		console.log("error");
	})
});

</script>
<script src="{{URL::to('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
@stop







@stop