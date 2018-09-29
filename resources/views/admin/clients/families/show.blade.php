@extends('admin.layouts.master')
@section('content')

@section('CssLinks')
<link href="{{URL::to('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />

<style type="text/css">
	.dola td{
		text-align: center !important;
	}
	
</style>
@stop

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/clients/show/families">العائلة</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>
						عرض عائلة العميل(ة) <font color="red" size="6">{{$client->username}}</font>
						@if(!isset($type))
						<div class="btn-group-justify" style="margin-top:20px">

							@if(count($family) != 0) 
							@if(!$family->first()->type == "0")
							{{link_to_route('admin.clients.create', 'اضافة زوجة' , array('parent_id' => $client->id , 'type' => 0), array('class' => 'btn btn-success'))}}
							@endif

							@else
							{{link_to_route('admin.clients.create', 'اضافة زوجة' , array('parent_id' => $client->id , 'type' => 0), array('class' => 'btn btn-success'))}}
							@endif

							{{link_to_route('admin.clients.create', 'اضافة ابن' , array('parent_id' => $client->id , 'type' => 1), array('class' => 'btn btn-success'))}}
						</div>
						@endif
					</div>

					@if(isset($C_family))
					<div class="text-center" style="margin-top:50px">
						<font color="red" size="4">لا يوجد عائلة لهذا العميل</font>
					</div>
					@endif

					@if(!count($family) == 0)
					<table class="table dola">
						@foreach($family as $data)
						<tr>
							<td>{{$data->client->username}}</td>
							<td>
								@if($data->type == 0)
								زوجة
								@elseif($data->type == 1)
								ابن
								@endif
							</td>
							<td>
								<a href="{{URL::to('admin/clients' , [$data->new_client_id , 'edit'])}}" target="_blank">تعديل</a>
							</td>
						</tr>
						@endforeach
					</table>
					@endif

					@if(isset($P_family))
					<table class="table dola">
						@if($type == "0")
						<tr>
							<td>{{App\Client::find($parent_id)->username}}</td>
							<td>زوج</td>
							<td>
								<a href="{{URL::to('admin/clients' , [App\Client::find($parent_id)->id , 'edit'])}}" target="_blank">تعديل</a>
							</td>
							<td>
								<a href="{{URL::to('admin/clients/show/families' , [App\Client::find($parent_id)->id])}}" target="_blank">عرض</a>
							</td>
						</tr>
						@foreach($P_family as $data)
						<tr>
							@if($data->type == 1)
							<td>{{$data->client->username}}</td>
							<td>
								ابن
							</td>
							<td>
								<a href="{{URL::to('admin/clients' , [$data->new_client_id , 'edit'])}}" target="_blank">تعديل</a>
							</td>
							@endif
						</tr>
						@endforeach
						@else

						<tr>
							<td>{{App\Client::find($parent_id)->username}}</td>
							<td>والد</td>
							<td>
								<a href="{{URL::to('admin/clients' , [App\Client::find($parent_id)->id , 'edit'])}}" target="_blank">تعديل</a>
							</td>
							<td>
								<a href="{{URL::to('admin/clients/show/families' , [App\Client::find($parent_id)->id])}}" target="_blank">عرض</a>
							</td>
						</tr>

						@foreach($P_family as $data)
						@if($id != $data->new_client_id)
						<tr>
							<td>{{$data->client->username}}</td>
							<td>
								@if($data->type == 0)
								والدة
								@elseif($data->type == 1)
								اخ
								@endif
							</td>
							<td>
								<a href="{{URL::to('admin/clients' , [$data->new_client_id , 'edit'])}}" target="_blank">تعديل</a>
							</td>
						</tr>
						@endif
						@endforeach

						@endif
					</table>
					@endif

				</div>
			</div>
		</div>

	</div>
</div>

@stop