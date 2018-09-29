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
					<span class="caption-subject font-green bold uppercase"> 
						عائلة العميل  - {{$client->username}}
					</span>
				</div>
				<div class="col-md-2">
					<button type="button" class="btn blue" id="addMoreChild">اضف ابن اخر</button>
				</div>	
			</div>
			<div class="portlet-body">
				@if($client_wife)
				{{Form::open(['route' => ['admin.clients.updateWife' , $client->id] ,  'class' => 'form-horizontal' , 'method'=>'put'  ])}}
				<div class="form-body">
					@if(Session::has('success'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('success')}}
					</div>
					@endif
					<div class="form-group">
						<label class="control-label col-md-3">الزوجة
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('name', $client_wife->name ,array('class'=>'form-control'))!!}
								<input type="hidden" name="client_id" value="{{$client->id}}"/>
								{!! $errors->first('name','<div class="alert alert-danger">:message</div>')!!}    
							</div>
						</div>
						<div class="col-md-offset-3 ">
							<button type="submit" class="btn green">تعديل</button>
						</div>
					</div>
					{{Form::close()}}
					@else
					{{Form::open(['url' => 'admin/clients/addWife' ,  'class' => 'form-horizontal' , 'method'=>'post'  ])}}
					<div class="form-body">
						@if(Session::has('success'))
						<div class="alert alert-success" style="text-align : right;">
							<strong>شكرا لك ! </strong> {{Session::get('success')}}
						</div>
						@endif
						<div class="form-group">
							<label class="control-label col-md-3">الزوجة
							</label>
							<div class="col-md-4" id="no_wife" >
								لا يوجد زوجة لهذا العميل حاليا   <button id="addWife" type="button" class="btn btn-success">اضافة زوجة</button>
							</div>
							<div class="col-md-4" id="add_wife" style="display:none;">
								<input type="text" name="name" required class="form-control" placeholder="اسم الزوجة"/>
								{!! $errors->first('name','<div class="alert alert-danger">:message</div>')!!}    
								<input type="hidden" name="client_id" value="{{$client->id}}"/>
								<br>
								<button type="submit" class="btn green">اضافة</button>
							</div>
						</div>
					</div>
					{{Form::close()}}
					@endif

					<hr>


					@if(count($client_child) == 0)
					{{Form::open(['url' => 'admin/clients/addChild' ,  'class' => 'form-horizontal' , 'method'=>'post'  ])}}
					<div class="form-body">

						<div class="form-group">
							<label class="control-label col-md-3">الاولاد
								<span class="required"> * </span>
							</label>
							<div class="col-md-4" id="no_Child" >
								لا يوجد اولاد لهذا العميل حاليا   <button id="addChild" type="button" class="btn btn-success">اضافة اولاد</button>
							</div>
							<div class="col-md-4" id="add_Child" style="display:none;">
								<input type="text" name="name" required class="form-control" placeholder="الاسم"/>
								{!! $errors->first('name','<div class="alert alert-danger">:message</div>')!!}    
								<input type="hidden" name="client_id" value="{{$client->id}}"/>
								<br>
								<button type="submit" class="btn green">اضافة</button>
							</div>
						</div>
					</div>
					{{Form::close()}}
					
					@else

					{{Form::open(['url' => 'admin/clients/updateChild' ,  'class' => 'form-horizontal' , 'method'=>'post'  ])}}
					<div class="form-body">

						<div class="form-group">
							<label class="control-label col-md-3">الاولاد
							</label>
						</div>
						@foreach($client_child as $row)
						<div class="form-group">
							<label class="control-label col-md-3">الاسم
								<span class="required"> * </span>
							</label>
							<div class="col-md-4">
								<div class="input-icon right">
									<i class="fa"></i>
									{!!Form::text('name', $row->name ,array('class'=>'form-control'))!!}
									<input type="hidden" name="child_id" value="{{$row->id}}"/>
									{!! $errors->first('name','<div class="alert alert-danger">:message</div>')!!}    
								</div>
							</div>
							<div class="col-md-2 ">
								<button type="submit" class="btn green">تعديل</button>
							</div>
						</div>
						@endforeach
					</div>
					{{Form::close()}}
					@endif


					<div id="moreChild" style="display:none">
						{{Form::open(['url' => 'admin/clients/addChild' ,  'class' => 'form-horizontal' , 'method'=>'post'  ])}}
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3">اسم الابن
									<span class="required"> * </span>
								</label>
								<div class="col-md-4" >
									<input type="text" name="name" required class="form-control" placeholder="اسم الابن"/>
									{!! $errors->first('name','<div class="alert alert-danger">:message</div>')!!}    
									<input type="hidden" name="client_id" value="{{$client->id}}"/>
									<br>
									<button type="submit" class="btn green">اضافة</button>
								</div>
							</div>
						</div>
						{{Form::close()}}
					</div>

					<!-- END FORM-->
				</div>
			</div>
			<!-- END VALIDATION STATES-->
		</div>
	</div>


	@section('JsScripts')
	<script type="text/javascript">
		$("#addWife").click(function(event) 
		{
			$("#no_wife").css("display", "none");
			$("#add_wife").css("display", "block");
		});


		$("#addChild").click(function(event) 
		{
			$("#no_Child").css("display", "none");
			$("#add_Child").css("display", "block");
		});

		$("#addMoreChild").click(function(event) 
		{
			$("#moreChild").css("display" , "block");
		});
	</script>
	@stop
	@stop