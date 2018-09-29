@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
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
					<i class="fa fa-globe"></i>عرض جميع الفواتير</div>
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
								<th class="text-center">الشريك</th>
								<th class="text-center">المطلوب</th>
								<th class="text-center">المدفوع</th>
								<th class="text-center">المتبقى</th>
								<th class="text-center"> من تاريخ</th>
								<th class="text-center"> الى تاريخ</th>
								<th class="text-center">يوم الدفع</th>
								<th class="text-center">تعديل</th>
								<th class="text-center">حذف</th>
								<th class="text-center">عرض</th>
							</tr>
						</thead>
						<tbody>

							@foreach($bills as $bill)
							<tr class="text-center">
								<td>{{++$i}}</td>
								<td><a target="_blank" href="{{URL::to('admin/partners' , $bill->partner->id)}}">{{$bill->partner->name}}</a></td>
								<td>{{$bill->required_amount}} ر.س</td>
								<td>{{$bill->paid_amount}} ر.س</td>
								<td>{{$bill->remaining_amount}} ر.س</td>
								<td>{{$bill->pay_from_date}}</td>
								<td>{{$bill->pay_to_date}}</td>
								<td>
									<?php 
									$date1 = new DateTime(Date('Ymd'));
									$date2 = new DateTime($bill->pay_to_date);
									$interval = $date1->diff($date2);

									if($interval->format('%r') == '-')
										echo("<del>منذ ".$interval->format('%d يوم %m شهر %y سنة')."</del>");
									elseif($interval->format('%d') == 0)
										echo "<font color='red'>اليوم</font>";
									else
										echo("<font color='green'>باقى ".$interval->format('%r %d يوم %m شهر %y سنة')."</font>");
									?>
								</td>
								<td>
									<a href="{{URL::to('/admin/bills' , [$bill->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
								</td>
								<td>
									{{Form::open(['route'=>['admin.bills.destroy' , $bill->id] , 'method'=>'delete' , 'id'=>'form'])}}

									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
									{{Form::close()}}
								</td>
								<td><a href="{{URL::to('/admin/bills' , $bill->id)}}"><i class="fa fa-eye"></i></a>
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