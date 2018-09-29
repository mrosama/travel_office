@extends('admin.layouts.master')
@section('content')

@section('CssLinks')
<style type="text/css">
	.dola td{
		text-align: center !important;
	}
	td{
		width: 50%;
	}
</style>
@stop

<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{URL::to('/')}}/admin/instructions">المعلومات الخاصة و العامة</a>
		</li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="portlet light ">
			<div class="portlet-body">

				<div class="text-center">
					<h2>
						عرض بيانات المعلومات الخاصة و العامة
						
					</div>

					<table class="table dola">

						<tr>
							<td>النوع</td>
							<td>
								@if($instruction->type == "s")
								خاص للعميل
								@elseif($instruction->type == "g")
								عام للعميل
								@else
								خاص للمكتب
								@endif
							</td>
						</tr>

						<tr>
							<td>الدولة</td>
							<td>{{$instruction->getCountry->name}}</td>
						</tr>

						<tr>
							<td>المدينة</td>
							<td>{{$instruction->getCity->name}}</td>
						</tr>

						<tr>
							<td>ملف</td>
							<td>
								@if($instruction->file != null)
								<a href="{{URL::to($instruction->file)}}">{{str_replace("images/", "" , trim($instruction->file , '/')) }}</a>
								@else
								<del>لا يوجد</del>
								@endif
							</td>
						</td>
					</tr>

				</table>
			</div>
		</div>

	</div>
</div>

@stop