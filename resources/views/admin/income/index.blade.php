@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/income">الايرادات</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع الايرادات </div>
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
								<th>نوع الايراد</th>
								<th>اسم الموظف</th>
								<th>المبلغ المستلم</th>
								<th>اسم البنك</th>
								<th>نوع الاستلام </th>
								<th>صورة الاستلام </th>
								<th>تاريخ الاستلام </th>
								<th>اجمالي الاستلام اليومي </th>
								<th>عدد مرات الاستلام اليومي </th>
								<th>مصدر المبلغ </th>
								<th>ملاحظات </th>
								<th>الاجمالي </th>
								<th> </th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; ?>
							@foreach($all_incomes as $row)
							<tr class="odd gradeX">
								<td>{{$i++}}</td>
								<td>{{$row->incometype->type}}</td>
								<td>{{$row->getEmployeeName->name}}</td>
								<td>{{$row->receipt}}</td>
								<td>{{$row->bank}}</td>
								<td>{{$row->receipt_type}}</td>
								<td>{{HTML::image($row->receipt_photo , '',['width' => '75px'])}}</td>
								<td>{{$row->receipt_date}}</td>
								<td>{{$row->receipt_daily_total}}</td>
								<td>{{$row->receipt_daily_number}}</td>
								<td>{{$row->money_source}}</td>
								<td>{{$row->notes}}</td>
								<td>{{$row->total}}</td>
								<td>
									{{Link_to_route('admin.income.edit' , 'تعديل ' , $row->id)}}
									&nbsp; |&nbsp; 
									{{Form::open(['route'=>['admin.income.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}
									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $(this).closest('form').submit();"> حذف</a>
									{{Form::close()}}
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