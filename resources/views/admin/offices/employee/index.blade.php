
@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/employee">الموظفين</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع الموظفين </div>
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
								<th>الصورة الشخصية</th>
								<th>اسم المكتب</th>
								<th>اسم الموظف</th>
								<th>البريد الالكترونى</th>
								<th>طبيعة العمل</th>
								<th>الجوال</th>
								<th>الجنسية</th>
								<th>الراتب</th>
								<th>تعديل </th>
								<th>حذف</th>
								<th>عرض</th>
								<th class="text-center">بيانات تسجيل الدخول</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; ?>
							@foreach($employees as $employee)
							<tr class="odd gradeX text-center">
								<td>{{$i}}</td>
								<td>{{HTML::image($employee->profile_img , '' , ['width'=>70 , 'height'=>70 , 'class'=>'img-circle'])}}</td>
								<td>{{$employee->office->name}}</td>
								<td>{{$employee->name}}</td>
								<td>{{$employee->email}}</td>
								<td>{{$employee->work_type}}</td>
								<td>{{$employee->mobile}}</td>
								<td>{{$employee->nationality}}</td>
								<td>{{$employee->salary}}</td>
								<td>
									<a href="{{URL::to('/admin/employee' , [$employee->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
								</td>

								<td>
									{{Form::open(['route'=>['admin.employee.destroy' , $employee->id] , 'method'=>'delete' , 'id'=>'form'])}}
									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
									{{Form::close()}}
								</td>
								<td><a href="{{URL::to('/admin/employee' , $employee->id)}}"><i class="fa fa-eye"></i></a>
								</td>
								<td class="text-center">
								<a href="#openModal">بيانات تسجيل الدخول</a>
								<div id="openModal" class="modalDialog">
									<div>	
										<a href="#close" title="Close" class="close-M">X</a>

										<h2 style="margin-top:5px">
											بيانات التسجيل 
										</h2>
										<div class="log-info"> 
											<div>اسم المستخدم: {{$employee->user->user_name}}</div>
											<div>كلمة المررو: {{$employee->user->shown_password}}</div>
										</div>
									</div>
								</div>
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