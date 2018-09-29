@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/bills">الفواتير</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع الفواتير </div>
					<div class="tools"> </div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover " id="sample_2">
						@if(Session::has('success'))
						<div class="alert alert-success" style="text-align : right;">
							<strong>شكرا لك ! </strong> {{Session::get('success')}}
						</div>
						@endif
						<thead>
							<tr>
								<th>#</th>
								<th>اسم العميل </th>
								<th>رقم سند القبض</th>
								<th>صورة سند القبض</th>
								<th>الدولة</th>
								<th>المدينة</th>
								<th>نوع الطيران</th>
								<th>عدد المسافرون</th>
								<th>تاريخ الذهاب</th>
								<th>تاريخ العودة</th>
								<th>عدد الايام</th>
								<th>عدد الليالي</th>
								<th>الهاتف</th>
								<th>الجوال</th>
								<th>البريد الالكتروني</th>
								<th>اجمالي المبلغ (ريال سعودي)</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($all_bills as $row)
							<tr class="odd gradeX">
								<td>{{$row->id}}</td>
								<td>{{$row->getClientName->username}}</td>
								<td>{{$row->receipt }}</td>
								<td>{{HTML::image($row->receipt_photo , '',['width' => '75px'])}}</td>
								<td>{{$row->getCountryName->name}}</td>
								<td>{{$row->getCityName->name}}</td>
								<td>{{$row->flight_type}}</td>
								<td>{{$row->traveles}}</td>
								<td>{{$row->date_go}}</td>
								<td>{{$row->date_back}}</td>
								<td>{{$row->dayNumbers}}</td>
								<td>{{$row->dayNights}}</td>
								<td>{{$row->phone}}</td>
								<td>{{$row->mobile}}</td>
								<td>{{$row->email}}</td>
								<td>{{$row->price_sa}}</td>
								<td style="display:flex">
									{{Link_to_route('admin.bill.edit' , 'تعديل ' , $row->id)}}
									&nbsp; |&nbsp; 
									{{Form::open(['route'=>['admin.bill.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}
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