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
			<a href="{{URL::to('/')}}/admin/salaries">الرواتب</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>
					عرض راتب الموظف <font color="red" size="6">{{$salary->employee->name}}</font>
					</h2>
				</div>

				<table class="table dola">
					<tr>
						<td>اسم الموظف</td>
						<td>{{$salary->employee->name}}</td>
					</tr>
					<tr>
						<td>الراتب الاساسى</td>
						<td>{{$salary->basic_salary}}</td>
					</tr>
					<tr>
						<td>بدل مواصلات</td>
						<td>{{$salary->transportation_allowance}}</td>
					</tr>
					<tr>
						<td>بدل سكن</td>
						<td>{{$salary->house_allowance}}</td>
					</tr>
					<tr>
						<td>عدد الساعات الاضافية</td>
						<td>{{$salary->number_extra_hours}}</td>
					</tr>
					<tr>
						<td>عدد الايام الاضافية</td>
						<td>{{$salary->number_extra_days}}</td>
					</tr>
					<tr>
						<td>بدل عيد</td>
						<td>{{$salary->holiday_allowance}}</td>
					</tr>
					<tr>
						<td>بدلات اخرى</td>
						<td>{{$salary->other_allowances}}</td>
					</tr>
					<tr>
						<td>المبلغ المخصوم</td>
						<td>{{$salary->amount_deducted}}</td>
					</tr>
					<tr>
						<td>سبب الخصم</td>
						<td>{{$salary->discount_reason}}</td>
					</tr>
					<tr>
						<td>ملاحظات</td>
						<td>{{$salary->notes}}</td>
					</tr>

				</table>
			</div>
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