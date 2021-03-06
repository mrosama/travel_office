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
					<span class="caption-subject font-green bold uppercase">  تعديل بيانات الموظف</span>
				</div>

			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				{!!Form::open(['route' =>['admin.travel_employees.update' , $employee->id],'method'=>'put','class'=>'form-horizontal' , 'files' => true])!!}
				<div class="form-body">
					@if(Session::has('success'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('success')}}
					</div>
					@endif



					<div class="form-group">
						<label class="control-label col-md-3">اسم المكت السياحي / الديني
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<select name="travel_officeId" class="form-control bs-select" data-live-search= 'true' id="travel_officeId" onchange="getTravelSection()">
								<option value="{{$employee->travel_officeId}}">{{$employee->officeName->name}}</option>
								@foreach($all_office as $row)	
									<option value="{{$row->id}}">{{$row->name}}</option>
								@endforeach
							</select>
							{!! $errors->first('travel_officeId','<div class="alert alert-danger">:message</div>')!!}                            
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">اسم القسم
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">

							<select name="sectionId" id="sectionId" class="form-control bs-select" data-live-search ='true'>
								<option value="{{$employee->sectionId}}">{{$employee->sectionName->sectionName}}</option>
								@foreach($all_section as $row)	
									<option value="{{$row->id}}">{{$row->sectionName}}</option>
								@endforeach
							</select>
							{!! $errors->first('sectionName','<div class="alert alert-danger">:message</div>')!!}                            
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">اسم الموظف
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('empName', $employee->empName,array('placeholder'=>'اسم الموظف','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('empName','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">الجنسية
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('nationality', $employee->nationality ,array('placeholder'=>'الجنسية','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('nationality','<div class="alert alert-danger">:message</div>')!!}                            
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
								{!!Form::text('mobile', $employee->mobile ,array('placeholder'=>'رقم الجوال','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('mobile','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">الهاتف
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('phone', $employee->phone,array('placeholder'=>'الهاتف','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('phone','<div class="alert alert-danger">:message</div>')!!}                            
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
								{!!Form::text('email', $employee->email,array('placeholder'=>'البريد الالكتروني','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('email','<div class="alert alert-danger">:message</div>')!!}                            
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
								{!!Form::text('ext', $employee->ext,array('placeholder'=>'التحويلة','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('ext','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">الصورة شخصية
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::file('emp_photo')!!}
								{!! $errors->first('emp_photo','<div class="alert alert-danger">:message</div>')!!}                     
							</div>
						</div>
						<div class="col-md-3">
							{{HTML::image($employee->emp_photo , '', ['width' => '65px' , 'height' => '65px'])}}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">الجنس
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								@if($employee->sex == 'male')
								ذكر 	{{Form::radio('sex', 'male' , true)}}
								انثى{{Form::radio('sex' , 'female')}} 
								@else($employee->sex == 'female')
								ذكر 	{{Form::radio('sex', 'male' )}}
								انثى{{Form::radio('sex' , 'female',  true)}} 
								@endif
								{!! $errors->first('sex','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">تاريخ الميلاد
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<input class="form-control form-control-inline  date-picker" name="birthDate" value="{{$employee->birthDate}}" placeholder="dd/mm/yyyy"    size="16" type="text" data-date-format="dd/mm/yyyy" data-date-end-date="-5y -3m +8d">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">رقم السجل المدني / الاقامة
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('No_civilRegistry', $employee->No_civilRegistry,array('placeholder'=>'رقم السجل المدني / الاقامة','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('No_Residence','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">تاريخ انتهاء السجل المدني / الاقامة
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							
							<input class="form-control form-control-inline date-picker"  value="{{ $employee->expireResidence}}" name="expireResidence" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" size="16" type="text">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">مصدر السجل المدني / الاقامة
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('sourceResidence', $employee->sourceResidence,array('placeholder'=>'مصدر السجل المدني / الاقامة','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('sourceResidence','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">صورة السجل المدني / الاقامة
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::file('photoResidence')!!}
								{!! $errors->first('photoResidence','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
						<div class="col-md-3">
							{{HTML::image($employee->photoResidence , '', ['width' => '65px' , 'height' => '65px'])}}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">رقم الجواز
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('passportNumber', $employee->passportNumber,array('placeholder'=>'رقم الجواز','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('passportNumber','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">تاريخ اصدار الجواز
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<input class="form-control form-control-inline  date-picker" value="{{$employee->passport_issue_date}}" name="passport_issue_date"   placeholder="dd/mm/yyyy" size="16" type="text" data-date-format="dd/mm/yyyy" value="" data-date-end-date="+0d">
						</div>
					</div>	
					<div class="form-group">
						<label class="control-label col-md-3">تاريخ انتهاء الجواز
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<input class="form-control form-control-inline  date-picker" value="{{$employee->passport_finish_date}}"  placeholder="dd/mm/yyyy" name="passport_finish_date" size="16" type="text" data-date-format="dd/mm/yyyy" value="" data-date-end-date="+0d">
						</div>
					</div>	
					<div class="form-group">
						<label class="control-label col-md-3">مصدر الجواز
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('sourcePassport',$employee->sourcePassport ,array('placeholder'=>'مصدر الجواز','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('sourcePassport','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">صورة الجواز
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::file('photoPassport')!!}
								{!! $errors->first('photoPassport','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
						<div class="col-md-3">
							{{HTML::image($employee->photoPassport , '', ['width' => '65px' , 'height' => '65px'])}}
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">ملاحظات
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::textarea('notes',$employee->notes,array('placeholder'=>'ملاحظات','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('notes','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn green">حفظ</button>
							<button type="button" class="btn default">{!! link_to_route('admin.companyEmployee.index', 'عودة')  !!} </button>

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


@section('JsScripts')
<script type="text/javascript">

function getTravelSection()
	{
		var travel_officeId =  $('#travel_officeId').val();
		var baseurl = document.getElementById('baseurl').value;
		$.ajax({
			url:  baseurl+'/Travel_employees/getTravelSection', 
			type: 'GET',
			data: {travel_officeId},
			success : function(data){
				console.log(data);
				$('#sectionId').empty();
				if(data == '')
				{
					var empty = "<option selected disabled>عفوا لا يوجد اقسام داخل هذا المكتب !</option>";
					$('#sectionId').html(empty);
				}
				else
				{
					$('#sectionId').append('<option>اختر القسم المناسب</option>');
					$.each(data , function(i , val)
					{
						$('#sectionId').append('<option value='+val.id+'>'+val.sectionName+'</option>')
					});
				}
				$('#sectionId').selectpicker('refresh');
			},
			error : function(e){
				console.log(e);
			}
		});
	}
</script>
@stop

@stop