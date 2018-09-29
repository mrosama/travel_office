	<div class="tab-pane" id="tab_10">
		
		<div class="portlet light portlet-fit portlet-form ">
			<div class="portlet-title">
				<div class="caption" style="float:right">
					<i class="fa fa-user font-green"></i>
					<span class="caption-subject font-green bold uppercase">حجز مباريات</span>
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
					
					<div>
						<div class="btn-set text-center" style="margin-bottom:20px">
							<button type="button" class="btn red screen" >بحث بالموقع</button>
							<button type="button" class="btn yellow" id="apiS">بحث بالشاشة</button>
						</div>

						<div class="showScreen">

							<div class="form-group">
								<label class="control-label col-md-3">ملف</label>
								<div class="col-md-8">
									{{Form::file("file" , ["class"=>"form-control" , "autocomplete" =>"on" , "required"])}}<br>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">ملاحظات</label>
								<div class="col-md-8">{{Form::textarea("notes" ,"", ["class"=>"form-control" , "autocomplete" =>"on" , "required"])}}<br>
								</div>
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

							<div class="form-actions text-center">
								<div class="row">
									<div class="col-md-offset-2 col-md-9">
										<button  class="btn green">حفظ</button>
										<button type="reset" class="btn default">الغاء </button>
									</div>
								</div>
							</div>

						</div>

						<div id="SportApi" style="display:none">
							<div class="form-group">
								<label class="control-label col-md-2">المدينة</label>
								<div class="col-md-8">
									{{Form::select("sportCity" , $trs_api_city , '' ,  ["class"=>"bs-select form-control" , 'id' => 'city_id' ,  'data-live-search' =>'true' , "required" , 'placeholder'=>'من فضلك اختر المدينة'])}}
								</div>
								<div class="col-md-2">
									<button class="btn btn-danger" id="searchSport">بحث</button>
								</div>
							</div>
						</div>

					</div>

					<div class="text-center">
						{{HTML::image('ripple.gif' ,'' , ['style'=>'display:none' , 'id'=>"sportLoadImg"])}}
					</div>

					<div id="Sport"></div>


					{{Form::close()}}
					<!-- END FORM-->
				</div>
			</div>
			<!-- END VALIDATION STATES-->
		</div>
	</div>
	<!-- END FORM-->

	@section('sportJs')
	<script type="text/javascript">
		$('#apiS').click(function(event) {
			$(this).parent().parent().find('.showScreen').children().remove();
			$('#SportApi').show();
		});

		$('.screen').each(function(event) {
			$(this).click(function(event) {
				$(this).parent().parent().find('#SportApi').hide();
				$("#HotelSearch").children().remove();
			});
		});


		$('select[name="sportCity"]').change(function(event) {
			if($('select[name="sportCity"]').val() != "")
			{
				$('#sportLoadImg').show();
				$('#Sport').load($('#base_url').val() + "/api/sport/{{$order->id}}?city_id="+this.value);
			}
			else;
		});

		$('#searchSport').click(function(event) {
			event.preventDefault();
			if($('select[name="sportCity"]').val() != "")
			{
				$('#sportLoadImg').show();
				$('#Sport').load($('#base_url').val() + "/api/sport/{{$order->id}}?city_id="+$('select[name="sportCity"]').val());
			}
			else
				alert("من فضلك اختر المدينة");
		});
	</script>
	@stop