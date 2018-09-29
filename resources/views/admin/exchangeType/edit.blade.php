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
					<span class="caption-subject font-green bold uppercase">  تعديل نوع صرف </span>
				</div>
			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				{!!Form::open([ 'route' => ['admin.exchangeType.update' , $exchangeType->id],'method'=>'put','class'=>'form-horizontal'])!!}
				<div class="form-body">
					@if(Session::has('success'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('success')}}
					</div>
					@endif
					<div class="form-group  margin-top-20">
						<label class="control-label col-md-3">نوع الصرف
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('type', $exchangeType->type ,array('placeholder'=>'نوع الصرف','class'=>'form-control',"autocomplete" =>"on"  , "autofocus"=>"autofocus"))!!}
								{!! $errors->first('type','<div class="alert alert-danger">:message</div>')!!}
							</div>
						</div>
					</div>


					<div class="form-group  margin-top-20">
						<label class="control-label col-md-3">مدة الصرف
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{{Form::select('duration' , ['يومي' => 'يومي' , 'اسبوعي' => 'اسبوعي' , 'شهري' => 'شهري' , 'سنوي' => 'سنوي' , 'اخرى' => 'اخرى'] , $exchangeType->duration ,array('class' => 'form-control'))}}
								{!! $errors->first('duration','<div class="alert alert-danger">:message</div>')!!}
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn green">حفظ</button>
							<a href="{{URL::to('/admin/exchangeType')}}" class="btn btn-danger">رجوع</a>
						</div>
					</div>
				</div>
			</form>
			<!-- END FORM-->
		</div>
	</div>
	<!-- END VALIDATION STATES-->
</div>
</div>
@stop