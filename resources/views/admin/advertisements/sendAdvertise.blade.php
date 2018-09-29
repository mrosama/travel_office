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
						ارسال بريد الكتروني ورسالة داخلية لمجموعة من العملاء
					</span>
				</div>

			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				{{Form::open(['route'=>['send.advertise' , $id],'method'=>'post','class'=>'form-horizontal'])}}
				<div class="form-body">

					@if(Session::has('global_s'))
					<div class="alert alert-success" style="text-align:right;">
						{{Session::get('global_s')}}
					</div>
					@endif

					@if(Session::has('global_r'))
					<div class="alert alert-danger" style="text-align:right;">
						<b>خطأ!! </b>{{Session::get('global_r')}}
					</div>
					@endif

					<div class="form-group">
						<label class="control-label col-md-3" style="margin-top: -9px;">ارسال الاعلان لجميع العملاء</label>
						<div class="col-md-8">
							{{Form::checkbox('all_clients' , '1' )}}
							<font color="red">{{$errors->first('all_clients')}}</font><br>
						</div>
					</div>

					<div class="form-group" id="selectClients">
						<label class="control-label col-md-3">اختر مجموعة العملاء</label>
						<div class="col-md-8">
							{{Form::select('clients[]' , $clients , '' , ['class'=>'form-control select2-multiple' , 'id'=>'multiple' , 'multiple'])}}
							{!! $errors->first('clients','<div class="alert alert-danger">:message</div>')!!}    
						</div>
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
	$('input[name="all_clients"]').click(function(event) {
		if(this.checked)
			$('#selectClients').hide();
		else
			$('#selectClients').show();

	});
</script>
@stop
@stop