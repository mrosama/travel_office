@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
@section('CssLinks')
<link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@stop

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/bills">الفواتير</a>
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
					<span class="caption-subject font-green bold uppercase"> اضافه فاتورة جديدة</span>
				</div>
			</div>

			<div class="portlet-body">
				
				<!-- BEGIN FORM-->
				{{Form::open(array('route' => 'admin.bills.store', 'method'=>'post' , 'files'=>'true' , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
				<div class="form-body">

					@if(Session::has('global_s'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('global_s')}}
					</div>
					@endif

					<div class="form-group">
						<center>
							<label for="inputEmail3" class="col-sm-3 control-label">صورة الفاتورة</label>
							<div class="col-md-8">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="fileinput-new thumbnail" style="width: 265px; height: 200px;">
										<img src="{{URL::to('/')}}/noimage.gif" alt="" width="265" />
									</div>
									<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 265px; max-height: 200px;">
									</div>
									<div>
										<span class="btn  btn-large btn-primary btn-file">
											<span class="fileinput-new">
												تغيير الصورة </span>
												<span class="fileinput-exists">
													تغيير </span>
													<input type="file" name="bill_photo"  class="btn btn-danger">
												</span>
												<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
													مسح </a>
												</div>
												<span style="color:red">{{$errors->first('bill_photo')}}</span>
											</div>
										</div>
									</center>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">الشريك</label>
									<div class="col-md-8">
										{{Form::select('partner_id' , $partners , '' , ["class"=>"bs-select form-control" , "data-live-search"=>"true" , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'من فضلك اختر الشريك'] , 'required')}}
										<font color="red">{{$errors->first('partner_id')}}</font><br>
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-md-3">المبلغ المطلوب</label>
									<div class="col-md-8">
										{{Form::number('required_amount' , 0 , ['class'=>'form-control' , "autocomplete" =>"on" , "autofocus"=>"autofocus"  , 'required' , 'number'])}}
										<font color="red">{{$errors->first('required_amount')}}</font><br>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">المبلغ المدفوع</label>
									<div class="col-md-8">
										{{Form::number('paid_amount' , 0 , ['class'=>'form-control' ,"autocomplete" =>"on" , 'required' , 'number'])}}
										<font color="red">{{$errors->first('paid_amount')}}</font><br>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3">المبلغ المتبقى</label>
									<div class="col-md-8">
										{{Form::number('remaining_amount' , 0 , ['class'=>'form-control' ,"autocomplete" =>"on" , 'readonly' , 'number'])}}
										<font color="red">{{$errors->first('remaining_amount')}}</font><br>
									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-md-3">الدفع من تاريخ
									</label>
									<div class="col-md-8">
										{{Form::date('pay_from_date' , '' , ["class"=>"form-control" , 'required' , 'date'])}}
									</div>
									<font color="red">{{$errors->first('pay_from_date')}}</font><br>
								</div>


								<div class="form-group">
									<label class="control-label col-md-3">الدفع الى تاريخ
									</label>
									<div class="col-md-8">
										{{Form::date('pay_to_date' , '' , ["class"=>"form-control " , 'required' , 'date'])}}

									</div>
									<font color="red">{{$errors->first('pay_to_date')}}</font><br>
								</div>


								<div class="form-group">
									<label class="control-label col-md-3">ملاحظات</label>
									<div class="col-md-8">
										{{Form::textarea('notes' , '' , ['class'=>'form-control' ,"autocomplete" =>"on" , 'required'])}}
										<font color="red">{{$errors->first('notes')}}</font><br>
									</div>
								</div>

								<div class="form-actions text-center">
									<div class="row">
										<div class="col-md-offset-2 col-md-9">
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

				@section('JsScripts')
				<script src="{{URL::to('/')}}/assets/form-validation.js" type="text/javascript"></script>
				<script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

				<script type="text/javascript">

					$('input[name="remaining_amount"]').click(function(event) {
						calculation($(this));
					});

					$('input[name="required_amount"]').keyup(function(event) {
						calculation($('input[name="remaining_amount"]'));
					});

					$('input[name="paid_amount"]').keyup(function(event) {
						calculation($('input[name="remaining_amount"]'));
					});

					function calculation(data)
					{
						var required_amount = $('input[name="required_amount"]').val();
						var paid_amount = $('input[name="paid_amount"]').val();
						data.val(parseInt(required_amount) - parseInt(paid_amount) );
					}

					$('.btn-icon-only').click(function(event) {
						$('#addMoreEmail').append('<div class="form-group"><label class="control-label col-md-3">البريد الالكترونى / الهدف منه</label><div class="col-md-4"><input type="email" value="" class="form-control" placeholder="البريد الالكترونى" name="email[]"></div><div class="col-md-4"><input type="text" value="" class="form-control" placeholder="الهدف منه" name="email[]"></div><a href="javascript:;" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white  tooltips removeParent"><i class="fa fa-times"></i></a></div>');
					});

					$(document).on('click', '.removeParent', function() {
						console.log($(this).parent().remove());
					});
					
				</script>
				@stop

				@stop