	<div class="tab-pane" id="tab_6">
		
		<div class="portlet light portlet-fit portlet-form ">
			<div class="portlet-title">
				<div class="caption" style="float:right">
					<i class="fa fa-user font-green"></i>
					<span class="caption-subject font-green bold uppercase">حجز رحلة سياحية</span>
				</div>
			</div>

			<div class="portlet-body">
				
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
							<button type="button" class="btn red api" >بحث بالموقع</button>
							<button type="button" class="btn yellow screen">بحث بالشاشة</button>
						</div>
						<div class="showScreen"></div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">المدينة</label>
						<div class="col-md-8">{{Form::select("city" , $trs_api_city , '' ,  ["class"=>"bs-select form-control" , 'id' => 'city_id' ,  'data-live-search' =>'true' , "required"])}}<br></div>
					</div>
					<div class="form-actions text-center">
						<div class="row">
							<div class="col-md-offset-2 col-md-9 text-center">
								<button  class="btn green" type="button" id="searchTouristBtn">بحث</button>
								<button  class="btn default" type="reset">الغاء</button>
							</div>
						</div>
					</div>
					{{Form::close()}}
					<!-- END FORM-->
					
					<div class="form-group" id="image_loading" style="display:none;" >
						<div class="col-md-5"></div>
						<div class="col-md-7" >
							<img width="250px;" src="https://themarketingoak.files.wordpress.com/2015/07/circle-loading-animation.gif" />
						</div>
					</div>


					<div id="dola">
					</div>

				</div>
			</div>
			<!-- END VALIDATION STATES-->
		</div>
	</div>
	<!-- END FORM-->


	@section('addJs')
	<script type="text/javascript">

		$("#searchTouristBtn").click(function(event) {

			
			$("#image_loading").css("display", "block");


			var city_id =  $('#city_id').val();
			var baseurl = document.getElementById('baseurl').value;

			$.ajax({
				url:  baseurl+'/executing/orders/getTouristApi', 
				type: 'GET',
				data: {city_id},
				success : function(data){
					//console.log(data);
				//$('#city').empty();
				if(data == '')
				{
					//var empty = "<option selected disabled>عفوا لا يوجد مدن لهذه الدولة!</option>";
					//$('#city').html(empty);
				}
				else
				{
					$("#image_loading").css("display", "none");
					$('#dola').empty();
					$.each(JSON.parse(data) , function(i , val)
					{




						//console.log(val.record_id);
						var dola = 	'<hr><br><br>'+
						'<div class="form-group" >'+
						'<div class="col-md-2" style="text-align:center">'+
						'<p> السعر بالدولار</p>'+
						'<p >$ 68,9</p>'+
						'<a href="" class="btn btn-success btn-sm"> مشاهدة التفاصيل </a>'+
						'</div>'+
						'<div class="col-md-10">'+
						'<ul class="media-list">'+
						'<li class="media">'+
						'<div class="media-body" style="text-align:left;padding-left: 40px;">'+
						'<h4 class="media-heading">'+val.product_name +'</h4>'+
						'<h6><b>DEPARTURE POINT</b> : '+ val.departure_point +' </h6><br>'+
						'<h6><b>DURATION</b>: '+val.duration + '  ' + val.duration_type +'</h6>'+
						'<h6><b>HIGHLIGHTS</b> : '+val.highlight +'</h6>'+
						'<h6><b>AVAILABLE GUIDING </b>  :  '+val.guides_language+'</h6>'+
						'</div>'+
						'<div class="media-left">'+
						'<a href="#"><img width="200px;" class="media-object" src="'+val.show_photos+'"></a>'+
						'</div>'+
						'</li>'+
						'</ul>'+
						'</div>'+

						'</div>';

						$('#dola').append(dola);
					});
				}
				$('#dola').selectpicker('refresh');
			},
			error : function(e){
				console.log(e);
			}
		});
		});
	</script>

	@stop