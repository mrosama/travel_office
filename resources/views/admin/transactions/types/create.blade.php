@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/transactions/types">انواع المعاملات</a>
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
					<span class="caption-subject font-green bold uppercase">  اضافه نوع معاملة جديد</span>
				</div>
			</div>

			<div class="portlet-body">
				
				<!-- BEGIN FORM-->
				{{Form::open(array('route' => 'admin.transactions.types.store', 'method'=>'post' , 'files'=>'true' , 'class'=>'form-horizontal'))}}
				<div class="form-body">

					@if(Session::has('global_s'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('global_s')}}
					</div>
					@endif


					<div class="form-group">
					<label class="control-label col-md-3">نوع المعامله</label>
						<div class="col-md-8">
							{{Form::text('name' , '' , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
							<font color="red">{{$errors->first('name')}}</font><br>
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

	@stop