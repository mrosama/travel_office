@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/embassy/branches">الفروع</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع الفروع </div>
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
								<th class="text-center">اسم الفرع</th>
								<th class="text-center">الدولة</th>
								<th class="text-center">المدينة</th>
								<th class="text-center">الشارع</th>
								<th class="text-center">الموقع الالكترونى</th>
								<th class="text-center">البريد الالكترونى</th>
								<th class="text-center">الجوال</th>
								<th class="text-center">الهاتف</th>
								<th class="text-center">تعديل</th>
								<th class="text-center">حذف</th>
								<th class="text-center">عرض</th>
							</tr>
						</thead>
						<tbody>

							@foreach($branches as $branch)
							<tr class="text-center">
								<td>{{++$i}}</td>
								<td>{{$branch->embassy->name}}</td>
								<td>{{$branch->name}}</td>
								<td>{{$branch->getCountry->name}}</td>
								<td>{{$branch->getCity->name}}</td>
								<td>{{$branch->street}}</td>
								<td><a href="{{$branch->site_url}}" target="_blank">{{$branch->site_url}}</a></td>
								<td>{{$branch->email}}</td>
								<td>{{$branch->mobile}}</td>
								<td>{{$branch->phone}}</td>
								<td>
									<a href="{{URL::to('/admin/embassy/branches' , [$branch->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
								</td>
								<td>
									{{Form::open(['route'=>['admin.embassy.branches.destroy' , $branch->id] , 'method'=>'delete' , 'id'=>'form'])}}

									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
									{{Form::close()}}
								</td>
								<td><a href="{{URL::to('/admin/embassy/branches' , $branch->id)}}"><i class="fa fa-eye"></i></a>
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