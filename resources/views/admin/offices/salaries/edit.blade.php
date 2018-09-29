@extends ('admin.layouts.master')
@section('content')

<!-- END PAGE HEADER-->

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/salaries">الرواتب</a>
		</li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light portlet-fit portlet-form ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bubble font-green"></i>
					<span class="caption-subject font-green bold uppercase">تعديل  راتب</span>
				</div>

			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				{!!Form::open(array('route' => ['admin.salaries.update' , $salary->id] ,'method'=>'put','class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))!!}
				<div class="form-body">
					@if(Session::has('success'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('success')}}
					</div>
					@endif

					<div class="form-group">
						<label class="control-label col-md-3">اسم الموظف
						</label>
						<div class="col-md-8">
							{{Form::select('employee_id', $employees , $salary->employee_id ,array('placeholder'=>'من فضلك اختر الموظف',
							'class'=>"bs-select form-control" , "data-live-search"=>"true" , 'required'))}}
							<font color="red">{{$errors->first('employee_id')}}</font>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">الراتب الاساسى
						</label>
						<div class="col-md-2">
							{!!Form::number('basic_salary',$salary->basic_salary,array('placeholder'=>'الراتب الاساسى',
							'class'=>'form-control',"autocomplete" =>"on"   , "autofocus"=>"autofocus" , 'required' , 'number'))!!}
							<font color="red">{{$errors->first('basic_salary')}}</font>
						</div>

						<label class="control-label col-md-2">بدل مواصلات
						</label>
						<div class="col-md-2">
							{!!Form::number('transportation_allowance',$salary->transportation_allowance,array('placeholder'=>'بدل مواصلات',
							'class'=>'form-control',"autocomplete" =>"on"   , "autofocus"=>"autofocus"  , 'number'))!!}
							<font color="red">{{$errors->first('transportation_allowance')}}</font>
						</div>

						<label class="control-label col-md-2">بدل سكن
						</label>
						<div class="col-md-2">
							{!!Form::number('house_allowance',$salary->house_allowance,array('placeholder'=>'بدل سكن',
							'class'=>'form-control',"autocomplete" =>"on"   , "autofocus"=>"autofocus"  , 'number'))!!}
							<font color="red">{{$errors->first('house_allowance')}}</font>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">عدد الساعات الاضافية
						</label>
						<div class="col-md-2">
							{!!Form::number('number_extra_hours',$salary->number_extra_hours,array('placeholder'=>'عدد الساعات الاضافية',
							'class'=>'form-control',"autocomplete" =>"on"   , "autofocus"=>"autofocus"  , 'number'))!!}
							<font color="red">{{$errors->first('number_extra_hours')}}</font>
						</div>

						<label class="control-label col-md-2">عدد الايام الاضافية
						</label>
						<div class="col-md-2">
							{!!Form::number('number_extra_days',$salary->number_extra_days,array('placeholder'=>'عدد الايام الاضافية',
							'class'=>'form-control',"autocomplete" =>"on"   , "autofocus"=>"autofocus"  , 'number'))!!}
							<font color="red">{{$errors->first('number_extra_days')}}</font>
						</div>

						<label class="control-label col-md-2">بدل عيد
						</label>
						<div class="col-md-2">
							{!!Form::number('holiday_allowance',$salary->holiday_allowance,array('placeholder'=>'بدل عيد','class'=>'form-control',  "autocomplete" =>"on" , 'number'))!!}
							<font color="red">{{$errors->first('noholiday_allowance')}}</font>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">بدلات اخرى
						</label>
						<div class="col-md-3">
							{!!Form::number('other_allowances',$salary->other_allowances,array('placeholder'=>'بدلات اخرى','class'=>'form-control',  "autocomplete" =>"on" , 'number'))!!}
							<font color="red">{{$errors->first('nother_allowances')}}</font>
						</div>

						<label class="control-label col-md-2">المبلغ المخصوم
						</label>
						<div class="col-md-3">
							{!!Form::number('amount_deducted',$salary->amount_deducted,array('placeholder'=>'المبلغ المخصوم','class'=>'form-control',  "autocomplete" =>"on" , 'number'))!!}
							<font color="red">{{$errors->first('amount_deducted')}}</font>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">سبب الخصم
						</label>
						<div class="col-md-8">
							{!!Form::textarea('discount_reason',$salary->discount_reason,array('placeholder'=>'ملاحظات','class'=>'form-control',  "autocomplete" =>"on" ))!!}
							<font color="red">{{$errors->first('discount_reason')}}</font>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">ملاحظات
						</label>
						<div class="col-md-8">
							{!!Form::textarea('notes',$salary->notes,array('placeholder'=>'ملاحظات','class'=>'form-control',  "autocomplete" =>"on" ))!!}
							<font color="red">{{$errors->first('notes')}}</font>
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

				</form>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END VALIDATION STATES-->
	</div>
</div>



@stop