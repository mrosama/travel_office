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
					<i class="fa fa-globe"></i>عرض جميع الطلاب الموجدين بـ <b>{{$data['institute']->name}}</b> </div>
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
								<th>الصورة الشخصية</th>
								<th>الاسم</th>
								<th>الدولة</th>
								<th>المدينة</th>
								<th>تاريخ الميلاد</th>
								<th>الجنسية</th>
								<th>البريد الالكترونى</th>
								<th>الجوال</th>
								<th class="text-center">تعديل</th>
								<th class="text-center">حذف</th>
								<th class="text-center">عرض</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; ?>
							@foreach($data['institute']->students as $student)
							<tr class="odd gradeX">
								<td class="text-center">{{$i++}}</td>
								<td class="text-center">{{HTML::image($student->photo , '' , ['width'=>70 , 'height'=>70 , 'class'=>'img-circle'])}}</td>
								<td class="text-center">{{$student->name}}</td>
								<td class="text-center">{{$student->birth_date}}</td>
								<td class="text-center">{{$student->getCountry->name}}</td>
								<td class="text-center">{{$student->getCity->name}}</td>
								<td class="text-center">{{$student->nationality}}</td>
								<td class="text-center">{{$student->email}}</td>
								<td class="text-center">{{$student->mobile}}</td>
								
							</td>
							<td class="text-center">
								<a href="{{URL::to('/admin/institutes' , [$student->id , 'students' , $student->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
							</td>
							<td class="text-center">
								{{Form::open(['route'=>['admin.students.destroy' , $data['institute']->id , $student->id] , 'method'=>'delete' , 'id'=>'form'])}}

								<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
								{{Form::close()}}
							</td>
							<td class="text-center"><a href="{{URL::to('/admin/institutes' , [$student->id , 'students' , $student->id ])}}"><i class="fa fa-eye"></i></a>
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