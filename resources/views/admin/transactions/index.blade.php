@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/transactions">المعاملات</a>
		</li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12">

		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع المعاملات </div>
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
								<th class="text-center">نوع المعاملة</th>
								<th class="text-center">الجهة</th>
								<th class="text-center">الاوراق المطلوبة</th>
								<th class="text-center">نموذج</th>
								<th class="text-center">الموقع الالكترونى</th>
								<th class="text-center">الدولة</th>
								<th class="text-center">المدينة</th>
								<th class="text-center">البريد الالكترونى</th>
								<th class="text-center">الموبايل</th>
								<th class="text-center">تعديل</th>
								<th class="text-center">حذف</th>
								<th class="text-center">عرض</th>
							</tr>
						</thead>
						<tbody>

							@foreach($transactions as $transaction)
							<tr class="text-center">
								<td>{{++$i}}</td>
								<td>{{$transaction->transactionType->name}}</td>
								<td>{{$transaction->site}}</td>
								<td>{{$transaction->paper_work}}</td>
								<td>
									@if($transaction->form != null)
									<a href="{{URL::to($transaction->form)}}">تحميل</a>
									@else
									<del>لا يوجد</del>
									@endif
								</td>
								<td>{{$transaction->website}}</td>
								<td>{{$transaction->getCountry->name}}</td>
								<td>{{$transaction->getCity->name}}</td>
								<td>{{$transaction->email}}</td>
								<td>{{$transaction->mobile}}</td>
								<td>
									<a href="{{URL::to('/admin/transactions' , [$transaction->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
								</td>
								<td>
									{{Form::open(['route'=>['admin.transactions.destroy' , $transaction->id] , 'method'=>'delete' , 'id'=>'form'])}}

									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
									{{Form::close()}}
								</td>
								<td><a href="{{URL::to('/admin/transactions' , $transaction->id)}}"><i class="fa fa-eye"></i></a>
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