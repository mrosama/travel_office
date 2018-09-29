@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="{{URL::to('/')}}/admin/banking/accounts">الحسابات البنكية</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">

		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع الحسابات البنكية</div>
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
								<th class="text-center">اسم البنك</th>
								<th class="text-center">الايبان</th>
								<th class="text-center">رقم الحساب</th>
								<th class="text-center">اسم صاحب الحساب</th>
								<th class="text-center">الدولة</th>
								<th class="text-center">المدينة</th>
								<th class="text-center">تعديل</th>
								<th class="text-center">حذف</th>
								<th class="text-center">عرض</th>
							</tr>
						</thead>
						<tbody>

							@foreach($accounts as $account)
							<tr class="text-center">
								<td>{{++$i}}</td>
								<td><a target="_blank" href="{{URL::to('admin/partners' , $account->partner->id)}}">{{$account->partner->name}}</a></td>
								<td>{{$account->bank_name}}</td>
								<td>{{$account->iban}}</td>
								<td>{{$account->bank_number}}</td>
								<td>{{$account->bank_account_owner}}</td>
								<td>{{$account->getCountry->name}}</td>
								<td>{{$account->getCity->name}}</td>
								<td>
									<a href="{{URL::to('/admin/banking/accounts' , [$account->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
								</td>
								<td>
									{{Form::open(['route'=>['admin.banking.accounts.destroy' , $account->id] , 'method'=>'delete' , 'id'=>'form'])}}

									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
									{{Form::close()}}
								</td>
								<td><a href="{{URL::to('/admin/banking/accounts' , $account->id)}}"><i class="fa fa-eye"></i></a>
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