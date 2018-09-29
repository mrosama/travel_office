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
			<a href="{{URL::to('/')}}/admin/bills">الفواتير</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-pie-chart font-red"></i>
					<span class="caption-subject font-red  uppercase">عرض فاتورة الشريك <b>{{$bill->partner->name}}</b></span>
				</div>
			</div>
			<div class="portlet-body">

				<div class="text-center">
					<h2>
						يوم الدفع
						<?php 
						$date1 = new DateTime(Date('Ymd'));
						$date2 = new DateTime($bill->pay_to_date);
						$interval = $date1->diff($date2);

						if($interval->format('%r') == '-')
							echo("<del style='color:red'>منذ ".$interval->format('%d يوم %m شهر %y سنة')."</del>");
						elseif($interval->format('%d') == 0)
							echo "<font color='red'>اليوم</font>";
						else
							echo("<font color='green'>باقى ".$interval->format('%r %d يوم %m شهر %y سنة')."</font>");
						?></h2>
					</div>

					<table class="table dola">
						<tr>
							<td>صورة الفاتورة</td>
							<td><a href="{{URL::to($bill->bill_photo)}}" id="single_image"><img src="{{URL::to($bill->bill_photo)}}" width="100" height="100" class="img-circle"></a></td>
						</tr>
						<tr>
							<td>المبلغ المطلوب</td>
							<td>{{$bill->required_amount}}  ر.س</td>
						</tr>
						<tr>
							<td>المبلغ المدفوع</td>
							<td>{{$bill->paid_amount}}  ر.س</td>
						</tr>
						<tr>
							<td>المبلغ المتبقى</td>
							<td>{{$bill->remaining_amount}}  ر.س</td>
						</tr>
						<tr>
							<td>الدفع من تاريخ</td>
							<td>{{$bill->pay_from_date}}  ر.س</td>
						</tr>
						<tr>
							<td>الدفع الى تاريخ</td>
							<td>{{$bill->pay_to_date}}</td>
						</tr>
						<tr>
							<td>ملاحظات</td>
							<td>{{$bill->notes}}</td>
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