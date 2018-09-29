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
			<a href="{{URL::to('/')}}/admin/employees">الموظفين</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-pie-chart font-red"></i>
					<span class="caption-subject font-red  uppercase">عرض الموظف  <b>{{$employee->name}}</b> للشريك <b>{{$employee->partner->name}}</b></span>
				</div>
			</div>
			<div class="portlet-body">
				<div class="text-center">
					<h2>عرض بيانات الموظف <b><font color="red">{{$employee->name}}</font></b></h2>
				</div>

				<table class="table dola">
					<tr>
						<td>الشريك</td>
						<td><a href="{{URL::to('admin/partners' , $employee->partner->id)}}" target="_blank">{{$employee->partner->name}}</a></td>
					</tr>
					<tr>
						<td>اسم الموظف</td>
						<td>{{$employee->name}}</td>
					</tr>

					<tr>
						<td>الجنسية</td>
						<td>{{$employee->nationality}}</td>
					</tr>

					<tr>
						<td>الجنس</td>
						<td>
							@if($employee->gender == "m")ذكر 
							@else
							انثى
							@endif
						</td>
					</tr>

					<tr>
						<td>البريد الالكترونى</td>
						<td>{{$employee->email}}</td>
					</tr>

					<tr>
						<td>الجوال</td>
						<td>{{$employee->mobile}}</td>
					</tr>

					<tr>
						<td>الهاتف</td>
						<td>{{$employee->phone}}</td>
					</tr>

					<tr>
						<td>فاكس</td>
						<td>{{$employee->fax}}</td>
					</tr>

					<tr>
						<td>مسئول عن</td>
						<td>{{$employee->responsible_for}}</td>
					</tr>

					<tr>
						<td>سكايب</td>
						<td>{{$employee->skype}}</td>
					</tr>


				</table>
			</div>
		</div>

	</div>
</div>

@stop