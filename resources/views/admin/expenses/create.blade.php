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
					<span class="caption-subject font-green bold uppercase">  اضافة مصروف جديد</span>
				</div>
			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				{!!Form::open(array('url' => 'admin/expenses' ,'method'=>'post','class'=>'form-horizontal' , 'files' => 'true'))!!}
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
								{!!Form::select('exchangeType_id' , $all_exchangeType , '',array('placeholder'=>'نوع الصرف', "autofocus"=>"autofocus",'class'=>'form-control' ,'id' => 'exchangeType_id'))!!}
								{!! $errors->first('exchangeType_id','<div class="alert alert-danger">:message</div>')!!}
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">تاريخ الفاتورة
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control form-control-inline date-picker"  name="income_date" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" size="16" type="text">
								{!! $errors->first('income_date','<div class="alert alert-danger">:message</div>')!!}
							</div>
						</div>
					</div>



					<div class="form-group">
						<label class="control-label col-md-3">مدة الفاتورة
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('income_period','',array('placeholder'=>'مدة الفاتورة','class'=>'form-control', "autocomplete" =>"on"  , 'id' => 'income_period'))!!}
								{!! $errors->first('income_period','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>



					<div class="form-group">
						<label class="control-label col-md-3">المبلغ المدفوع
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('amount_paid','',array('placeholder'=>'المبلغ المدفوع','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('amount_paid','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">المبلغ المتبقي
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('remaning_amount','',array('placeholder'=>'المبلغ المتبقي','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('remaning_amount','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-md-3">المبلغ الاجمالي
							<span class="required"> * </span>
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('total_amount','',array('placeholder'=>'المبلغ الاجمالي','class'=>'form-control',  "autocomplete" =>"on" ))!!}
								{!! $errors->first('total_amount','<div class="alert alert-danger">:message</div>')!!}                            
							</div>
						</div>
					</div>



					<div class="form-group">
						<label class="control-label col-md-3">ملاحظات
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

					<div class="form-group">
						<label class= "control-label col-md-3"> ارفاق صورة
							<span class="required"> * </span>
						</label>
						<div class="col-md-4"> 
							<div class="input-icon right">
								<i class="fa"></i>
								{{Form::file('attachment' , ['required'])}}
								{!! $errors->first('attachment','<div class="alert alert-danger">:message</div>')!!}     
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


@section('JsScripts')
<script type="text/javascript">
$('#exchangeType_id').on('change' , function(){
	var exchangeType_id	 = this.value;
	var baseurl			 = $('#baseurl').val();
	var dataString 		 = 'exchangeType_id=' + exchangeType_id;
	$.ajax({
		url : baseurl + '/exchangeType/getDuration',
		type : "get",
		data : dataString,
		success : function(data)
		{
			if(data)
			{
				$("#income_period").val(data.duration);
			}
		}
	}); 
});
</script>
@stop
@stop