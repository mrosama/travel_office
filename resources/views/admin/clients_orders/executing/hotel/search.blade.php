<link href="{{URL::to('/')}}/assets/pages/css/search-rtl.min.css" rel="stylesheet" type="text/css" />
<div class="search-page search-content-1">
@if($sFault == null)
@if($status->StatusCode == "01" || $status->StatusCode == "05")
@if($responseArray != "{}")
<div class="search-bar ">
<div class="row">
<div class="col-md-12">
<div class="input-group" style="z-index:0">
<input type="text" class="form-control" id="search" placeholder="بحث عن...">
<span class="input-group-btn">
<button class="btn blue uppercase bold" type="button" id="searchBtn">بحث</button>
</span>
</div>
</div>
</div>
</div>
<div class="row">


<div class="col-md-5">
<!-- BEGIN PORTLET-->
<div class="portlet light ">
<div class="portlet-body">
<div class="note note-success">
<h4 class="block" id="searchResultH4">نتائج البحث ({{sizeof(json_decode($responseArray)->HotelResult)}})</h4>
<p><i class="f fa fa-map-marker" style="color:darkgray"></i> {{$cityName}}</p>
<p><i class="f fa fa-calendar-minus-o" style="color:darkgray"></i> {{$nights}} ليلة - {{$checkInDate}} - {{$checkOutDate}}</p>
<p><i class="f fa fa-bed" style="color:darkgray"></i> {{$roomsCount}} غرف(ة)</p>
<p><i class="f fa fa-group" style="color:darkgray"></i> {{$adultCount}} بالغ, {{$ChildrenCount}} طفل </p>
<p><i class="f fa fa-star" style="color:darkgray"></i> {{$stars}} </p>
</div>
</div>
</div>
<!-- END PORTLET-->
</div>

<div class="col-md-7">
<div class="search-container ">
<ul>

@foreach(json_decode($responseArray) as $hotels)
@foreach($hotels as $hotel)
<li class="search-item clearfix ">

@if(property_exists($hotel->HotelInfo , "HotelPicture"))
<img src="{{$hotel->HotelInfo->HotelPicture}}" height="100" width="135"  style="float:left" />
@else
<img src="{{URL::to('noimage.gif')}}" height="100" width="135" style="float:left" />
@endif

<div class="search-content" style="padding:0 0 0 145px;text-align: left;">
<h2 class="search-title">
{{$hotel->HotelInfo->HotelName}}
</h2>
<p class="search-desc" >
@if(!is_object($hotel->HotelInfo->HotelDescription))
{{$hotel->HotelInfo->HotelDescription}}..... <a href="{{URL::to('api/hotel/details')}}?SessionId={{$SessionId}}&HotelCode={{$hotel->HotelInfo->HotelCode}}&ResultIndex={{$hotel->ResultIndex}}" target="_blank">more details</a>
@else
<a href="{{URL::to('api/hotel/details')}}?SessionId={{$SessionId}}&HotelCode={{$hotel->HotelInfo->HotelCode}}&ResultIndex={{$hotel->ResultIndex}}" target="_blank">more details</a> .....
@endif
<br><br>

@if(!is_object($hotel->HotelInfo->HotelPromotion))
<span style="display:inline;background-color: rgba(255, 255, 0, 0.33)">
{{$hotel->HotelInfo->HotelPromotion}}<br><br>
</span>
@endif

<i class="f fa fa-map-marker" style="color:darkgray;float:left"></i>{{$hotel->HotelInfo->HotelAddress}} 

@if(!is_object($hotel->HotelInfo->Longitude))
<a target="_blank" href="http://maps.google.com/maps?z=12&t=m&q=loc:{{$hotel->HotelInfo->Latitude}}+{{$hotel->HotelInfo->Longitude}}">View Map</a>
@endif
<br>

{{$hotel->MinHotelPrice->{"@attributes"}->TotalPrice." ".$hotel->MinHotelPrice->{"@attributes"}->Currency}}
<i class="fa fa-usd" style="color:#3598dc;"></i><br>

{{$hotel->HotelInfo->Rating}}<i class="fa fa-star inbox-started" style="color:#fd7b12"></i><br>

@if(property_exists($hotel->HotelInfo , "TripAdvisorRating"))
{{$hotel->HotelInfo->TripAdvisorRating}}<i class="fa fa-heart" style="color:cadetblue"></i><br>
@endif
</p>

<div class="search-desc" style="float:right;text-align:left">

<button type="button" class="btn btn-primary btn-sm" onclick="bookHotel(this , {{$hotel->HotelInfo->HotelCode}} , {{$hotel->ResultIndex}})">احجز الان</button>
</div>

</div>
</li>
@endforeach
@endforeach

</ul>
</div>
</div>

@else
<div class="note note-danger text-center" style="margin: 60px;">
<h3>لم يتم العثور على اى فنادق!! من فضلك قم بالبحث مرة اخرى</h3>
</div>
@endif

@else
<div class="note note-danger text-center" style="margin: 60px;">
<h5>{{$status->Description}}</h5>
</div>
@endif

@else
<div class="note note-danger text-center" style="margin: 60px;">
<h5>{{$sFault->sText}}</h5>
</div>
@endif

</div>
</div>

<script type="text/javascript">
$('#loadImg').hide();
$('#screen').removeAttr('disabled');
$('#searchResultH4').show();

function bookHotel(event , HotelCode  , ResultIndex)
{
	$(event).parent().append('<img src="'+$("#base_url").val()+'/smLoad.gif" class="smLoad">');
	$('#searchResultH4').hide();
	$('li.search-item').hide();
	$(event).parent().parent().parent().show();

	$(event).parent().parent().parent().parent().parent().parent().removeClass('col-md-7');
	$(event).parent().parent().parent().parent().parent().parent().addClass('col-md-12');
	$(event).parent().parent().parent().css('border-bottom', '0');
	$(event).text("تحميل الغرف مرة أخرى!");
	$('#roomToBook').children().remove();

	$('#roomToBook').load($('#base_url').val() +"/api/hotel/rooms/to/book/{{$order_id}}/{{$SessionId}}/"+HotelCode+"?ResultIndex="+ResultIndex+"&RoomsCount={{$roomsCount}}");
}

$('#search').keyup(function(event) {
	var word = $(this).val();
	$.each($('li.search-item').children('div').find('h2') , function(index, val) 
	{
		if ($(this).text().toLowerCase().search(word.toLowerCase()) != -1)
			$(this).parent().parent().show();
		else
			$(this).parent().parent().hide();
	});

});

$('#searchBtn').click(function(event) {
	var word = $('#search').val();
	$.each($('li.search-item').children('div').find('h2') , function(index, val) 
	{
		if ($(this).text().toLowerCase().search(word.toLowerCase()) != -1)
			$(this).parent().parent().show();
		else
			$(this).parent().parent().hide();
	});
});

</script>

