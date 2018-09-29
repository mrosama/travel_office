@extends ('admin.layouts.master')
@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> طلبات العملاء
	<small>تعديل طلب العميل</small>
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
			<espan>تعديل طلب العميل</span>
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
						<span class="caption-subject font-green bold uppercase">  تعديل طلب العميل</span>
					</div>
				</div>
				<div class="portlet-body">
					<!-- BEGIN FORM-->
					<div class="form-body">
						{!!Form::open(array('route' => ['admin.clients_orders.update' , $client_order->id] ,'method'=>'put','class'=>'form-horizontal'))!!}
						<div class="form-body">
							@if(Session::has('success'))
							<div class="alert alert-success" style="text-align : right;">
								<strong>شكرا لك ! </strong> {{Session::get('success')}}
							</div>
							@endif

							<div class="form-group">
								<label class="control-label col-md-3">اسم العميل
									<span class="required"> * </span>
								</label>
								<div class="col-md-8">
									<select name="client_id" class="form-control bs-select" data-live-search="true" id="client_id" onchange="getClientInfo()"> 
										<option value="{{$client_order->client_id}}">{{$client_order->get_client_name->username}}</option>
										@foreach($all_clients as $row)
										<option value="{{$row->id}}">{{$row->username}}</option>
										@endforeach
									</select>
									{!! $errors->first('client_id','<div class="alert alert-danger">:message</div>')!!}                      
									<div id="clientInfo">
									</div>
								</div>
							</div>
							<div  id="client_family"></div>
							<div id="old_family">

								@if($wife != null)
								@if($wife)
								<div class="form-group">
									<label class="control-label col-md-3">الزوجة</label>
									
									<div class="col-md-3"><input type="checkbox" checked="" name="id_wife" value="{{$wife->id}}">
										<b>{{$wife->username}}</b>
									</div>
								</div>
								@else
								<div class="form-group">
									<label class="control-label col-md-3">الزوجة</label>
									<div class="col-md-3"><input type="checkbox"  name="id_wife" value="{{$wife->id}}">
										<b>{{$wife->username}}</b>
									</div>
								</div>
								@endif
								@endif

								@if($client_order->id_child != '[null]')
								<div class="form-group">
									<label class="control-label col-md-3">الابناء</label>
									<div class="col-md-3">
										<?php if($client_order->id_child == 'null'){$client_order->id_child = json_encode(array());}?>
										@if($child)
										@foreach($child as $row)

										@if(in_array($row->id, json_decode($client_order->id_child)))
										<input type="checkbox" checked=""   name="id_child[]" value="{{$row->id}}"><b>{{$row->username}}</b>
										@else
										<input type="checkbox"   name="id_child[]" value="{{$row->id}}"><b>{{$row->username}}</b>
										@endif
										@endforeach
										@else
										**
										@endif
									</div>
								</div>
							</div>
							@endif


							<div class="form-group">
								<label class="control-label col-md-3">نوع الطلب
									<span class="required"> * </span>
								</label>
								<div class="col-md-8">
									<select class="form-control bs-select" multiple name="order_type[]">
										@foreach(json_decode($client_order->order_type) as $key => $val)
										<option selected value="{{App\Orders_type::find($val)->id}}">{{App\Orders_type::find($val)->type}}</option>
										@endforeach

										@foreach($orders_type as $row)
										<option value="{{$row->id}}">{{$row->type}}</option>
										@endforeach
									</select>
									{!! $errors->first('order_type','<div class="alert alert-danger">:message</div>')!!}              
								</div>
							</div>


							<div class="form-actions">
								<div class="row">
									<div class="text-center">
										<button type="submit" class="btn green">تعديل الطلب</button>
									</div>
								</div>
							</div>

						</form>
					</div>
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



		$(document).on('change' ,'#client_id'  , function(){
			var client_id = $(this).val();
			var current_client_id = '{{$client_order->client_id}}';
			if(client_id == current_client_id)
			{
				$('#client_family').empty();
				$("#old_family").show();
			}
			else
			{
				$.ajax({
					url:  $('#baseurl').val() + '/clients/getClientFamily',
					type: 'GET',
					data: {client_id : client_id},
				})
				.done(function(data) {
					console.log(data);
					$( "#old_family" ).hide();
					if(data == 0)
						document.getElementById('clientFamily').innerHTML = '';
					else 
					{
						$('#client_family').empty();
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
			}

		});




	</script>
	@stop


	@section('JsScripts')
	<script src="{{URL::to('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
	<script src="{{URL::to('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
	@stop



	@stop