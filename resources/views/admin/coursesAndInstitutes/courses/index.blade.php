@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/courses">الدورات</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع الدورات </div>
					<div class="tools"> </div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover" id="sample_2">
						@if (Session::has('global_s')) 
						<div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('global_s')}}</div>
						@endif

						<thead>
							<tr>
								<th class="text-center">م</th>
								<th class="text-center">اسم الدورة</th>
								<th class="text-center">الدولة</th>
								<th class="text-center">المدينة</th>
								<th class="text-center">نوع الدورة</th>
								<th class="text-center">مدة الدورة باﻷيام</th>
								<th class="text-center">مدة الدورة بالاسابيع</th>
								<th class="text-center">مدة الدورة بالشهور</th>
								<th class="text-center">تاريخ البداية</th>
								<th class="text-center">تاريخ النهاية</th>
								<th class="text-center">مستوى الدورة</th>
								<th class="text-center">لغة الدورة</th>
								<th class="text-center">عدد الساعات اليومية</th>
								<th class="text-center">اجمالى الساعات</th>
								<th class="text-center">سعر الدورة</th>
								<th class="text-center">صورة اعلان الدورة</th>
								<th class="text-center">تاريخ اعلان الدورة</th>
								<th class="text-center">مدة الاعلان</th>
								<th class="text-center">تعديل</th>
								<th class="text-center">حذف</th>
								<th class="text-center">عرض</th>
							</tr>
						</thead>
						<tbody>

							@foreach($courses as $course)
							<tr class="text-center">
								<td>{{++$i}}</td>
								<td>{{$course->name}}</td>
								<td>{{$course->getCountry->name}}</td>
								<td>{{$course->getCity->name}}</td>
								<td>{{$course->type}}</td>
								<td>{{$course->duration_in_days}}</td>
								<td>{{$course->duration_in_weeks}}</td>
								<td>{{$course->duration_in_month}}</td>
								<td>{{$course->start_date}}</td>
								<td>{{$course->end_date}}</td>
								<td>
									@if($course->level == "b")
									مبتدء
									@elseif($course->level == "m")
									متوسط
									@elseif($course->level == "a")
									متقدم
									@endif
								</td>
								<td>
									@if($course->language == "a")
									عربى
									@elseif($course->level == "e")
									انجليزى
									@endif
								</td>
								<td>{{$course->dayly_hours}}</td>
								<td>{{$course->total_hours}}</td>
								<td>{{$course->price}}</td>
								<td>{{HTML::image($course->advertisment_photo , '' , ['width'=>70 , 'height'=>70 , 'class'=>'img-circle'])}}</td>
								<td>{{$course->advertisment_date}}</td>
								<td>{{$course->advertisment_duration}}</td>
								<td>
									<a href="{{URL::to('/admin/courses' , [$course->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
								</td>
								<td>
									{{Form::open(['route'=>['admin.courses.destroy' , $course->id] , 'method'=>'delete' , 'id'=>'form'])}}

									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
									{{Form::close()}}
								</td>
								<td><a href="{{URL::to('/admin/courses' , $course->id)}}"><i class="fa fa-eye"></i></a>
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