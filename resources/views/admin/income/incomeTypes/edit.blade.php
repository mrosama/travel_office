@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/income/types">انواع الايرادات</a>
		</li>
		<i class="fa fa-angle-left"></i>
		<li>تعديل نوع</li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light portlet-fit portlet-form ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bubble font-green"></i>
					<span class="caption-subject font-green bold uppercase">  تعديل نوع ايراد</span>
				</div>
			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				{!!Form::open(array('route' => ['admin.income.types.update' , $type->id],'method'=>'put','class'=>'form-horizontal' , 'id'=>'form'))!!}
				<div class="form-body">
					@if(Session::has('success'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('success')}}
					</div>
					@endif
					
					<div class="form-group">
						<label class="control-label col-md-3">نوع الايراد
							<span class="required"> * </span>
						</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('type',$type->type,array('placeholder'=>'نوع الايراد','class'=>'form-control',  "autocomplete" =>"on" , 'required'))!!}
								<font color="red">{!! $errors->first('type')!!}</font>
							</div>
						</div>
					</div>


					
					<div class="form-actions text-center">
						<div class="row">
							<div class="col-md-offset-2 col-md-9">
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


	@stop