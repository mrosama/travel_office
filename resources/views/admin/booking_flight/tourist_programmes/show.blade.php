<?php use App\Http\Models\Employee; ?>
@extends('admin.layouts.master')
@section('content')

@section('CssLinks')
<style type="text/css">
	.dola td{
		text-align: center !important;
	}
	td{
		width: 50%;
	}
	.table-activity td{
		width: 0;
	}
</style>
@stop
<?php $j=1 ?>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/tourist/programmes">البرامج السياحية</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>عرض بيانات البرنامج السياحى <font color="red" size="6">{{$tourist_program->name}}</font></h2>
				</div>

				<table class="table dola">

					<tr>
						<td>اسم البرنامج السياحى</td>
						<td>{{$tourist_program->name}}</td>
					</tr>

					<tr>
						<td>المشرفين</td>
						<td>
							@foreach(json_decode($tourist_program->supervisors)  as $supervisor )

							{{Employee::find($supervisor)->name}}

							@if($j < sizeof(json_decode($tourist_program->supervisors)))
							<?php ++$j ?>
							|
							@else
							<?php $j=1 ?>
							@endif

							@endforeach</td>
						</tr>

						<tr>
							<td>تاريخ الذهاب</td>
							<td>{{$tourist_program->going_date}}</td>
						</tr>


						<tr>
							<td>عدد ايام الرحلة</td>
							<td>{{$tourist_program->flight_days_no}}</td>
						</tr>

						<tr>
							<td>عدد ساعات الرحلة</td>
							<td>{{$tourist_program->flight_hours_no}}</td>
						</tr>

						<tr>
							<td>الوجبات</td>
							<td>
							@if($tourist_program->meals == "null")
								<del><font color="red">لا يوجد وجبات</font></del>
								@else
								{{$tourist_program->meals}}
								@endif
							</td>
						</tr>

						<tr>
							<td>انشطة البرنامج السياحي</td>
							<td>
								<table class="table  table-hover table-activity">
									<tr>
										<td>م</td>
										<td>الحدث</td>
										<td>الوقت</td>
										<td>المدة</td>
									</tr>
									@foreach($activities as $activity)
									<tr>
										<td>{{++$i}}</td>
										<td>{{$activity->event}}</td>
										<td>{{$activity->time}}</td>
										<td>{{$activity->duration}}</td>
									</tr>
									@endforeach
								</table>
							</td>
						</tr>

						<tr>
							<td>ملاحظات</td>
							<td>{{$tourist_program->program_notes}}</td>
						</tr>

					</table>

					<div class="text-center">
						<h2>الانطلاق من</h2>
					</div>

					<table class="table dola">

						<tr>
							<td>من دولة</td>
							<td>{{$tourist_program->fromCountry->name}}</td>
						</tr>
						<tr>
							<td>من مدينة</td>
							<td>{{$tourist_program->fromCity->name}}</td>
						</tr>

						<tr>
							<td>من مكان</td>
							<td>{{$tourist_program->from_place}}</td>
						</tr>

						<tr>
							<td>ساعة الانطلاق</td>
							<td>{{$tourist_program->launch_hour}}</td>
						</tr>

						<tr>
							<td>ملاحظات</td>
							<td>{{$tourist_program->launching_notes}}</td>
						</tr>

					</table>

					<div class="text-center">
						<h2>الوصول الى</h2>
					</div>

					<table class="table dola">

						<tr>
							<td>الى دولة</td>
							<td>{{$tourist_program->toCountry->name}}</td>
						</tr>
						<tr>
							<td>الى مدينة</td>
							<td>{{$tourist_program->toCity->name}}</td>
						</tr>

						<tr>
							<td>الى مكان</td>
							<td>{{$tourist_program->to_place}}</td>
						</tr>

						<tr>
							<td>ملاحظات</td>
							<td>{{$tourist_program->arriving_notes}}</td>
						</tr>

					</table>

					<div class="text-center">
						<h2>بيانات الباص</h2>
					</div>

					<table class="table dola">

						@foreach($tourist_program->reservedBus as $reservedBus)
						<tr>
							<?php $BussesSupplier = App\BussesSupplier::find($reservedBus->supplier_id); ?>
							<td>مزود الخدمة</td>
							<td><a href="{{URL::to('/admin/busses/suppliers' , $BussesSupplier->id)}}" target="_blank">{{$BussesSupplier->name}}</a></td>
						</tr>

						<tr>
							<?php $bus = App\Bus::find($reservedBus->bus_id); ?>
							<td>الباص</td>
							<td><a href="{{URL::to('/admin/busses' , $bus->id)}}" target="_blank">{{$bus->number}}</a></td>
						</tr>

						<tr>
							<?php $driver = App\Driver::find($reservedBus->driver_id); ?>
							<td>السائق</td>
							<td><a href="{{URL::to('/admin/drivers' , $driver->id)}}" target="_blank">{{$driver->name}}</a></td>
						</tr>
						<tr>
							<td><hr></td>
							<td><hr></td>
						</tr>
						@endforeach

					</table>
				</div>
			</div>

		</div>
	</div>

	@stop