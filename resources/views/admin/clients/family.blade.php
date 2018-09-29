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
			</div>
			<div class="portlet-body">
				@if($client_wife)
				<form class='form-horizontal'  method='#' action="">
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">الزوجة</label>
							<label class="control-label col-md-3">
								{{$wife_name[0]['username']}}
							</label>
							<div class="col-md-3 ">
								<button type="submit" class="btn green">تعديل بيانات الزوجة</button>
							</div>
						</div>
					</form>
					@else
					<form class ='form-horizontal'  method='post' action="" >
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3">الزوجة
								</label>
								<div class="col-md-4" id="no_wife" >
									لا يوجد زوجة لهذا العميل حاليا   {{link_to_route('admin.clients.create', 'اضافة زوجة' , array('parent_id' => $client->id , 'type' => 0), array('class' => 'btn btn-success'))}}
								</div>
							</div>
						</div>
					</form>
					@endif
					<hr>
					@if(count($client_child) == 0)
					{{Form::open(['class' => 'form-horizontal'])}}
					<div class="form-body">

						<div class="form-group">
							<label class="control-label col-md-3">الاولاد</label>
							<div class="col-md-4" id="no_Child" >
								لا يوجد اولاد لهذا العميل حاليا    {{link_to_route('admin.clients.create', 'اضافة ابن' , array('parent_id' => $client->id , 'type' => 1), array('class' => 'btn btn-success'))}}
							</div>
						</div>
					</div>
					{{Form::close()}}
					@else
					{{Form::open(['class' => 'form-horizontal'])}}
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">الاولاد
							</label>
						</div>
						@foreach($child_name as $row)
						<div class="form-group">
							<label class="control-label col-md-3">الاسم
								<span class="required"> * </span>
							</label>
							<div class="col-md-4">
								<div class="input-icon right">
									{{$row[0]['username']}}
								</div>
							</div>
							<div class="col-md-2 ">
								<button type="submit" class="btn green">تعديل</button>
							</div>
						</div>
						@endforeach
						{{link_to_route('admin.clients.create', ' + اضافة ابن جديد' , array('parent_id' => $client->id , 'type' => 1), array('class' => 'btn btn-danger'))}}
					</div>
					{{Form::close()}}
					@endif
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