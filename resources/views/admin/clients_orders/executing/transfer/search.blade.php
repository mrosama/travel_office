<link href="{{URL::to('/')}}/assets/pages/css/search-rtl.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.list_metin{
		line-height: 15px;
		font-size: 10px;
		color: #666;
		width:65px;
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
						<h4 class="search-title">
							<strong>
								{{$data->a_point}} - {{$data->b_point}}
							</strong>
						</h4>

						<div class="col-md-6" style="float:left;height:70px">
							<div class="list_metin" style="float:left" dir="ltr" >Vehicle </div> 
							<div dir="ltr" class="title_mini" style="color:#17C4BB">{{$data->vehicle}}</div>

							<div class="list_metin" style="float:left" dir="ltr">Basis </div>
							<div dir="ltr" class="title_mini">{{$data->periods[0]->transfer_basis}}</div>
						</div>

						<div class="col-md-6" style="float:right;height:70px">
							<div class="list_metin" style="float:left" dir="ltr">Tariff </div>
							<div dir="ltr" class="title_mini">{{$data->periods[0]->tariff}}</div>

							<div class="list_metin" style="float:left" dir="ltr">Price </div>
							<div dir="ltr" class="title_mini">Per Vehicle</div>
							<br>
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
	$('#tarnsferLoadImg').hide();
	function getDetails (data) {
		$('#Transfer').load($('#base_url').val() + "/api/transfer/get/details/{{$order_id}}" , data);
	}
</script>