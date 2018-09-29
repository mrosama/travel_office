@extends ('admin.layouts.master')
@section('content')

<!-- END PAGE HEADER-->

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/meetings">الاجتماعات</a>
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
					<span class="caption-subject font-green bold uppercase"> 
						ارسال بريد الكتروني لمجموعة من الموظفين
					</span>
				</div>

			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				{!!Form::open(array('route' => 'employees.send.emails','method'=>'post','class'=>'form-horizontal'))!!}
				<div class="form-body">

					@if(Session::has('global_s'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('global_s')}}
					</div>
					@endif

					@if(Session::has('global_r'))
					<div class="alert alert-danger" style="text-align : right;">
						<strong>خطأ ! </strong> {{Session::get('global_r')}}
					</div>
					@endif

					<div class="form-group">
						<label class="control-label col-md-3">عنوان الرسالة</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('title','',array('placeholder'=>'عنوان الرسالة' , "autofocus"=>"autofocus" ,'class'=>'form-control','maxlength'=>'50'))!!}
								<font color="red">{{$errors->first('title')}}</font>    
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3"> نص الرسالة</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<i class="fa"></i>
								{{Form::textarea('message' , '' , ['placeholder' => 'نص الرسالة' , 'class' => 'form-control'])}}
								<font color="red">{{$errors->first('message')}}</font>    
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3" style="margin-top: -10px;">ارسال بريد الكترونى لجميع المزودين
						</label>
						<div class="col-md-8">
							{{Form::checkbox('all_employees' , 1)}}
						</div>
					</div>

					<div id="allEmployees">
						<div class="form-group">
							<label class="control-label col-md-3">الفرع</label>
							<div class="col-md-8">
								{{Form::select('office' , $offices , '' , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'placeholder'=>'من فضلك اختر فرع'])}}
								<font color="red">{{$errors->first('office')}}</font><br>
							</div>

							<div class="col-md-1">
								<a href="javascript:;" class="btn btn-icon-only green img-circle" id="addEmployee">
									<i class="fa fa-plus"></i>
								</a>
							</div> 
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">الموظفين</label>
							<div class="col-md-8">
								{{Form::select('employee_id[]' , [] , '' , ['class'=>'form-control select2-multiple' , 'id'=>'multiple' , 'multiple' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "data-live-search"=>"true" ])}}
								<font color="red">{{$errors->first('employee_id')}}</font><br>
							</div>
						</div>
						<div id="getNewEmplyee"></div>
					</div>


					<div class="form-actions">
						<div class="row">
							<div class="text-center">
								<button type="submit" class="btn green">ارسال</button>
								<button type="reset" class="btn default">الغاء </button>
							</div>
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
<script src="{{URL::to('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$('input[name="all_employees"]').click(function(event) {
		if($(this).is(':checked'))
			$('#allEmployees').hide();
		else
			$('#allEmployees').show();
	});
</script>
<script type="text/javascript">


	var newEmployee = '<div><div class="form-group"><label class="control-label col-md-3">الفرع</label><div class="col-md-8">{{Form::select("office" , $offices , "" , ["class"=>"form-control" , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"bs-select form-control" , "data-live-search"=>"true" , "placeholder"=>"من فضلك اختر فرع"])}}<font color="red">{{$errors->first("office")}}</font><br></div><div class="col-md-1"><a href="javascript:;" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white  tooltips removeParent"><i class="fa fa-times"></i></a></div> </div><div class="form-group"><label class="control-label col-md-3">الموظفين</label><div class="col-md-8">{{Form::select("employee_id[]" , [] , "" , ['class'=>'form-control select2-multiple' , 'id'=>"multiple" , "multiple" , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "data-live-search"=>"true" ])}}<font color="red">{{$errors->first("employee_id")}}</font><br></div></div><div><br><br>';

	$('#addEmployee').click(function(event) {
		$('#getNewEmplyee').append(newEmployee);
		$('select').selectpicker('refresh');
	});

	$(document).on('click', '.removeParent', function() {
		$(this).parent().parent().parent().remove();
	});

	$(document).on('change' , 'select[name="office"]' , function(){
		var employee = $(this).parent().parent().parent().parent().find('select[name="employee_id[]"]');
		console.log(employee);

		$.ajax({
			url: $('#base_url').val() + '/getEmployees',
			data: {id: $(this).val()},
		})
		.done(function(data) {
			employee.empty();
			if(data == 0)
			{
				employee.append("<option value=''>لا يوجد اى موظفين فى هذا الفرع</option>")
			}
			else{
				$.each(data, function(index, val) {
					employee.append("<option value='"+val.id+"'>"+val.name+"</option>");
				});
			}
			$('select').selectpicker('refresh');
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

	});
</script>
@stop
@stop