<link href="{{URL::to('/')}}/assets/pages/css/search-rtl.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.list_metin{
		line-height: 15px;
		font-size: 10px;
		color: #666;
		width: 55px;
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
	.main-metin
	{
		margin-bottom: 15px;
	}
	.col-sp-30
	{
		float:left;
		width:30%;
	}
	.col-sp-10
	{
		float:left;
		width:10%;
	}
	.direction-m-25
	{
		margin-left: 30px;
	}
	.price_kur 
	{
		font-family: "Arial", Helvetica, sans-serif;
		font-size: 25pt;
		color: #fff;
		text-decoration: none;
		text-shadow: 2px 2px 2px #666;
	}
	.price {
		font-family: "Arial", Helvetica, sans-serif;
		font-size: 40pt;
		padding: 0px 0px 0px;
		color: #fff;
		text-decoration: none;
		text-shadow: 2px 2px 2px #666;
	}
	.list-price{
		padding: 10px;
		color: white;
		font-weight: bold;
		font-size: 16px;
		text-shadow: 2px 2px 2px #666;
	}
</style>
<div class="search-page search-content-1">
	<div class="row" dir="ltr">

		<div class="col-md-6" style=" padding:0;">
			<h4 class="search-title" style="margin-top:31px;padding: 10px;">
				<strong>
					{{$a_point}} - {{$b_point}}
				</strong>
			</h4>
			<div class="col-md-6" style="float:left;height:130px">
				<div class="main-metin">
					<div class="list_metin" style="float:left" dir="ltr" >Vehicle </div> 
					<div dir="ltr" class="title_mini" style="color:#17C4BB">{{$vehicle}}</div>
				</div>

				<div class="main-metin">
					<div class="list_metin" style="float:left" dir="ltr">Basis </div>
					<div dir="ltr" class="title_mini">{{$periods[0]['transfer_basis']}}</div>
				</div class="main-metin">

				<div class="main-metin">
					<div class="list_metin" style="float:left" dir="ltr">Tariff </div>
					<div dir="ltr" class="title_mini">{{$periods[0]['tariff']}}</div>
				</div>

				<div class="main-metin">
					<div class="list_metin" style="float:left" dir="ltr">Price </div>
					<div dir="ltr" class="title_mini">Per Vehicle</div>
				</div>

			</div>

			
			<table border="0" cellpadding="0" cellspacing="0" width="100%" height="120">
				<tbody>
					<tr style="background-color:#BBADA5;height: 40px;">
						<td align="left" class="list-price">PRICE LIST</td>
					</tr>
					<tr>
						<td align="center" style="background-color: #17C4BB">
							<span class="price_kur"><sup>USD</sup></span>&nbsp;&nbsp;<span class="price"><b>{{$show_price}}&nbsp;</b></span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="col-md-6" style=" padding:0;">
			<img src="{{$show_photos}}" style="height: 330px;" width="100%" class="img-responsive" />
		</div>

		<div class="col-md-6">

		</div>

		<div class="col-md-8" style="float:left">

			<div class="clearfix margin-bottom-20"> </div>
			<ul class="nav nav-tabs tabs-reversed">
				<li class="active">
					<a href="#tab_reversed_1_1" data-toggle="tab"> Price List </a>
				</li>
				<li>
					<a href="#tab_reversed_1_2" data-toggle="tab"> Itinerary </a>
				</li>
				<li>
					<a href="#tab_reversed_1_3" data-toggle="tab"> Conditions </a>
				</li>
				<li>
					<a href="#tab_reversed_1_4" data-toggle="tab"> Notes </a>
				</li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane fade active in" id="tab_reversed_1_1">
					<p> 
						@foreach($periods as $period)
						<div class="well" style="height:80px">

							<div class="col-sp-30">
								<div class="list_metin" style="float:left" dir="ltr">From </div>
								<div dir="ltr" class="title_mini">{{$period['start_period']}}</div>

								<div class="list_metin" style="float:left" dir="ltr">To </div>
								<div dir="ltr" class="title_mini">{{$period['end_period']}}</div>
							</div>

							<div class="col-sp-30">
								<div class="list_metin" style="float:left" dir="ltr">Day Time </div>
								<div dir="ltr" class="title_mini">{{$period['depar_type']}}</div>

								<div class="list_metin" style="float:left" dir="ltr">Basis</div>
								<div dir="ltr" class="title_mini">{{$period['transfer_basis']}}</div>
							</div>

							<div class="col-sp-30" >
								<div class="list_metin" style="float:left" dir="ltr">Per Vehicle  </div>
								<div dir="ltr" class="title_mini">{{$period['vehicle_price']}} {{$period['currency']}}</div>
							</div>

							<div class="col-sp-10" >
								<div class="list_metin" style="float:left" dir="ltr">
									{{Form::radio('tariff' , $period['period_id'])}} 
								</div>
								<div dir="ltr" class="title_mini"></div>
							</div>

						</div>

						@endforeach
					</p>
				</div>
				<div class="tab-pane fade" id="tab_reversed_1_2">
					<p>{{print($transfer_detail)}}</p>
				</div>
				<div class="tab-pane fade" id="tab_reversed_1_3">
					<p>{{print($conditions)}}</p>
				</div>
				<div class="tab-pane fade" id="tab_reversed_1_4">
					<p>{{print($notes)}}</p>
				</div>

			</div>

		</div>

		<div class="jumbotron col-md-4" style="margin-top:60px">

			<div>
				<span class="badge">1</span> Select Tariff
				<div class="alert alert-danger period-cat"> Please select period / category from the price list on the left</div>
			</div>

			<div>
				<span class="badge">2</span> Select Direction
				<div class="direction-m-25">{{Form::radio('DIRECTION' , 0)}} ARRIVAL</div>
				<div class="direction-m-25">{{Form::radio('DIRECTION' , 1)}} DEPARTURE</div>
				<div class="direction-m-25">{{Form::radio('DIRECTION' , 2)}} ROUND TRIP</div>
			</div>
			<hr>
			
			<div>
				<span class="badge">3</span> Select Date
				
			</div>

			<div class="text-center">
				<button class="btn btn-lg green" id="Book">احجز الان</button>
				
			</div>

		</div>

	</div>

</div>

<script type="text/javascript">
	$('input[name="tariff"]').change(function(event) {
		var date = $(this).parent().parent().prev().prev().children().eq(1).text();
		$('.period-cat').text("DAY TIME , " + date);
	});

	$('#Book').click(function(event) {


		event.preventDefault();

		if($('input[name="tariff"]').is(':checked') && $('input[name="DIRECTION"]').is(':checked'))
		{

			var data       = 
			{
				Direction   :   $('input[name="DIRECTION"]:checked').val(),
				PRODUCT_ID  :   {{$periods[0]['tour_id']}},
				PERIOD_ID   :   $('input[name="tariff"]:checked').val(),
			};

			console.log(data);

			$('#Transfer').load($('#base_url').val() + "/api/transfer/booking/{{$order_id}}" , data);
		}
		else
		{
			if(!$('input[name="tariff"]').is(':checked'))
				alert('Please choose the tariff');

			if(!$('input[name="DIRECTION"]').is(':checked'))
				alert('Please choose the direction');

		}
		
	});
</script>