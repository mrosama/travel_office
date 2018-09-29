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
			<a href="{{URL::to('/')}}/admin/courses">الدورات</a>
		</li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>
						عرض بيانات الدورة <font color="red" size="6">{{$course->name}}</font>
						
					</div>

					<table class="table dola">
						<tr>
							<td>اسم الدورة</td>
							<td>{{$course->name}}</td>
						</tr>
						<tr>
							<td>الدولة</td>
							<td>{{$course->getCountry->name}}</td>
						</tr>
						<tr>
							<td>المدينة</td>
							<td>{{$course->getCity->name}}</td>
						</tr>
						<tr>
							<td>نوع الدورة</td>
							<td>{{$course->type}}</td>
						</tr>
						<tr>
							<td>مدة الدورة باﻷيام</td>
							<td>{{$course->duration_in_days}}</td>
						</tr>
						<tr>
							<td>مدة الدورة بالاسابيع</td>
							<td>{{$course->duration_in_weeks}}</td>
						</tr>
						<tr>
							<td>مدة الدورة بالشهور</td>
							<td>{{$course->duration_in_month}}</td>
						</tr>
						<tr>
							<td>تاريخ البداية</td>
							<td>{{$course->start_date}}</td>
						</tr>
						<tr>
							<td>تاريخ النهاية</td>
							<td>{{$course->end_date}}</td>
						</tr>

						<tr>
							<td>مستوى الدورة</td>
							<td>
								@if($course->level == "b")
								مبتدء
								@elseif($course->level == "m")
								متوسط
								@elseif($course->level == "a")
								متقدم
								@endif
							</td>
						</tr>
						<tr>
							<td>لغة الدورة</td>
							<td>
								@if($course->language == "a")
								عربى
								@elseif($course->level == "e")
								انجليزى
								@endif
							</td>
						</tr>
						<tr>
							<td>عدد الساعات اليومية</td>
							<td>{{$course->dayly_hours}}</td>
						</tr>
						<tr>
							<td>اجمالى الساعات</td>
							<td>{{$course->total_hours}}</td>
						</tr>
						<tr>
							<td>سعر الدورة</td>
							<td>{{$course->price}}</td>
						</tr>
						<tr>
							<td>صورة اعلان الدورة</td>
							<td><a href="{{URL::to($course->advertisment_photo)}}" id="single_image"><img src="{{URL::to($course->advertisment_photo)}}" width="100" height="100" class="img-circle"></a></td>
						</tr>
						<tr>
							<td>تاريخ اعلان الدورة</td>
							<td>{{$course->advertisment_date}}</td>
						</tr>
						<tr>
							<td>مدة الاعلان</td>
							<td>{{$course->advertisment_duration}}</td>

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