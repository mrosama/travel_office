@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/transactions">المعاملات</a>
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
					<span class="caption-subject font-green bold uppercase"> تعديل معاملة</span>
				</div>
			</div>

			<div class="portlet-body">
				
				<!-- BEGIN FORM-->
				{{Form::open(array('route' => ['admin.transactions.update' , $data['transaction']->id], 'method'=>'put' , 'files'=>'true' , 'class'=>'form-horizontal'))}}
				<div class="form-body">

					@if(Session::has('global_s'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('global_s')}}
					</div>
					@endif


					<div class="form-group">
						<label class="control-label col-md-3">نوع المعامله</label>
						<div class="col-md-8">
							{{Form::select('transaction_type_id' , $data['transactions_types'] ,  $data['transaction']->transaction_type_id , [ "class"=>"bs-select form-control" , "data-live-search"=>"true" ,'placeholder'=>'من فضلك قم باختيار نوع المعاملة'])}}
							<font color="red">{{$errors->first('transaction_type_id')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الجهة</label>
						<div class="col-md-8">
							{{Form::text('site' , $data['transaction']->site , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
							<font color="red">{{$errors->first('site')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الاوراق المطلوبة</label>
						<div class="col-md-8">
							{{Form::textarea('paper_work' , $data['transaction']->paper_work , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
							<font color="red">{{$errors->first('paper_work')}}</font><br>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">نموذج</label>
						<div class="col-md-8">
							{{Form::file('form' , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
							<p>
								@if($data['transaction']->form != null)
								لرؤية الملف المرفوع من قبل <a href="{{URL::to($data['transaction']->form)}}"> اضغط هنا</a>
								@else
								لا يوجد ملف مرفوع من قبل
								@endif
							</p>
							<font color="red">{{$errors->first('form')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الموقع الالكترونى</label>
						<div class="col-md-8">
							{{Form::text('website' , $data['transaction']->website , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
							<font color="red">{{$errors->first('website')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الدولة</label>
						<div class="col-md-8">
							{{Form::select('country' , $data['countries'] , $data['transaction']->country , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار الدولة' , "class"=>"bs-select form-control" , "data-live-search"=>"true"])}}
							<font color="red">{{$errors->first('country')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">المدينة</label>
						<div class="col-md-8">
							{{Form::select('city' , $data['cities'] , $data['transaction']->city , ["class"=>"bs-select form-control" , "data-live-search"=>"true"  , "data-live-search"=>"true"])}}
							<font color="red">{{$errors->first('city')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">البريد الالكترونى</label>
						<div class="col-md-8">
							{{Form::email('email' , $data['transaction']->email , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
							<font color="red">{{$errors->first('email')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الموبايل</label>
						<div class="col-md-8">
							{{Form::text('mobile' , $data['transaction']->mobile , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
							<font color="red">{{$errors->first('mobile')}}</font><br>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">ملاحظات</label>
						<div class="col-md-8">
							{{Form::textarea('notes' , $data['transaction']->notes , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
							<font color="red">{{$errors->first('notes')}}</font><br>
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