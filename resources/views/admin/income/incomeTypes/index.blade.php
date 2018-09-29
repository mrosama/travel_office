@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/income/types">انواع الايرادات</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع انواع الايرادات </div>
					<div class="tools"> </div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover" id="sample_2">
						@if (Session::has('success')) 
						<div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
						@endif
						<thead>
							<tr>
								<th class="text-center">م</th>
								<th class="text-center">النوع</th>
								<th class="text-center">تعديل</th>
								<th class="text-center">حذف</th>
							</tr>
						</thead>
						<tbody>
							@foreach($types as $type)
							<tr class="text-center">
								<td>{{++$i}}</td>
								<td>{{$type->type}}</td>
								<td>
									<a href="{{URL::to('/admin/income/types' , [$type->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
								</td>
								<td>
									{{Form::open(['route'=>['admin.income.types.destroy' , $type->id] , 'method'=>'delete' , 'id'=>'form'])}}

									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
									{{Form::close()}}
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