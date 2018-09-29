	<div class="tab-pane" id="tab_8">
		
		<div class="portlet light portlet-fit portlet-form ">
			<div class="portlet-title">
				<div class="caption" style="float:right">
					<i class="fa fa-user font-green"></i>
					<span class="caption-subject font-green bold uppercase">حجز سيارة خاصة بدون سائق</span>
				</div>
			</div>

			<div class="portlet-body">
				
				<!-- BEGIN FORM-->
				{{Form::open(array('route' => 'admin.employees.store', 'method'=>'post'  , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
				<div class="form-body">

					

					@if(Session::has('global_s'))
					<div class="alert alert-success" style="text-align : right;">
						<strong>شكرا لك ! </strong> {{Session::get('global_s')}}
					</div>
					@endif
					

				<table class="table dola">
					<?php $adult    = 1 ?>
					<?php $children = 0 ?>

					<tr>
						<td>اسم العميل</td>
						<td>{{$order->get_client_name->username}}</td>
					</tr>
					@if($order->id_wife != 0)
					<?php ++$adult ?>
					<tr>
						<td>اسم الزوجة</td>
						<td>{{$order->get_wife_name->client->username}}</td>
					</tr>
					@endif
					@if($order->id_child != "[null]")
					<tr>
						<td>الابناء</td>
						<td>
							@foreach(json_decode($order->id_child) as $id)
							{{ App\Client::find($id)->username}}
							@if(++$children != 2)
							| 
							@endif 
							@endforeach
						</td>
					</tr>
					@endif
					<tr>
						<td>عدد اﻷسرة</td>
						<td>{{$adult}} بالغ | {{$children}} طفل</td>
					</tr>
				</table>

					@foreach(range(0 , $i) as $count)

					<div style="margin:70px 0">
						<h4 class="green"> 
							@if($count == 0)
							العميل: {{$order->get_client_name->username}}
							@elseif($count == 1 && $order->id_wife != 0)
							الزوجة: {{$order->get_wife_name->client->username}}
							@else
							@if($order->id_child != "[null]")
							الابن: {{App\Client::find(json_decode($order->id_child)[$j++])->username}}
							@endif
							@endif
						</h4>
						<hr>
					</div>

					<div>
						<div class="btn-set text-center" style="margin-bottom:20px">
							<button type="button" class="btn default code">بحث بالكود</button>
							<button type="button" class="btn red api" >بحث بالموقع</button>
							<button type="button" class="btn yellow screen">بحث بالشاشة</button>
						</div>

						<div class="showScreen"></div>
					</div>

					<div>
						<div class="form-group">
							<label class="control-label col-md-1">السعر</label>
							<div class="col-md-2">
								{{Form::number('price' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
								<font color="red">{{$errors->first('price')}}</font>
							</div>

							<label class="control-label col-md-1">الربح</label>
							<div class="col-md-2">
								{{Form::number('profit' , '' , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
								<font color="red">{{$errors->first('profit')}}</font>
							</div>

							<label class="control-label col-md-1">النسبة</label>
							<div class="col-md-2">
								{{Form::text('percentage' , '' , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
								<font color="red">{{$errors->first('percentage')}}</font>
							</div>

							<label class="control-label col-md-1">الاجمالى</label>
							<div class="col-md-2">
								{{Form::number('total' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
								<font color="red">{{$errors->first('total')}}</font>
							</div>
						</div>
					</div>

					@endforeach


					<div class="form-actions text-center">
						<div class="row">
							<div class="col-md-offset-2 col-md-9">
								<button type="submit" class="btn green">حفظ</button>
								<button type="reset" class="btn default">الغاء </button>
							</div>
						</div>
					</div>

					{{Form::close()}}
					<!-- END FORM-->
				</div>
			</div>
			<!-- END VALIDATION STATES-->
		</div>
	</div>
	<!-- END FORM-->