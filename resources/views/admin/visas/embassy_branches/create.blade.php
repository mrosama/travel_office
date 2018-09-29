@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
@section('CssLinks')
<style type="text/css">
	label.mt-checkbox.mt-checkbox-outline{margin-left:10px;}
</style>
@stop

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/embassy/branches">الفروع</a>
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
					<span class="caption-subject font-green bold uppercase">اضافة فرع جديد</span>
				</div>
			</div>

			<div class="portlet-body">
				
				<!-- BEGIN FORM-->
				{{Form::open(array('route' => 'admin.embassy.branches.store', 'method'=>'post' , 'files'=>'true' , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
				<div class="form-body">

					@if(Session::has('global_s'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('global_s')}}
					</div>
					@endif


					<div class="form-group">
						<label class="control-label col-md-3">اسم السفارة التابع لها الفرع</label>
						<div class="col-md-8">
							{{Form::select('embassy_id' , $embassies , '' , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار السفارة' , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'required'])}}
							<font color="red">{{$errors->first('embassy_id')}}</font><br>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">اسم الفرع</label>
						<div class="col-md-8">
							{{Form::text('name' , '' , ['class'=>'form-control' , 'placeholder'=>'اسم السفارة' , 'required'])}}
							<font color="red">{{$errors->first('name')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الدولة</label>
						<div class="col-md-8">
							{{Form::select('country' , $countries , '' , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار الدولة' , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'required'])}}
							<font color="red">{{$errors->first('country')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">المدينة</label>
						<div class="col-md-8">
							{{Form::select('city' , [''=>'من فضلك قم باختيار الدولة اولا'] , '' , ['class'=>'form-control' , "autocomplete" =>"on" , "data-live-search"=>"true" , 'required'])}}
							<font color="red">{{$errors->first('city')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الشارع</label>
						<div class="col-md-8">
							{{Form::text('street' , '' , ['class'=>'form-control' , 'placeholder'=>'الشارع' , 'required'])}}
							<font color="red">{{$errors->first('street')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الموقع الالكترونى</label>
						<div class="col-md-8">
							{{Form::text('site_url' , '' , ['class'=>'form-control' , 'placeholder'=>'الموقع الالكترونى'  , 'url'])}}
							<font color="red">{{$errors->first('site_url')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">البريد الالكترونى</label>
						<div class="col-md-8">
							{{Form::text('email' , '' , ['class'=>'form-control' , 'placeholder'=>'البريد الالكترونى'  , 'email'])}}
							<font color="red">{{$errors->first('email')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الجوال</label>
						<div class="col-md-8">
							{{Form::text('mobile' , '' , ['class'=>'form-control' , 'placeholder'=>'الجوال'  , 'number'])}}
							<font color="red">{{$errors->first('mobile')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الهاتف</label>
						<div class="col-md-8">
							{{Form::text('phone' , '' , ['class'=>'form-control' , 'placeholder'=>'الهاتف'  , 'number'])}}
							<font color="red">{{$errors->first('phone')}}</font><br>
						</div>
					</div>


					<div class="form-actions">
						<div class="row">
							<div class="text-center">
								<button type="submit" class="btn green">حفظ</button>
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
	
	<script type="text/javascript" src="{{URL::to('/assets/getCityAjax.js')}}"></script>
	@stop

	@stop