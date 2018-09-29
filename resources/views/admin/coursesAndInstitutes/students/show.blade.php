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
			<a href="{{URL::to('/')}}/admin/institute">المعاهد والجامعات</a>
		</li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>
						عرض بيانات الطالب <font color="red" size="6">{{$data['student']->name}}</font> الملتحق بمعهد <font color="red" size="6">{{$data['institute']->name}}</font>
						
					</div>

					<table class="table dola">
						<tr>
							<td>صورة الطالب</td>
							<td><a href="{{URL::to($data['student']->photo)}}" id="single_image"><img src="{{URL::to($data['student']->photo)}}" width="100" height="100" class="img-circle"></a></td>
						</tr>
						<tr>
							<td>اسم الطالب</td>
							<td>{{$data['student']->name}}</td>
						</tr>
						<tr>
							<td>ملتحق بمعهد</td>
							<td>{{$data['institute']->name}}</td>
						</tr>
						<tr>
							<td>الدولة</td>
							<td>{{$data['student']->getCountry->name}}</td>
						</tr>
						<tr>
							<td>المدينة</td>
							<td>{{$data['student']->getCity->name}}</td>
						</tr>
						<tr>
							<td>تاريخ الميلاد</td>
							<td>{{$data['student']->birth_date}}</td>
						</tr>
						<tr>
							<td>الجنسية</td>
							<td>{{$data['student']->nationality}}</td>	
						</tr>
						<tr>
							<td>البريد الالكترونى</td>
							<td>{{$data['student']->email}}</td>				
						</tr>
						<tr>
							<td>الجوال</td>
							<td>{{$data['student']->mobile}}</td>					
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