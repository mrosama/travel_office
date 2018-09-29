@extends ('admin.layouts.master')
@section('content')

@section('CssLinks')
<link href="{{URL::to('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />

<style type="text/css">
	.dola td{
		text-align: center !important;
	}
	.dola td{
		width: 50%;
	}
	.table-activity td{
		width: 0;
	}
</style>
@stop

<h3 class="page-title"> طلبات العملاء
	<small>عرض طلب العميل</small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="index.html">الرئيسية</a>
			<i class="fa fa-angle-left"></i>
		</li>
		<li>
			<span><a href="{{URL::to('/admin/clients_orders')}}">طلبات العملاء</a></span>
			<i class="fa fa-angle-left"></i>
		</li>
		<li>
			<span>عرض طلب العميل</span>
		</li>
	</ul>

</div>
<!-- END PAGE HEADER-->


<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>عرض بيانات طلب العميل <font color="red" size="6">{{$client_order->get_client_name->username}}</font></h2>
				</div>

				<table class="table dola">

					<tr>
						<td>اسم العميل</td>
						<td>{{$client_order->get_client_name->username}}</td>
					</tr>

					<tr>
						<td>الجنسية</td>
						<td>{{$client_order->get_client_name->nationality}}</td>
					</tr>


					<tr>
						<td>البريد الالكتروني</td>
						<td>{{$client_order->get_client_name->email_address}}</td>
					</tr>

					<tr>
						<td>رقم الهاتف</td>
						<td>{{$client_order->get_client_name->phone}}</td>
					</tr>

					@if($wife)
					<tr>
						<td>اسم الزوجة</td>
						<td>{{$wife->username}}</td>
					</tr>
					@else
					<tr>
						<td>اسم الزوجة</td>
						<td> --- </td>
					</tr>
					@endif

					<tr>
						<td>الابناء</td>
						@if($child)
						<td> 
							@foreach($child as $row)
							{{ $row->username }} |
							@endforeach
						</td>
						@else
						<td > --- </td>
						@endif
					</tr>


					@if($client_order->order_type)
					<tr>
						<td>نوع الطلب</td>
						<td> 
							@foreach(json_decode($client_order->order_type) as $key => $val)
							{{  '   * ' . App\Orders_type::find($val)->type  }} 
							@endforeach
						</td>
					</tr>
					@endif

				</table>

			</div>
		</div>
	</div>
</div>



@section('JsScripts')
<script src="{{URL::to('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
@stop



@stop