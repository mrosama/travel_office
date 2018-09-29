@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
@section('CssLinks')
<link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@stop

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/banking/accounts">الحسابات البنكية</a>
		</li>
		<i class="fa fa-angle-left"></i>
		<li>اضافة حساب بنكى جديد</li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light portlet-fit portlet-form ">
			<div class="portlet-title">
				<div class="caption" style="float:right">
					<i class="fa fa-user font-green"></i>
					<span class="caption-subject font-green bold uppercase"> اضافه حساب بنكى جديد</span>
				</div>
			</div>

			<div class="portlet-body">
				
				<!-- BEGIN FORM-->
				{{Form::open(array('route' => 'admin.banking.accounts.store', 'method'=>'post'  , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
				<div class="form-body">

					@if(Session::has('global_s'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('global_s')}}
					</div>
					@endif
					
					<div class="form-group">
						<label class="control-label col-md-3">الشريك</label>
						<div class="col-md-8">
							{{Form::select('partner_id' , $partners , '' , ["class"=>"bs-select form-control" , "data-live-search"=>"true"  , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'من فضلك اختر الشريك' , 'required'])}}
							<font color="red">{{$errors->first('partner_id')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">اسم البنك</label>
						<div class="col-md-8">
							{{Form::text('bank_name' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
							<font color="red">{{$errors->first('bank_name')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الايبان</label>
						<div class="col-md-8">
							{{Form::text('iban' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
							<font color="red">{{$errors->first('iban')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">رقم الحساب</label>
						<div class="col-md-8">
							{{Form::text('bank_number' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
							<font color="red">{{$errors->first('bank_number')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">اسم صاحب الحساب</label>
						<div class="col-md-8">
							{{Form::text('bank_account_owner' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
							<font color="red">{{$errors->first('bank_account_owner')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الدولة</label>
						<div class="col-md-8">
							{{Form::select('country' , $countries , '' , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار الدولة' , "class"=>"bs-select form-control" , "data-live-search"=>"true", 'required'])}}
							<font color="red">{{$errors->first('country')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">المدينة</label>
						<div class="col-md-8">
							{{Form::select('city' , [''=>'من فضلك قم باختيار الدولة اولا'] , '' , ['class'=>'form-control' , "autocomplete" =>"on" , "data-live-search"=>"true", 'required'])}}
							<font color="red">{{$errors->first('city')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">اخرى</label>
						<div class="col-md-8">
							{{Form::text('other' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
							<font color="red">{{$errors->first('other')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">ملاحظات</label>
						<div class="col-md-8">
							{{Form::textarea('notes' , '' , ['class'=>'form-control', 'required'])}}
							<font color="red">{{$errors->first('notes')}}</font><br>
						</div>
					</div>

					<div class="form-actions text-center">
						<div class="row">
							<div class="col-md-offset-2 col-md-9">
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
	<script src="{{URL::to('/')}}/assets/form-validation.js" type="text/javascript"></script>
	<script type="text/javascript" src="{{URL::to('/assets/getCityAjax.js')}}"></script>
	@stop

	@stop