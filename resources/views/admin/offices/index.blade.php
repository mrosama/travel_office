@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/offices">المكاتب</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع المكاتب  </div>
					<div class="tools"> </div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover" id="sample_2">
						@if (Session::has('success')) 
						<div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
						@endif
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">اسم المكتب</th>
								<th class="text-center">البريد الاكترونى</th>
								<th class="text-center">الدوله</th>
								<th class="text-center">المدينه  </th>
								<th class="text-center">الشارع</th>
								<th class="text-center">تعديل </th>
								<th class="text-center">حذف</th>
								<th class="text-center">عرض</th>
								<th class="text-center">بيانات تسجيل الدخول</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; ?>
							@foreach($offices as $office)
							<tr class="odd gradeX text-center">
								<td>{{$i}}</td>
								<td>{{$office->name}}</td>
								<td>{{$office->email}}</td>
								<td>{{$office->getCountry->name}}</td>
								<td>{{$office->getCity->name}}</td>
								<td>{{$office->street_name}}</td>
								<td>
									<a href="{{URL::to('/admin/offices' , [$office->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
								</td>

								<td>
									{{Form::open(['route'=>['admin.offices.destroy' , $office->id] , 'method'=>'delete' , 'id'=>'form'])}}

									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $('form').submit();"> <i class="fa fa-trash-o font-red"></i></a>
									{{Form::close()}}
								</td>
								<td><a href="{{URL::to('/admin/offices' , $office->id)}}"><i class="fa fa-eye"></i></a>
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
												<div>اسم المستخدم: {{$office->user->user_name}}</div>
												<div>كلمة المررو: {{$office->user->shown_password}}</div>
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