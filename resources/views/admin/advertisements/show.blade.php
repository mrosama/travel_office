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
			<a href="{{URL::to('/')}}/admin/advertisements">الاعلانات و البنرات</a>
		</li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>
						عرض بيانات الاعلان <font color="red">{{$advertisement->title}}</font>
					</div>

					<table class="table dola">

						<tr>
							<td>عنوان الاعلان</td>
							<td>{{$advertisement->title}}</td>
						</tr>

						
						<tr>
							<td>اسم مصصم الاعلان</td>
							<td>{{$advertisement->designer_name}}</td>
						</tr>

						
						<tr>
							<td>الجوال</td>
							<td>{{$advertisement->mobile}}</td>
						</tr>

						
						<tr>
							<td>الهاتف</td>
							<td>{{$advertisement->phone}}</td>
						</tr>

						
						<tr>
							<td>البريد الالكترونى</td>
							<td>{{$advertisement->email}}</td>
						</tr>

						
						<tr>
							<td>بداية الاعلان</td>
							<td>{{$advertisement->start}}</td>
						</tr>

						
						<tr>
							<td>نهاية الاعلان</td>
							<td>{{$advertisement->end}}</td>
						</tr>

						
						<tr>
							<td>عدد ايام الاعلان</td>
							<td>{{$advertisement->duration}}</td>
						</tr>
						
						<tr>
							<td>الدولة</td>
							<td>{{$advertisement->getCountry->name}}</td>
						</tr>

						<tr>
							<td>المدينة</td>
							<td>{{$advertisement->getCity->name}}</td>
						</tr>

						<tr>
							<td>الاعلان</td>
							<td>
								@if($advertisement->file != null)
								<a href="{{URL::to($advertisement->file)}}">تحميل</a>
								@else
								<del>لا يوجد</del>
								@endif
							</td>
						</tr>

						<tr>
							<td>ملاحظات</td>
							<td>{{$advertisement->getCountry->name}}</td>
						</tr>
					</table>
				</div>
			</div>

		</div>
	</div>

	@stop