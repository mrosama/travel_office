@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="">بيانات الدخول الى المواقع</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع بيانات الدخول الى المواقع </div>
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
								<th>اسم الموقع</th>
								<th>الهدف من الموقع</th>
								<th>رابط الموقع </th>
								<th>اسم المستخدم </th>
								<th>كلمة المرور </th>
								<th>الحالة</th>
								<th>ملاحظات </th>
								<th>تعديل</th>
								<th>حذف</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; ?>
							@foreach($all_loginSite as $row)
							<tr class="odd gradeX">
								<td>{{$i++}}</td>
								<td>{{$row->name}}</td>
								<td>{{$row->goal}}</td>
								<td>{{$row->link}}</td>
								<td>{{$row->username}}</td>
								<td>{{$row->password}}</td>
								<td>{{$row->type}}</td>
								<td>{{$row->notes}}</td>
								<td>
									{{Link_to_route('admin.loginSite.edit' , 'تعديل ' , $row->id)}}
								</td>
								<td>
									{{Form::open(['route'=>['admin.loginSite.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}
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