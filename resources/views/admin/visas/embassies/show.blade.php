@extends('admin.layouts.master')
@section('content')

@section('CssLinks')
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

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/embassies">السفارات</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>عرض بيانات السفارة <font color="red">{{$embassy->name}}</font></h2>
				</div>

				<table class="table dola">
					<tr>
						<td>اسم السفارة</td>
						<td>{{$embassy->name}}</td>
					</tr>

					<tr>
						<td>حضور شخصى للسفارة</td>
						<td>{{$embassy->presence}}</td>
					</tr>

					<tr>
						<td>الدولة</td>
						<td>{{$embassy->getCountry->name}}</td>
					</tr>

					<tr>
						<td>المدينة</td>
						<td>{{$embassy->getCity->name}}</td>
					</tr>

					<tr>
						<td>الشارع</td>
						<td>{{$embassy->street}}</td>
					</tr>

					<tr>
						<td>الموقع الالكترونى</td>
						<td><a href="{{$embassy->site_url}}" target="_blank">{{$embassy->site_url}}</a></td>
					</tr>

					<tr>
						<td>البريد الالكترونى</td>
						<td>{{$embassy->email}}</td>
					</tr>

					<tr>
						<td>الجوال</td>
						<td>{{$embassy->mobile}}</td>
					</tr>

					<tr>
						<td>الهاتف</td>
						<td>{{$embassy->phone}}</td>
					</tr>

					<tr>
						<td>امكانية مكتب يخلص المعاملة</td>
						<td>{{$embassy->office}}</td>
					</tr>
				</table>

				<div class="text-center">
					<h2>عرض الفروع التابعة للسفارة</h2>
				</div>
				
				@if($embassy->branches->count() != 0)
				<table class="table table-hover">
					<tr>
						<th class="text-center">اسم الفرع</th>
						<th class="text-center">الدولة</th>
						<th class="text-center">المدينة</th>
						<th class="text-center">الشارع</th>
						<th class="text-center">الموقع الالكترونى</th>
						<th class="text-center">البريد الالكترونى</th>
						<th class="text-center">الجوال</th>
						<th class="text-center">الهاتف</th>
					</tr>
					@foreach($embassy->branches as $branch)
					<tr class="text-center">
						<td>{{$branch->name}}</td>
						<td>{{$branch->getCountry->name}}</td>
						<td>{{$branch->getCity->name}}</td>
						<td>{{$branch->street}}</td>
						<td><a href="{{$branch->site_url}}" target="_blank">{{$branch->site_url}}</a></td>
						<td>{{$branch->email}}</td>
						<td>{{$branch->mobile}}</td>
						<td>{{$branch->phone}}</td>
					</tr>
					@endforeach
				</table>
				@else
				<br>
				<div class="text-center">
					<h4><font color="red">لا يوجد اى حسابات بنكية لهذا الشريك</font></h4>
				</div>
				@endif
			</div>
		</div>

	</div>
</div>

@stop