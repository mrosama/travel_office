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
					<span class="caption-subject font-green bold uppercase">  اضافة بيانات موقع  جديد</span>
				</div>
			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				{!!Form::open(array('url' => 'admin/loginSite', 'method'=>'post' , 'class'=>'form-horizontal'))!!}
				<div class="form-body">
					@if(Session::has('success'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('success')}}
					</div>
					@endif
					<div class="form-group  margin-top-20">
						<label class="control-label col-md-3">اسم الموقع
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('name', '',array('placeholder'=>'اسم الموقع', "autofocus"=>"autofocus",'class'=>'form-control' ,  "autocomplete" =>"on"))!!}
								{!! $errors->first('name','<div class="alert alert-danger">:message</div>')!!}
							</div>
							<div id="EmployeeInfo"></div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">الهدف من الموقع
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('goal','',array('placeholder'=>'الهدف من الموقع','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('goal','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>
					<div class="form-group  margin-top-20">
						<label class="control-label col-md-3">رابط الموقع
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('link','',array('placeholder'=>'رابط الموقع', "autofocus"=>"autofocus",'class'=>'form-control'))!!}
								{!! $errors->first('link','<div class="alert alert-danger">:message</div>')!!}
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class= "control-label col-md-3"> اسم المستخدم
							<span class="required"> * </span>
						</label>
						<div class="col-md-4"> 
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('username','',array('placeholder'=>'اسم المستخدم', "autofocus"=>"autofocus",'class'=>'form-control'))!!}
								{!! $errors->first('username','<div class="alert alert-danger">:message</div>')!!}  
							</div>
						</div>	
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">كلمة المرور
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('password','',array('placeholder'=>'كلمة المرور', "autofocus"=>"autofocus",'class'=>'form-control'))!!}
								{!! $errors->first('password','<div class="alert alert-danger">:message</div>')!!}
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3"> الحالة
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::radio('type','عام',true)!!} عام
								{!!Form::radio('type','خاص')!!} خاص
								{!! $errors->first('type','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>



					<div class="form-group">
						<label class="control-label col-md-3"> ملاحظات
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::textarea('notes','',array('placeholder'=>'ملاحظات','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('notes','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>

				</div>

				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn green">حفظ</button>
							<button type="reset" class="btn default">الغاء </button>
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