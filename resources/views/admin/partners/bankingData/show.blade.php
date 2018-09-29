@extends('admin.layouts.master')
@section('content')

@section('CssLinks')

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
			<a href="{{URL::to('/')}}/admin/banking/accounts">الحسابات البنكية</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-pie-chart font-red"></i>
					<span class="caption-subject font-red  uppercase">عرض الحسابات البنكية للشريك <b>{{$account->partner->name}}</b></span>
				</div>
			</div>
			<div class="portlet-body">
					<table class="table dola">
						<tr>
							<td>الشريك</td>
							<td><a href="{{URL::to('admin/partners' , $account->partner->id)}}" target="_blank">{{$account->partner->name}}</a></td>
						</tr>
						<tr>
							<td>اسم البنك</td>
							<td>{{$account->bank_name}}</td>
						</tr>
						<tr>
							<td>الايبان</td>
							<td>{{$account->iban}}</td>
						</tr>
						<tr>
							<td>رقم الحساب</td>
							<td>{{$account->bank_number}}</td>
						</tr>
						<tr>
							<td>اسم صاحب الحساب</td>
							<td>{{$account->bank_account_owner}}</td>
						</tr>
						<tr>
							<td>الدولة</td>
							<td>{{$account->getCountry->name}}</td>
						</tr>
						<tr>
							<td>المدينة</td>
							<td>{{$account->getCity->name}}</td>
						</tr>

					</table>
				</div>
			</div>

		</div>
	</div>

	@stop