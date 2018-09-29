@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/exchangeType">انواع الصرف</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع انواع الصرف </div>
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
								<th>نوع الصرف</th>
								<th>مدة الصرف</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($all_exchangeType as $row)
							<tr class="odd gradeX">
								<td>{{$row->id}}</td>
								<td>{{$row->type}}</td>
								<td>{{$row->duration}}</td>
								<td style="display:flex">
									{{Link_to_route('admin.exchangeType.edit' , 'تعديل ' , $row->id)}}&nbsp; 
									|&nbsp; {{Form::open(['route'=>['admin.exchangeType.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}
									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $(this).closest('form').submit();"> حذف</a>
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