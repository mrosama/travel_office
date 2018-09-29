@extends('admin.layouts.master')
@section('content')

@section('CssLinks')
<link href="{{URL::to('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />

<style type="text/css">
	.dola td{
		text-align: center !important;
	}
	td{
		width: 50%;
	}
</style>
@stop

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/drivers">السائقين</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>
						عرض بيانات السائق <font color="red" size="6">{{$driver->name}}</font>
						
					</div>

					<table class="table dola">
						<tr>
							<td>صورة الباص</td>
							<td><a href="{{URL::to($driver->photo)}}" id="single_image">{{HTML::image($driver->photo , '' , ['width'=>100 , 'height'=>100 , 'class'=>'img-circle' ])}}</a></td>
						</tr>

						<tr>
							<td>مزود الباص</td>
							<td><a target="_blank" href="{{URL::to("/admin/busses/suppliers" , $driver->supplier->id)}}">{{$driver->supplier->name}}</a></td>
						</tr>

						<tr>
							<td>اسم السائق</td>
							<td>{{$driver->name}}</td>
						</tr>

						<tr>
							<td>تاريخ الميلاد</td>
							<td>{{$driver->age}}</td>
						</tr>

						<tr>
							<td>الجنسية</td>
							<td>{{$driver->nationality}}</td>
						</tr>

						<tr>
							<td>الجوال</td>
							<td>{{$driver->mobile}}</td>
						</tr>
						<tr>
							<td>الدولة</td>
							<td>{{$driver->getCountry->name}}</td>
						</tr>

						<tr>
							<td>المدينة</td>
							<td>{{$driver->getCity->name}}</td>
						</tr>

						<tr>
							<td>السجل المدنى/الاقامة</td>
							<td>{{$driver->card_number}}</td>
						</tr>
						<tr>
							<td>رقم الرخصة</td>
							<td>{{$driver->licence}}</td>
						</tr>
						<tr>
							<td>صورة الرخصة</td>
							<td><a href="{{URL::to($driver->licence_img)}}" id="single_image">{{HTML::image($driver->licence_img , '' , ['width'=>100 , 'height'=>100 , 'class'=>'img-circle' ])}}</a></td>
						</tr>
						<tr>
							<td>ملاحظات</td>
							<td>{{$driver->notes}}</td>
						</tr>
					</table>
				</div>
			</div>

		</div>
	</div>

	@section('JsScripts')
	<script src="{{URL::to('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$("a#single_image").fancybox();
		});
	</script>
	@stop

	@stop