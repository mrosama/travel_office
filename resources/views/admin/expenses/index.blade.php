@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/Expenses">المصروفات</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع المصروفات </div>
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
								<th>نوع الصرف</th>
								<th>تاريخ الفاتورة</th>
								<th>مدة الفاتورة</th>
								<th>المبلغ المدفوع</th>
								<th>المبلغ المتبقي</th>
								<th>المبلغ الاجمالي</th>
								<th>ملاحظات</th>
								<th>الصورة</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($all_expenses as $row)
							<tr class="odd gradeX">
								<td>{{$row->id}}</td>
								<td>{{$row->getExchangeType->type}}</td>
								<td>{{$row->income_date}}</td>
								<td>{{$row->income_period}}</td>
								<td>{{$row->amount_paid}}</td>
								<td>{{$row->remaning_amount}}</td>
								<td>{{$row->total_amount}}</td>
								<td>{{$row->notes}}</td>
								<td>{{HTML::image($row->attachment , '' , ['style' => 'width:100px;'])}}</td>
								<td style="display:flex">
									{{Link_to_route('admin.expenses.edit' , 'تعديل ' , $row->id)}}&nbsp; 
									|&nbsp; {{Form::open(['route'=>['admin.expenses.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}
									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $(this).closest('form').submit();"> حذف</a>
									{{Form::close()}}
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
	@stop
