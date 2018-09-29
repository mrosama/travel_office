@extends('admin.layouts.master')
@section('content')

@section('CssLinks')
<link href="{{URL::to('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />

<style type="text/css">
	.dola td{
		text-align: center !important;
	}
	.dola td{
		width: 50%;
	}
	.table-activity td{
		width: 0;
	}
</style>
@stop
<?php $j=1 ?>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/partners">الشركاء</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>عرض البيانات الاساسية لـ <font color="red" size="6">{{$partner->name}}</font></h2>
				</div>

				<table class="table dola">

					<tr>
						<td>النوع </td>
						<td>{{$partner->type}}</td>
					</tr>

					<tr>
						<td>الاسم </td>
						<td>{{$partner->name}}</td>
					</tr>

					<tr>
						<td>الهاتف </td>
						<td>{{$partner->mobile}}</td>
					</tr>

					<tr>
						<td>الموقع الالكترونى </td>
						<td><a href="{{$partner->site_url}}" target="_blank">{{$partner->site_url}}</a></td>
					</tr>

					@foreach(json_decode($partner->email) as $email)
					@if(++$i % 2 == 1)
					<tr>
						<td>البريد الالكترونى </td>
						<td>{{$email}}</td>
					</tr>
					@else
					<tr>
						<td>الهدف منه</td>
						<td>{{$email}}</td>
					</tr>
					@endif
					@endforeach

					<tr>
						<td>الدولة </td>
						<td>{{$partner->getCountry->name}}</td>
					</tr>

					<tr>
						<td>المدينة </td>
						<td>{{$partner->getCity->name}}</td>
					</tr>

					<tr>
						<td>الشارع </td>
						<td>{{$partner->street}}</td>
					</tr>

					<tr>
						<td>صندوق البريد </td>
						<td>{{$partner->mail_box}}</td>
					</tr>

					<tr>
						<td>الفاكس </td>
						<td>{{$partner->fax}}</td>
					</tr>

					<tr>
						<td>تويتر </td>
						<td>{{$partner->twitter}}</td>
					</tr>

					<tr>
						<td>فيس بوك </td>
						<td>{{$partner->facebook}}</td>
					</tr>

					<tr>
						<td>اخرى </td>
						<td>{{$partner->other}}</td>
					</tr>

					<tr>
						<td>ملاحظات </td>
						<td>{{$partner->notes}}</td>
					</tr>

				</table>

				<div class="text-center">
					<h2>عرض البيانات البنكية</h2>
				</div>

				@if($partner->partnerBankData->count() != 0)
				<table class="table table-hover">
					<tr>
						<td>اسم البنك</td>
						<td>رقم الحساب</td>
						<td>الايبان</td>
						<td>اسم صاحب الحساب</td>
						<td>الدولة</td>
						<td>المدينة</td>
						<td>اخرى</td>
						<td>ملاحظات</td>
					</tr>
					@foreach($partner->partnerBankData as $account)
					<tr>
						<td>{{$account->bank_name}}</td>
						<td>{{$account->bank_number}}</td>
						<td>{{$account->iban}}</td>
						<td>{{$account->bank_account_owner}}</td>
						<td>{{$account->getCountry->name}}</td>
						<td>{{$account->getCity->name}}</td>
						<td>{{$account->other}}</td>
						<td>{{$account->notes}}</td>
					</tr>
					@endforeach
				</table>
				@else
				<br>
				<div class="text-center">
					<h4><font color="red">لا يوجد اى حسابات بنكية لهذا الشريك</font></h4>
				</div>
				@endif

				<div class="text-center">
					<h2>الدفع و التحويل (الفواتير)</h2>
				</div>
				@if($partner->partnerPayTransfer->count() != 0)
				<table class="table table-hover">
					<tr>
						<td>صورة الفاتورة</td>
						<td>المبلغ المطلوب</td>
						<td>المبلغ المدفوع</td>
						<td>المبلغ المتبقى</td>
						<td>الدفع من تاريخ</td>
						<td>الدفع الى تاريخ</td>
						<td>ملاحظات</td>
					</tr>
					@foreach($partner->partnerPayTransfer as $bill)
					<tr>
						<td><a href="{{URL::to($bill->bill_photo)}}" id="single_image"><img src="{{URL::to($bill->bill_photo)}}" width="50" height="50" class="img-circle"></a></td>
						<td>{{$bill->required_amount}} ر.س</td>
						<td>{{$bill->paid_amount}} ر.س</td>
						<td>{{$bill->remaining_amount}} ر.س</td>
						<td>{{$bill->pay_from_date}}</td>
						<td>{{$bill->pay_to_date}}</td>
						<td>{{$bill->notes}}</td>
					</tr>
					@endforeach
				</table>
				@else
				<br>
				<div class="text-center">
					<h4><font color="red">لا يوجد اى فواتير لهذا الشريك</font></h4>
				</div>

				@endif

				<div class="text-center">
					<h2>عرض الموظفين</h2>
				</div>

				@if($partner->employees->count() != 0)
				<table class="table table-hover">
					<tr>
						<td>اسم الموظف</td>
						<td>الجنسية</td>
						<td>الجنس</td>
						<td>البريد الالكترونى</td>
						<td>الجوال</td>
						<td>الهاتف</td>
						<td>فاكس</td>
						<td>مسئول عن</td>
						<td>سكايب</td>
					</tr>
					@foreach($partner->employees as $employee)
					<tr>
						<td>{{$employee->name}}</td>
						<td>{{$employee->nationality}}</td>
						<td>
							@if($employee->gender == "m")ذكر 
							@else
							انثى
							@endif
						</td>
						<td>{{$employee->email}}</td>
						<td>{{$employee->mobile}}</td>
						<td>{{$employee->phone}}</td>
						<td>{{$employee->fax}}</td>
						<td>{{$employee->responsible_for}}</td>
						<td>{{$employee->skype}}</td>
					</tr>
					@endforeach
				</table>
				@else
				<br>
				<div class="text-center">
					<h4><font color="red">لا يوجد اى موظفين لهذا الشريك</font></h4>
				</div>
				@endif
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