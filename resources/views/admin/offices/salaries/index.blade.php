
@extends('admin.layouts.master')
@section('content')

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

		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع الرواتب</div>
					<div class="tools"> </div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover" id="sample_2">
						@if (Session::has('success')) 
						<div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
						@endif
						<thead>
							<tr>
								<th>#</th>
								<th>اسم الموظف</th>
								<th>الراتب الاساسى</th>
								<th>بدل مواصلات</th>
								<th>بدل سكن</th>
								<th>عدد الساعات الاضافية</th>
								<th>عدد الايام الاضافية</th>
								<th>بدل عيد</th>
								<th>بدلات اخرى</th>
								<th>المبلغ المخصوم</th>
								<th>تعديل </th>
								<th>حذف</th>
								<th>عرض</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; ?>
							@foreach($salaries as $salary)
							<tr class="odd gradeX text-center">
								<td>{{$i}}</td>
								<td>{{$salary->employee->name}} ريال</td>
								<td>{{$salary->basic_salary}} ريال</td>
								<td>{{$salary->transportation_allowance}} ريال</td>
								<td>{{$salary->house_allowance}} ريال</td>
								<td>{{$salary->number_extra_hours}}</td>
								<td>{{$salary->number_extra_days}}</td>
								<td>{{$salary->holiday_allowance}} ريال</td>
								<td>{{$salary->nother_allowances}} ريال</td>
								<td>{{$salary->amount_deducted}} ريال</td>
								<td>
									<a href="{{URL::to('/admin/salaries' , [$salary->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
								</td>

								<td>
									{{Form::open(['route'=>['admin.salaries.destroy' , $salary->id] , 'method'=>'delete' , 'id'=>'form'])}}
									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
									{{Form::close()}}
								</td>
								<td><a href="{{URL::to('/admin/salaries' , $salary->id)}}"><i class="fa fa-eye"></i></a>
								</td>
							</tr>
							<?php $i++; ?>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>

	@stop