@extends ('admin.layouts.master')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/admins">المدراء</a>
		</li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light portlet-fit portlet-form ">
			<div class="portlet-title">
				<div class="caption" style="float:right">
					<i class="fa fa-user font-green"></i>
					<span class="caption-subject font-green bold uppercase">  تعديل مدير</span>
				</div>
			</div>

			<div class="portlet-body">
				
				<!-- BEGIN FORM-->
				{{Form::open(array('route' => ['admin.admins.update' , $admin->id], 'method'=>'put'  , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
				<div class="form-body">

					@if(Session::has('global_s'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('global_s')}}
					</div>
					@endif

					<div class="form-group">
						<label class="control-label col-md-3">اسم المستخدم
						</label>
						<div class="col-md-7">
							{{Form::text('user_name' , $admin->user->user_name , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">كلمة المرور
						</label>
						<div class="col-md-7">
							<div class="input-group">
								<input type="text" class="form-control" name="password" value="{{$admin->user->shown_password}}" id="generatedPass"  >
								<span class="input-group-btn">
									<button class="btn btn-inverse btn-md" type="button" id="generatePass" style="padding: 8px 15px;">توليد</button>
								</span>
							</div>
							<font color="red">{{$errors->first('password')}}</font>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<label class="control-label col-md-3">الاسم</label>
						<div class="col-md-7">
							{{Form::text('name' , $admin->name , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on"  , 'required'])}}
							<font color="red">{{$errors->first('name')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">البريد الالكترونى</label>
						<div class="col-md-7">
							{{Form::email('email' , $admin->email , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
							<font color="red">{{$errors->first('email')}}</font><br>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">الموبايل</label>
						<div class="col-md-7">
							{{Form::text('mobile' , $admin->mobile , ['class'=>'form-control'])}}
							<font color="red">{{$errors->first('mobile')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الهاتف</label>
						<div class="col-md-7">
							{{Form::text('phone' , $admin->phone , ['class'=>'form-control'])}}
							<font color="red">{{$errors->first('phone')}}</font><br>
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

					{{Form::close()}}
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