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
					<span class="caption-subject font-green bold uppercase">  اضافه قسم للمكتب السياحي / الديني</span>
				</div>

			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				{!!Form::open(array('url' => 'admin/travel_sections','method'=>'post','class'=>'form-horizontal'))!!}
				<div class="form-body">
					@if(Session::has('success'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('success')}}
					</div>
					@endif


					<div class="form-group">
						<label class="control-label col-md-3">اسم المكتب
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::select('travel_officeId', $all_office , '',array('placeholder'=>'اسم المكتب','class'=>'bs-select form-control', 'data-live-search' => 'true' , "autofoucs" => "autofoucs"))!!}
								{!! $errors->first('travel_officeId','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">اسم القسم
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('sectionName','',array('placeholder'=>'اسم القسم','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('sectionName','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">رقم الهاتف
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('phone','',array('placeholder'=>'رقم الهاتف','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('phone','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>



					<div class="form-group">
						<label class="control-label col-md-3">رقم الجوال
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('mobile','',array('placeholder'=>'رقم الجوال','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('mobile','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">البريد الالكتروني
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('email','',array('placeholder'=>'البريد الالكتروني','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('email','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">فاكس
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('fax','',array('placeholder'=>'فاكس','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('fax','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">التحويلة
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('ext','',array('placeholder'=>'التحويلة','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('ext','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>



				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn green">حفظ</button>
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