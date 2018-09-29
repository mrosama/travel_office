@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/client">قائمة العملاء</a>
		</li>
	</ul>
</div>



<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption font-dark">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject bold uppercase"> عرض العملاء</span>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					@if (Session::has('error')) 
					<div class="alert alert-danger"  style="text-align: right;"><strong>خطأ! </strong>{{Session::get('error')}}</div>
					@endif
					<thead>
						<tr class="text-center">
							<th class="text-center">م</th>
							<th class="text-center">الصورة</th>
							<th class="text-center">الاسم</th>
							<th class="text-center">الاسم بالانجليزية</th>
							<th class="text-center">العائلة</th>
						</tr>
					</thead>
					<tbody>
						@foreach($clients as $client)
						<tr class="odd gradeX">
							<td class="text-center">{{++$i}}</td>
							<td class="text-center"><img src="{{URL::to('/').$client->photo}}" width="75px"/></td>
							<td class="text-center">{{$client->username}}</td>
							<td class="text-center">{{$client->username_en}}</td>
							<td class="text-center"><a href="{{URL::to('/admin/clients/show/families' , $client->id)}}">عرض</a></td>
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