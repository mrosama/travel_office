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
			<a href="{{URL::to('/')}}/admin/embassy/branches">الفروع</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>عرض بيانات الفرع <font color="red">{{$branch->name}}</font> التابع للسفارة <font color="red">{{$branch->embassy->name}}</font></h2>
				</div>

				<table class="table dola">
					<tr>
						<td>اسم السفارة التابع لها</td>
						<td><a href="{{URL::to('admin/embassies' , $branch->embassy->id)}}" target="_blank">{{$branch->embassy->name}}</a></td>
					</tr>

					<tr>
						<td>اسم الفرع</td>
						<td>{{$branch->name}}</td>
					</tr>

					<tr>
						<td>الدولة</td>
						<td>{{$branch->getCountry->name}}</td>
					</tr>

					<tr>
						<td>المدينة</td>
						<td>{{$branch->getCity->name}}</td>
					</tr>

					<tr>
						<td>الشارع</td>
						<td>{{$branch->street}}</td>
					</tr>

					<tr>
						<td>الموقع الالكترونى</td>
						<td><a href="{{$branch->site_url}}" target="_blank">{{$branch->site_url}}</a></td>
					</tr>

					<tr>
						<td>البريد الالكترونى</td>
						<td>{{$branch->email}}</td>
					</tr>

					<tr>
						<td>الجوال</td>
						<td>{{$branch->mobile}}</td>
					</tr>

					<tr>
						<td>الهاتف</td>
						<td>{{$branch->phone}}</td>
					</tr>

				</table>
			</div>
		</div>

	</div>
</div>

@stop