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
					<span class="caption-subject font-green bold uppercase"> 
						ارسال رسالة نصية للعميل  - {{$client->username}}
					</span>
				</div>

			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				{!!Form::open(array('route' => 'admin.client.do_send_sms','method'=>'post','class'=>'form-horizontal'))!!}
				<div class="form-body">
					@if(Session::has('success'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('success')}}
					</div>
					@endif
					@if(Session::has('error'))
					<div class="alert alert-danger" style="text-align : right;">
						<strong>خطأ ! </strong> {{Session::get('error')}}
					</div>
					@endif

					<div class="form-group">
						<label class="control-label col-md-3">الرصيد المتبقى من الرسائل 
						</label>
						<div class="col-md-8">
							{{$sms_balance}} نقطة
						</div>
					</div>

					<hr>

					<!-- User id -->
					<input type="hidden" value="{{$client->id}}" type="text" name="userid">

					<div class="form-group">
						<label class="control-label col-md-3">رقم الموبايل
						</label>
						<div class="col-md-4">
							<div class="input-icon right">
								<i class="fa"></i>
								{!!Form::text('number', $mobile_numer ,array('placeholder'=>'عنوان الرسالة','class'=>'form-control','readonly'))!!}
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3"> نص الرسالة
							<span class="required">*</span></label>
							<div class="col-md-4">
								<div class="input-icon right">
									<i class="fa"></i>
									{{Form::textarea('msg' , '' , ['placeholder' => 'نص الرسالة', "autofocus"=>"autofocus" , 'class' => 'form-control'])}}
									{!! $errors->first('msg','<div class="alert alert-danger">:message</div>')!!}    
								</div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn green">ارسال</button>
									<a href="{{URL::route('admin.clients.index')}}" class="btn red"> عودة لقائمة العملاء</a>
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
@stop