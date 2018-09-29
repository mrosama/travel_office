@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/embassies">السفارات</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع السفارات </div>
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
								<th class="text-center">اسم السفارة</th>
								<th class="text-center">حضور شخصى للسفارة</th>
								<th class="text-center">الدولة</th>
								<th class="text-center">المدينة</th>
								<th class="text-center">الشارع</th>
								<th class="text-center">الموقع الالكترونى</th>
								<th class="text-center">البريد الالكترونى</th>
								<th class="text-center">الجوال</th>
								<th class="text-center">الهاتف</th>
								<th class="text-center">امكانية مكتب يخلص المعاملة</th>
								<th class="text-center">تعديل</th>
								<th class="text-center">حذف</th>
								<th class="text-center">عرض</th>
							</tr>
						</thead>
						<tbody>

							@foreach($embassies as $embassy)
							<tr class="text-center">
								<td>{{++$i}}</td>
								<td>{{$embassy->name}}</td>
								<td>{{$embassy->presence}}</td>
								<td>{{$embassy->getCountry->name}}</td>
								<td>{{$embassy->getCity->name}}</td>
								<td>{{$embassy->street}}</td>
								<td>{{$embassy->site_url}}</td>
								<td>{{$embassy->email}}</td>
								<td>{{$embassy->mobile}}</td>
								<td>{{$embassy->phone}}</td>
								<td>{{$embassy->office}}</td>
								<td>
									<a href="{{URL::to('/admin/embassies' , [$embassy->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
								</td>
								<td>
									{{Form::open(['route'=>['admin.embassies.destroy' , $embassy->id] , 'method'=>'delete' , 'id'=>'form'])}}

									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
									{{Form::close()}}
								</td>
								<td><a href="{{URL::to('/admin/embassies' , $embassy->id)}}"><i class="fa fa-eye"></i></a>
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