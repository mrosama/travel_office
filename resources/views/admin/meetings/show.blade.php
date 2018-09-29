@extends('admin.layouts.master')
@section('content')

@section('CssLinks')
<link href="{{URL::to('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />

<style type="text/css">
	.dola td{
		text-align: center !important;
	}
	td{
		width: 50%;
	}
</style>
@stop

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/meetings">الاجتماعات</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>
						عرض بيانات الاجتماع <font color="red" size="6">{{$meeting->number}}</font>
					</div>

					<table class="table dola">

						<tr>
							<td>عنوان الاجتماع</td>
							<td>{{$meeting->address}}</td>
						</tr>

						<tr>
							<td>تاريخ الاجتماع</td>
							<td>{{$meeting->date}}</td>
						</tr>

						<tr>
							<td>مكان الاجتماع</td>
							<td>{{$meeting->place}}</td>
						</tr>

						<tr>
							<td>نبذه عن الاجتماع</td>
							<td>{{$meeting->brief}}</td>
						</tr>
						
						<tr>
							<td>المدعوين</td>

							<td>
								<table class="table  table-hover table-activity">
									<tr>
										<td>الصورة الشخصية</td>
										<td>اسم الموظف</td>
										<td>البريد الاكترونى</td>
										<td>الجوال</td>
									</tr>
									@foreach(json_decode($meeting->employee_id) as $employee)
									<?php $data = App\Http\Models\Employee::find($employee); ?>
									<tr>
										<td><a href="{{URL::to("employee/profile/" , $data->profile_img)}}" id="single_image">{{HTML::image("employee/profile/".$data->profile_img , '' , ['width'=>50 , 'height'=>50 , 'class'=>'img-circle' ])}}</a></td>

										<td>{{$data->name}}</td>
										<td>{{$data->email}}</td>
										<td>{{$data->mobile}}</td>
									</tr>
									@endforeach
								</table>
							</td>
						</tr>
					</table>

					<div class="text-center">
						<h2>ما حدث فى الاجتماع</h2>
						@if($meeting->meetingEvent == null)
						<br><font color="red" size="3">لم يتم تسجيل ما حدث فى الاجتماع بعد!! </font> <font color="green" size="3">يمكنك تسجيل ما حدث </font> <a href="{{URL::to('/admin/meetings' , [$meeting->id , 'create' , 'event'])}}">من هنا</a> 
						@endif
					</div>

					@if($meeting->meetingEvent != null)
					<table class="table dola">
						<tr>
							<td><font color="green">الحاضرين</font></td>
							<td>
								<table class="table  table-hover table-activity">
									<tr>
										<td>الصورة الشخصية</td>
										<td>اسم الموظف</td>
										<td>البريد الاكترونى</td>
										<td>الجوال</td>
									</tr>
									@foreach(json_decode($meeting->meetingEvent->attendants) as $attendant)
									<?php $data = App\Http\Models\Employee::find($attendant); ?>
									<tr>
										<td><a href="{{URL::to("employee/profile/" , $data->profile_img)}}" id="single_image">{{HTML::image("employee/profile/".$data->profile_img , '' , ['width'=>50 , 'height'=>50 , 'class'=>'img-circle' ])}}</a></td>

										<td>{{$data->name}}</td>
										<td>{{$data->email}}</td>
										<td>{{$data->mobile}}</td>
									</tr>
									@endforeach
								</table>
							</td>
						</tr>
						<tr>
							<td><font color="red">الغائبين</font></td>
							<td>
								@if(count($absences) != 0)
								<table class="table  table-hover table-activity">
									<tr>
										<td>الصورة الشخصية</td>
										<td>اسم الموظف</td>
										<td>البريد الاكترونى</td>
										<td>الجوال</td>
										<td>سبب عدم الحضور</td>
									</tr>
									@foreach($absences as $absence)
									<tr>
										<td><a href="{{URL::to("employee/profile/" , $absence->profile_img)}}" id="single_image">{{HTML::image("employee/profile/".$absence->profile_img , '' , ['width'=>50 , 'height'=>50 , 'class'=>'img-circle' ])}}</a></td>

										<td>{{$absence->name}}</td>
										<td>{{$absence->email}}</td>
										<td>{{$absence->mobile}}</td>
										<td>{{\App\Meeting_Reason::where('employee_id' , $absence->id)->first()->reason}}</td>
									</tr>
									@endforeach
								</table>
								@else
								<font color="green">لا يوجد غائبين</font>
								@endif
							</td>
						</tr>
						<tr>
							<td>الملف</td>
							<td>
								@if($meeting->meetingEvent->file != null)
								لرؤية الملف المرفوع <a href="{{URL::to($meeting->meetingEvent->file)}}">اضغط هنا</a>
								@else
								لا يوجد ملف مرفوع من قبل
								@endif
							</td>
						</tr>
						<tr>
							<td>الملاحظات الايجابية</td>
							<td>{{$meeting->meetingEvent->positive_remarks}}</td>
						</tr>
						<tr>
							<td>الملاحظات السلبية</td>
							<td>{{$meeting->meetingEvent->negative_remarks}}</td>
						</tr>
						<tr>
							<td>التوصيات و الاقتراحات</td>
							<td>{{$meeting->meetingEvent->recommendations}}</td>
						</tr>
						<tr>
							<td>ملاحظات</td>
							<td>{{$meeting->meetingEvent->notes}}</td>
						</tr>
					</table>
					@endif
				</div>
			</div>

		</div>
	</div>

	@section('JsScripts')
	<script src="{{URL::to('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$("a#single_image").fancybox();
		});
	</script>
	@stop

	@stop