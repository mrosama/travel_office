@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/drivers">السائقين</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع السائقين </div>
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
								<th class="text-center">صورة السائق</th>
								<th class="text-center">مزود الباص</th>
								<th class="text-center">اسم السائق</th>
								<th class="text-center">تاريخ الميلاد</th>
								<th class="text-center">الجنسية</th>
								<th class="text-center">الجوال</th>
								<th class="text-center">الدولة</th>
								<th class="text-center">المدينة</th>
								<th class="text-center">السجل المدنى/الاقامة</th>
								<th class="text-center">رقم الرخصة</th>
								<th class="text-center">صورة الرخصة</th>
								<th class="text-center">تعديل</th>
								<th class="text-center">حذف</th>
								<th class="text-center">عرض</th>
							</tr>
						</thead>
						<tbody>

							@foreach($drivers as $driver)
							<tr class="text-center">
								<td>{{++$i}}</td>
								<td>{{HTML::image($driver->photo , '' , ['width'=>70 , 'height'=>70 , 'class'=>'img-circle'])}}</td>
								<td><a href="{{URL::to('/admin/busses/suppliers' , $driver->supplier->id)}}">{{$driver->supplier->name}}</a></td>
								<td>{{$driver->name}}</td>
								<td>{{$driver->age}}</td>
								<td>{{$driver->nationality}}</td>
								<td>{{$driver->mobile}}</td>
								<td>{{$driver->getCountry->name}}</td>
								<td>{{$driver->getCity->name}}</td>
								<td>{{$driver->card_number}}</td>
								<td>{{$driver->licence}}</td>
								<td>{{HTML::image($driver->licence_img , '' , ['width'=>70 , 'height'=>70 , 'class'=>'img-circle'])}}</td>
								<td>
									<a href="{{URL::to('/admin/drivers' , [$driver->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
								</td>
								<td>
									{{Form::open(['route'=>['admin.drivers.destroy' , $driver->id] , 'method'=>'delete' , 'id'=>'form'])}}

									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
									{{Form::close()}}
								</td>
								<td><a href="{{URL::to('/admin/drivers' , $driver->id)}}"><i class="fa fa-eye"></i></a>
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