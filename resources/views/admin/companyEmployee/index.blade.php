@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/companyEmployee">موظفين المؤسسات والشركات</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>عرض جميع موظفين المؤسسات والشركات </div>
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
								<th>اسم المؤسسة </th>
								<th>اسم القسم</th>
								<th>اسم الموظف</th>
								<th>الجنسية</th>
								<th>رقم الجوال</th>
								<th>الجنس</th>
								<th>تاريخ الميلاد</th>
								<th>رقم السجل المدني</th>
								<th>تاريخ انتهاء السجل المدني</th>
								<th>مصدر السجل المدني</th>
								<th>رقم الجواز</th>
								<th>تاريخ اصدار الجواز </th>
								<th>تاريخ انتهاء الجواز </th>
								<th>مصدر الجواز </th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($all_employee as $row)
							<tr class="odd gradeX">
								<td>{{$row->id}}</td>
								<td>{{$row->companyName->name}}</td>
								<td>{{$row->sectionName->sectionName }}</td>
								<td>{{$row->empName }}</td>
								<td>{{$row->nationality}}</td>
								<td>{{$row->mobile}}</td>
								<td>
									@if($row->sex == 'male')
									{{'ذكر'}}	
									@else
									{{'انثى'}}
									@endif

								</td>
								<td>{{$row->birthDate}}</td>
								<td>{{$row->No_civilRegistry}}</td>
								<td>{{$row->expireResidence}}</td>
								<td>{{$row->sourceResidence}}</td>
								<td>{{$row->passportNumber}}</td>
								<td>{{$row->passport_issue_date}}</td>
								<td>{{$row->passport_finish_date}}</td>
								<td>{{$row->sourcePassport}}</td>
								<td style="display:flex">
									{{Link_to_route('admin.companyEmployee.edit' , 'تعديل ' , $row->id)}}
									&nbsp; |&nbsp; 
									{{Form::open(['route'=>['admin.companyEmployee.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}
									<a href="javascript:;" onclick="if(confirm('هل أنت متأكد من عملية الحذف؟!')) $('form').submit();"> حذف</a>
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