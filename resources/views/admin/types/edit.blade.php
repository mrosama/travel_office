@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/type">الدول</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<span><a href="{{URL::to('/')}}/admin/type/{{$type->id}}/edit">تعديل بيانات نوع العمل</a></span>
		</li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i>تعديل بيانات نوع <b>{{$type->name}}</b> </div>
					<div class="tools">
						<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
						<a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
						<a href="javascript:;" class="reload" data-original-title="" title=""> </a>
						<a href="javascript:;" class="remove" data-original-title="" title=""> </a>
					</div>
				</div>
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					{{Form::open(['route'=>['admin.types.update' , $type->id] , 'method'=>'put' , 'class'=>'form-horizontal'])}}


					<div class="form-body">
						
						@if (Session::has('success')) 
						<div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
						@endif

						<div class="form-group">
							<label class="control-label col-md-2">اسم النوع</label>
							<div class="col-md-10">
							{{Form::text('name' , $type->name , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" ])}}
								<font color="red">{{$errors->first('name')}}</font><br>
							</div>
						</div>

					

					</div>
					<div class="form-actions">
						<div class="row">
							<div class="text-center">
								<button type="submit" class="btn green">
									<i class="fa fa-pencil"></i> تعديل البيانات</button>
									<button type="reset" class="btn default">مسح</button>
								</div>
							</div>
						</div>
					</form>
					<!-- END FORM-->
				</div>
			</div>
		</div>
	</div>

	@stop