
<link href="{{URL::to('/')}}/assets/pages/css/profile-rtl.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.details
	{
		float: right;
		width: 380px;
		margin-left: 20px;
		background-color: white;
		padding: 5px;
	}
	.sub-details
	{
		text-align: left;
		margin-top: 20px;
		direction: ltr;
	}
	.help-block
	{
		text-align:left
	}
</style>
<!-- BEGIN PAGE HEADER-->


<?php 
$adult    = 1;
$children = 0; 

if($order->id_wife != 0)
	++$adult; 
if($order->id_child != "null")
{
	foreach(json_decode($order->id_child) as $id)
		++$children;
}
?>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->

		<div class="details" >
			<img src="http://www.metglobaldmc.com/photo_gallery/max/fix_transfer.jpg" class="img-responsive">

			<div class="sub-details">
				<div class="profile-usertitle-name" style="font-size: 15px;font-weight: bolder"> MANCHESTER AIRPORT (MAN) > MANCHESTER </div>
				<div class="profile-usertitle-job"> 
					Service Type: Transfer<br>
					Depart: 
					@if($Direction == 0)
					Arrival
					@elseif($Direction == 1)
					Departure
					@else Round trip
					@endif 
					<br>
					Arrival Date: <br>
					Traveller: {{$adult}} Adult(s) , {{$children}} Children(s) 
				</div>
			</div>

		</div>

		<div class="profile-content">
			<div class="row">

				<div class="portlet light ">

					<div class="portlet-body form">

						<form  class="form-horizontal" id="BookingForm">

							<div class="form-body">
								<input type="hidden" name="store_key" value="120615TEST"> 
								<input type="hidden" name="booking_type" value="TRS">

								{{Form::hidden('PRODUCT_ID' , $PRODUCT_ID , ['class'=>'form-control'])}}
								{{Form::hidden('PERIOD_ID' , $PERIOD_ID , ['class'=>'form-control'])}}
								{{Form::hidden('TOUR_LEADER' , $order->get_client_name->username , ['class'=>'form-control'])}}
								{{Form::hidden('ADULT_PAX' , $adult , ['class'=>'form-control'])}}
								{{Form::hidden('CHILD_PAX' , $children , ['class'=>'form-control'])}}
								{{Form::hidden('DIRECTION' , $Direction , ['class'=>'form-control'])}}
								{{Form::hidden('CUSTOMER_COUNTRY' , App\Http\Models\Country::where('code' , $order->get_client_name->country)->first()->name , ['class'=>'form-control'])}}
								{{Form::hidden('CUSTOMER_TELEPHONE' , $order->get_client_name->mobile , ['class'=>'form-control'])}}

								<div class="form-group">
									<label class="col-md-3 control-label">VEHICLE_TYPE</label>
									<div class="col-md-8">
										{{Form::text('VEHICLE_TYPE' , 'audi' , ['class'=>'form-control'])}}
									</div>
								</div>

								<hr>
								<div class="portlet-title" style="padding:20px">
									<div class="caption">
										<i class="icon-settings font-dark"></i>
										<span class="caption-subject font-dark sbold uppercase">Arrival details</span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Arrival flight company</label>
									<div class="col-md-8">
										{{Form::text('ARRIVAL_FLIGHT_COMPANY' , 'Airline' , ['class'=>'form-control'])}}
										<span class="help-block"> Airline / Cruise / Boat / Train Name </span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Arrival flight code</label>
									<div class="col-md-8">
										{{Form::text('ARRIVAL_FLIGHT_CODE' , 'ewd5' , ['class'=>'form-control'])}}
										<span class="help-block"> Code (if exists) </span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Arrival date</label>
									<div class="col-md-8">
										{{Form::text('ARRIVAL_DATE' , '15.11.2014' , ['class'=>'form-control'])}}
										<span class="help-block"> Arrival Date (date format: dd.mm.yyyy) </span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Arrival time</label>
									<div class="col-md-8">
										{{Form::text('ARRIVAL_TIME' , '12:30' , ['class'=>'form-control'])}}
										<span class="help-block"> Arrival Date (date format: dd.mm.yyyy) </span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Arrival location</label>
									<div class="col-md-8">
										{{Form::text('ARRIVAL_LOCATION' , '12:30' , ['class'=>'form-control'])}}
										<span class="help-block"> Drop Off Location/Hotel Name </span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Arrival requests</label>
									<div class="col-md-8">
										{{Form::text('ARRIVAL_REQUESTS' , '' , ['class'=>'form-control'])}}
										<span class="help-block">  Additional Requests Name </span>
									</div>
								</div>

								<hr>
								<div class="portlet-title" style="padding:20px">
									<div class="caption">
										<i class="icon-settings font-dark"></i>
										<span class="caption-subject font-dark sbold uppercase">Departure Detail</span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Departure location</label>
									<div class="col-md-8">
										{{Form::text('DEPARTURE_LOCATION' , 'egypt' , ['class'=>'form-control'])}}
										<span class="help-block">Pick Up Location/Hotel Name </span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Departure flight company</label>
									<div class="col-md-8">
										{{Form::text('DEPARTURE_FLIGHT_COMPANY' , 'tona' , ['class'=>'form-control'])}}
										<span class="help-block">Airline / Cruise / Boat / Train Name </span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Departure flight code</label>
									<div class="col-md-8">
										{{Form::text('DEPARTURE_FLIGHT_CODE' , 'wef32' , ['class'=>'form-control'])}}
										<span class="help-block">Code (if exists) </span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Departure date</label>
									<div class="col-md-8">
										{{Form::text('DEPARTURE_DATE' , '15.11.2014' , ['class'=>'form-control'])}}
										<span class="help-block">Departure Date (date format: dd.mm.yyyy) </span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Departure time</label>
									<div class="col-md-8">
										{{Form::text('DEPARTURE_TIME' , '12:30' , ['class'=>'form-control'])}}
										<span class="help-block">Departure Time</span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Departure pickup time</label>
									<div class="col-md-8">
										{{Form::text('DEPARTURE_PICKUP_TIME' , '1:30' , ['class'=>'form-control'])}}
										<span class="help-block">What time do you wish to be picked up from your address/hotel ? 
											<i>(Please submit, the time you wish to be picked up from your address/hotel! We might change it at the time of re-confirmation for your favor. You can also contact the local service operator at the destination if you decide to change it.)
											</span>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Departure requests</label>
										<div class="col-md-8">
											{{Form::text('DEPARTURE_REQUESTS' , '' , ['class'=>'form-control'])}}
										</div>
									</div>

									<div id="showMessage" style="text-align: center"></div>

									<div class="form-actions text-center">
										<div class="row">
											<div class="col-md-offset-2 col-md-9 text-center">
												<button  class="btn green" type="submit" id="BookBtn">Submit</button>
											</div>
										</div>
									</div>

								</form>
							</div>


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$('#BookingForm').submit(function(event) {
			event.preventDefault();
			$.ajax({
				url:  $('#base_url').val() + '/api/transfer/final/process',
				data: $(this).serialize() , 
			})
			.done(function(data) {
				if(data[0] == -1)
				$('#showMessage').html(data[1]);
			})
			.fail(function(data) {
				console.log(data);
			})
			.always(function() {
				console.log("complete");
			});

		});
	</script>
