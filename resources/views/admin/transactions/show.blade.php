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
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/transactions">المعاملات</a>
		</li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>
						عرض بيانات المعاملة
						
					</div>

					<table class="table dola">

						<tr>
							<td>نوع المعاملة</td>
							<td>{{$transaction->transactionType->name}}</td>
						</tr>

						<tr>
							<td>الجهة</td>
							<td>{{$transaction->site}}</td>
						</tr>

						<tr>
							<td>الاوراق المطلوبة</td>
							<td>{{$transaction->paper_work}}</td>
						</tr>

						<tr>
							<td>نموذج</td>
							<td>
								@if($transaction->form != null)
								<a href="{{URL::to($transaction->form)}}">تحميل</a>
								@else
								<del>لا يوجد</del>
								@endif
							</td>
						</tr>

						<tr>
							<td>الموقع الالكترونى</td>
							<td>{{$transaction->website}}</td>
						</tr>

						<tr>
							<td>الدولة</td>
							<td>{{$transaction->getCountry->name}}</td>
						</tr>

						<tr>
							<td>المدينة</td>
							<td>{{$transaction->getCity->name}}</td>
						</tr>

						<tr>
							<td>البريد الالكترونى</td>
							<td>{{$transaction->email}}</td>
						</tr>

						<tr>
							<td>الموبايل</td>
							<td>{{$transaction->mobile}}</td>
						</tr>

					</table>
				</div>
			</div>

		</div>
	</div>

	@stop