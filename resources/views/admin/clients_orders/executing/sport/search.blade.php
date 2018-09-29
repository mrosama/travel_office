<link href="{{URL::to('/')}}/assets/pages/css/search-rtl.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.list_metin{
		line-height: 15px;
		font-size: 10px;
		color: #666;
		width:100px;
	}
	.title_mini {
		font-family: 'Exo 2', sans-serif;
		font-size: 14px;
		font-weight: bold;
		line-height: 20px;
		color: #908278;
		text-decoration: none;
	}

	.fiyat_title {
		font-size: 24px;
		font-weight: bold;
		line-height: 0px;
		color: #666666;
		text-decoration: none;
		text-align:center;
	}
</style>
<div class="search-page search-content-1">
	<div class="row">
		<div class="search-container ">
			<ul>

				@foreach(json_decode($arr) as $data)

				<li class="search-item clearfix ">
					<div style="float:left;margin:0 25px">

						<img src="{{$data->show_photos}}" height="152" width="270" class="thumbnail" />
					</div>

					<div class="search-content" style="padding:0 0 0 325px;text-align: left;">
						<h4 class="search-title" style="font-size: 18px">
							<strong>{{$data->product_name}}</strong>
						</h4>

						<div class="col-md-6" style="float:left;height:70px">
							<div class="list_metin" style="float:left" dir="ltr" >ACTIVITY TYPE: </div> 
							<div dir="ltr" class="title_mini" style="color:#17C4BB">{{$data->activity_type}}</div>

							<div class="list_metin" style="float:left" dir="ltr">DEPARTS: </div>
							<div dir="ltr" class="title_mini">{{$data->periods[0]->depar_type}}</div>
						</div>


						<div class="search-desc" style="float:right;text-align:left">
							<p class="fiyat_title"><sup>$</sup>{{$data->show_price}}</p>
							<button type="button" class="btn btn-primary btn-sm" onclick="getDetails({{json_encode($data)}})">مزيد من التفاصيل</button>
						</div>

					</div>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>


<script type="text/javascript">
	$('#sportLoadImg').hide();
	function getDetails (data) {
		$('#Sport').load($('#base_url').val() + "/api/sport/get/details/{{$order_id}}" , data);
	}
</script>