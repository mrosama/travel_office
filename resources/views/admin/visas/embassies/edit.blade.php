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
			<a href="{{URL::to('/')}}/admin/embassies">السفارات</a>
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
					<span class="caption-subject font-green bold uppercase">تعديل سفارة</span>
				</div>
			</div>

			<div class="portlet-body">
				
				<!-- BEGIN FORM-->
				{{Form::open(array('route' => ['admin.embassies.update' , $embassy->id], 'method'=>'put' , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
				<div class="form-body">

					@if(Session::has('global_s'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('global_s')}}
					</div>
					@endif

					<div class="form-group">
						<label class="control-label col-md-3">اسم السفارة</label>
						<div class="col-md-8">
							{{Form::text('name' , $embassy->name , ['class'=>'form-control' , 'placeholder'=>'اسم السفارة' , 'required'])}}
							<font color="red">{{$errors->first('name')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">حضور شخصى للسفارة</label>
						<div class="col-md-8">
							{{Form::text('presence' , $embassy->presence , ['class'=>'form-control' , 'placeholder'=>'حضور شخصى للسفارة' , 'required'])}}
							<font color="red">{{$errors->first('presence')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الدولة</label>
						<div class="col-md-8">
							{{Form::select('country' , $countries , $embassy->country , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار الدولة' , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'required'])}}
							<font color="red">{{$errors->first('country')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">المدينة</label>
						<div class="col-md-8">
							{{Form::select('city' , $cities , $embassy->city , [ "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'placeholder'=>'من فضلك قم باختيار المدينة' , "autocomplete" =>"on" , "data-live-search"=>"true" , 'required'])}}
							<font color="red">{{$errors->first('city')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الشارع</label>
						<div class="col-md-8">
							{{Form::text('street' , $embassy->street , ['class'=>'form-control' , 'placeholder'=>'الشارع' , 'required'])}}
							<font color="red">{{$errors->first('street')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الموقع الالكترونى</label>
						<div class="col-md-8">
							{{Form::text('site_url' , $embassy->site_url , ['class'=>'form-control' , 'placeholder'=>'الموقع الالكترونى' , 'required' , 'url'])}}
							<font color="red">{{$errors->first('site_url')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">البريد الالكترونى</label>
						<div class="col-md-8">
							{{Form::text('email' , $embassy->email , ['class'=>'form-control' , 'placeholder'=>'البريد الالكترونى' , 'required' , 'email'])}}
							<font color="red">{{$errors->first('email')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الجوال</label>
						<div class="col-md-8">
							{{Form::text('mobile' , $embassy->mobile , ['class'=>'form-control' , 'placeholder'=>'الجوال' , 'required' , 'number'])}}
							<font color="red">{{$errors->first('mobile')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الهاتف</label>
						<div class="col-md-8">
							{{Form::text('phone' , $embassy->phone , ['class'=>'form-control' , 'placeholder'=>'الهاتف' , 'required' , 'number'])}}
							<font color="red">{{$errors->first('phone')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">امكانية مكتب يخلص المعاملة</label>
						<div class="col-md-8">
							{{Form::text('office' , $embassy->office , ['class'=>'form-control' , 'placeholder'=>'امكانية مكتب يخلص المعاملة' , 'required'])}}
							<font color="red">{{$errors->first('office')}}</font><br>
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
	
	<script type="text/javascript" src="{{URL::to('/assets/getCityAjax.js')}}"></script>
	@stop

	@stop