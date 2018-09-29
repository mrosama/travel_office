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
					<span class="caption-subject font-green bold uppercase">  تعديل بيانات معهد / كلية / جامعة </span>
				</div>
			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				{!!Form::open(['route' => ['admin.institutes.update' , $institute_data->id] ,'method'=>'put','class'=>'form-horizontal' , 'files' => 'true'])!!}
				<div class="form-body">
					@if(Session::has('success'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('success')}}
					</div>
					@endif
					<div class="form-group  margin-top-20">
						<label class="control-label col-md-3">الدولة
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::select('country_code', $all_country , $institute_data->country_code ,array('placeholder'=>'اختر الدولة ....','class'=>' form-control bs-select' , 'data-live-search' => 'true'  ,'id' => 'country'))!!}
								{!! $errors->first('country_code','<div class="alert alert-danger">:message</div>')!!}   
							</div>
							<div id="EmployeeInfo"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">المدينة
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<select name="city" id="cities" class="form-control bs-select" data-live-search="true">
								<option value="{{$institute_data->city}}">{{$institute_data->getCity->name}}</option>
							</select>
							{!! $errors->first('city','<div class="alert alert-danger">:message</div>')!!}                            
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">اسم المعهد
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('name', $institute_data->name,array('placeholder'=>'اسم المعهد','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('name','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>

					<div class="form-group  margin-top-20">
						<label class="control-label col-md-3">الهاتف
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('phone' , $institute_data->phone ,array('placeholder'=>'00000000', "autofocus"=>"autofocus",'class'=>'form-control'))!!}
								{!! $errors->first('phone','<div class="alert alert-danger">:message</div>')!!}
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class= "control-label col-md-3"> الجوال
							<span class="required"> * </span>
						</label>
						<div class="col-md-4"> 
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('mobile' , $institute_data->mobile ,array('placeholder'=>'00966123456789', "autofocus"=>"autofocus",'class'=>'form-control'))!!}
								{!! $errors->first('mobile','<div class="alert alert-danger">:message</div>')!!}    
							</div>
						</div>	
					</div>



					<div class="form-group">
						<label class= "control-label col-md-3"> الموقع الالكتروني
							<span class="required"> * </span>
						</label>
						<div class="col-md-4"> 
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('web_site' , $institute_data->web_site  ,array('placeholder'=>'http://www.example.com', "autofocus"=>"autofocus",'class'=>'form-control'))!!}
								{!! $errors->first('web_site','<div class="alert alert-danger">:message</div>')!!}    
							</div>
						</div>	
					</div>


					<div class="form-group">
						<label class= "control-label col-md-3"> صندوق البريد
							<span class="required"> * </span>
						</label>
						<div class="col-md-4"> 
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('postal_code' ,  $institute_data->postal_code ,array('placeholder'=>'00000', "autofocus"=>"autofocus",'class'=>'form-control'))!!}
								{!! $errors->first('postal_code','<div class="alert alert-danger">:message</div>')!!}    
							</div>
						</div>	
					</div>


					<div class="form-group">
						<label class= "control-label col-md-3"> العنوان
							<span class="required"> * </span>
						</label>
						<div class="col-md-4"> 
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::textarea('address' , $institute_data->address  ,array('placeholder'=>'عنوان المعهد بالتفصيل', "autofocus"=>"autofocus",'class'=>'form-control'))!!}
								{!! $errors->first('address','<div class="alert alert-danger">:message</div>')!!}    
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