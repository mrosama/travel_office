@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/admins">المدراء</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع المدراء </div>
					<div class="tools"> </div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover " id="sample_2">
						@if(Session::has('success'))
						<div class="alert alert-success" style="text-align : right;">
							<strong>شكرا لك ! </strong> {{Session::get('success')}}
						</div>
						@endif
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">الاسم</th>
								<th class="text-center">البريد الالكترونى</th>
								<th class="text-center">الموبايل</th>
								<th class="text-center">الهاتف</th>
								<th class="text-center">تعديل</th>
								<th class="text-center">حذف</th>
								<th class="text-center">بيانات تسجيل الدخول</th>
							</tr>
						</thead>
						<tbody>
							@foreach($admins as $admin)
							<tr class="odd gradeX">
								<td class="text-center">{{++$i}}</td>
								<td class="text-center">{{$admin->name}}</td>
								<td class="text-center">{{$admin->email}}</td>
								<td class="text-center">{{$admin->mobile}}</td>
								<td class="text-center">{{$admin->phone}}</td>
								<td class="text-center">
									<a href="{{URL::to('/admin/admins' , [$admin->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
								</td>
								<td class="text-center">
									{{Form::open(['route'=>['admin.admins.destroy' , $admin->id] , 'method'=>'delete' , 'id'=>'form'])}}

									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
									{{Form::close()}}
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
											<div>اسم المستخدم: {{$admin->user->user_name}}</div>
											<div>كلمة المررو: {{$admin->user->shown_password}}</div>
										</div>
									</div>
								</div>
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