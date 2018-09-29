@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/type">انواع العمل</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع انواع العمل </div>
					<div class="tools"> </div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover" id="sample_2">
						@if (Session::has('success')) 
						<div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
						@endif
						<thead>
							<tr>
								<th>#</th>
								<th>اسم النوع</th>
								<th>تعديل </th>
																<th>حذف </th>

							</tr>
						</thead>
						<tbody>
								@foreach($types as $type)
								<tr class="odd gradeX">
									<td>{{$type->id}}</td>
									<td>{{$type->name}}</td>
										<td>
							{{Form::open(['route'=>['admin.types.edit' , $type->id] , 'method'=>'GET' , 'id'=>'form'])}}

                                <button  type="submit" class="btn default btn-xs yellow-gold"><i class="fa fa-edit"></i>  </button>
								{{Form::close()}}
							</td>

							<td>
								{{Form::open(['route'=>['admin.types.destroy' , $type->id] , 'method'=>'delete' , 'id'=>'form'])}}

								<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $('form').submit();"> <i class="fa fa-trash-o"></i></a>
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