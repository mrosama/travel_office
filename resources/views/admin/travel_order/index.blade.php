@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/companyOrder">طلبات موظفين المكاتب السياحية والدينية</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع طلبات موظفين  المكاتب السياحية والدينية </div>
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
								<th>اسم المكتب </th>
								<th>اسم القسم</th>
								<th>نوع الطلب</th>
								<th>تاريخ الاقلاع</th>
								<th>تاريخ العودة</th>
								<th>عدد الايام</th>
								<th>تاريخ الطلب</th>
								<th>المسافرين</th>
								<th>خيارات</th>
							</tr>
						</thead>
						<tbody>
							@foreach($all_travelOrder as $row)
							<tr class="odd gradeX">
								<td>{{$row->id}}</td>
								<td>{{$row->officeName->name}}</td>
								<td>{{$row->sectionName->sectionName}}</td>
								<td>{{$row->orderType->type}}</td>
								<td>{{$row->date_takeoff }}</td>
								<td>{{$row->date_arrival}}</td>
								<td>{{$row->dayNumbers}}</td>
								<td>{{$row->created_at}}</td>
								<td><a class="btn green btn-outline sbold" data-toggle="modal" href="#basic"> عرض  </a></td>
								<td style="display:flex">
									{{Link_to_route('admin.travel_orders.edit' , 'تعديل ' , $row->id)}}
									&nbsp; |&nbsp; 
									{{Form::open(['route'=>['admin.travel_orders.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}
									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $('form').submit();"> حذف</a>
									{{Form::close()}}
								</td>
							</tr>
							<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">اسماء المسافرين</h4>
										</div>
										<div class="modal-body"> 
											<?php
											$data =json_decode($row->empId);
											for ($i=0; $i < count($data) ; $i++) { 
												$empId = $data[$i];
												$result = DB::table('travel_employees')->where('id', $empId)->select('empName')->first();
												echo '# ' . $result->empName . '<br><br>';
											}
											?>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
										</div>
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
	@stop