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
			<a href="{{URL::to('/')}}/admin/visas">الفيزا و التأشيرات</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>
						عرض متطلبات الفيزا
						
					</div>

					<table class="table dola">
						<tr>
							<td>جنسية العميل</td>
							<td>{{$visa->fromCountry->name}}</td>
						</tr>

						<tr>
							<td>الى دولة</td>
							<td>{{$visa->toCountry->name}}</td>
						</tr>

						<tr>
							<td>السفارة</td>
							@if($visa->embassy != null)
							<td><a href="{{URL::to('admin/embassies' , $visa->embassy->id)}}" target="_blank">{{$visa->embassy->name}}</a></td>
							@else
							<td><del><font color="red">تم حذف السفارة</font></del></td>
							@endif
						</tr>

						<tr>
							<td>حجز طيران</td>
							<td>{{($visa->booking_flight)? "نعم":"لا"}}</td>
						</tr>

						<tr>
							<td>حجز فندق</td>
							<td>{{($visa->hotel_booking)? "نعم":"لا"}}</td>
						</tr>

						<tr>
							<td>تعريف عمل</td>
							<td>{{($visa->action_definition)? "نعم":"لا"}}</td>
						</tr>

						<tr>
							<td>تأمين صحى</td>
							<td>{{($visa->health_insurance)? "نعم":"لا"}}</td>
						</tr>

						<tr>
							<td>كشف حساب</td>
							<td>{{($visa->account_statement)? "نعم":"لا"}}</td>
						</tr>

						<tr>
							<td>امكانية عمل الفيزا فى المطار</td>
							<td>{{($visa->visa_in_airport)? "نعم":"لا"}}</td>
						</tr>

						<tr>
							<td>متطلبات عمل الفيزا في المطار</td>
							<td>
								@if($visa->requirements->count() != 0)
								@foreach($visa->requirements as $requirement)
								{{$requirement->requirement}}<br>
								@endforeach
								@else
								<del> <fon color="red">لا يوجد مطالب</font></del>
								@endif
							</td>
						</tr>

						<tr>
							<td>تعبئة نموذج اون لاين</td>
							<td>{{($visa->fill_form_online)? "نعم":"لا"}}</td>
						</tr>

						<tr>
							<td>تعبئة نموذج خارجي</td>
							<td>{{($visa->fill_form_external)? "نعم":"لا"}}</td>
						</tr>

						<tr>
							<td>صورة الجواز</td>
							<td>{{($visa->passport_photocopy)? "نعم":"لا"}}</td>
						</tr>

						<tr>
							<td>تعبئة نموذج</td>
							<td>{{($visa->fill_out_form)? "نعم":"لا"}}</td>
						</tr>

						<tr>
							<td>عدد الصور</td>
							<td>{{$visa->total_photos}}</td>
						</tr>

						<tr>
							<td>دفع رسوم</td>
							<td>{{$visa->payment_of_fees}}</td>
						</tr>

						<tr>
							<td>مدة التأشيرة</td>
							<td>{{$visa->visa_duration}}</td>
						</tr>

						<tr>
							<td>طلبات اضافية / ملاحظات</td>
							<td>{{$visa->notes}}</td>
						</tr>

						<tr>
							<td>ملف استمارة التأشيرة الرسمي</td>
							<td>
								@if($visa->officialFiles->count() !=0)
								@foreach($visa->officialFiles as $file)
								<a href="{{URL::to($file->file)}}">تحميل</a><br>
								@endforeach
								@else
								<del> <font color="red">لا يوجد اى ملفات</font></del>
								@endif
							</td>
						</tr>

						<tr>
							<td>ملف استمارة التأشيرة المعدلة</td>
							<td>
								@if($visa->modefiedFiles->count() !=0)
								@foreach($visa->modefiedFiles as $file)
								<a href="{{URL::to($file->file)}}">تحميل</a><br>
								@endforeach
								@else
								<del> <font color="red">لا يوجد اى ملفات</font></del>
								@endif
							</td>
						</tr>

						
					</table>
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