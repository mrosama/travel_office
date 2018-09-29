@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/institute">المعاهد والجامعات</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع المعاهد والجامعات </div>
					<div class="tools"> </div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover" id="sample_2">
						@if (Session::has('success')) 
						<div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
						@endif
						<thead>
							<tr class="text-center">
								<th>#</th>
								<th>اسم المعهد/الجامعة</th>
								<th>الدولة</th>
								<th>المدينة</th>
								<th>رقم الهاتف </th>
								<th>رقم الجوال </th>
								<th>الموقع الالكتروني </th>
								<th>صندوق البريد </th>
								<th>العنوان </th>
								<th> اضافة طالب </th>
								<th class="text-center">عرض الطلاب</th>
								<th class="text-center">تعديل</th>
								<th class="text-center">حذف</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; ?>
							@foreach($all_institute as $institute)
							<tr class="odd gradeX">
								<td class="text-center">{{$i++}}</td>
								<td class="text-center">{{$institute->name}}</td>
								<td class="text-center">{{$institute->getCountry->name}}</td>
								<td class="text-center">{{$institute->getCity->name}}</td>
								<td class="text-center">{{$institute->phone}}</td>
								<td class="text-center">{{$institute->mobile}}</td>
								<td class="text-center">{{$institute->web_site}}</td>
								<td class="text-center">{{$institute->postal_code}}</td>
								<td class="text-center">{{$institute->address}}</td>
								<td class="text-center">
									<a href="{{URL::to('admin/institutes' , [$institute->id , 'students' , 'create'])}}"><i class="fa fa-male" aria-hidden="true"></i></a>
								</td>
								<td class="text-center"><a href="{{URL::to('/admin/institutes' , [$institute->id , 'students' , 'get'])}}"><i class="fa fa-eye"></i></a>
								</td>
								<td class="text-center">
									<a href="{{URL::to('/admin/students' , [$institute->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
								</td>
								<td class="text-center">
									{{Form::open(['route'=>['admin.institutes.destroy' , $institute->id] , 'method'=>'delete' , 'id'=>'form'])}}

									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
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