{{-- single room--}}
@if(gettype($RoomGuest) == "object")
<h3>غرفة {{++$i}} ({{$RoomGuest->{"@attributes"}->AdultCount}} بالغ - {{$RoomGuest->{"@attributes"}->ChildCount}} طفل )</h3>
<hr>

<font color="cadetblue" size="2">البالغين</font>
@for($j=0; $j<$RoomGuest->{"@attributes"}->AdultCount; $j++)
<div class="form-group">
	<label class="control-label col-md-1">الاسم</label>
	<div class="col-md-4">
		{{Form::select('adults[]' , $adults , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
	</div>
</div>
@endfor

@if($RoomGuest->{"@attributes"}->ChildCount != 0)
<hr>
<font color="cadetblue" size="2">اﻷطفال</font>
@for($j=0; $j<$RoomGuest->{"@attributes"}->ChildCount; $j++)
<div class="form-group"> 
	<label class="control-label col-md-1">الاسم</label>
	<div class="col-md-4">
		{{Form::select('children[]' , $children , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
	</div>
	<div class="control-label col-md-2">
		@if(property_exists($RoomGuest , "ChildAge"))
		العمر 
		<font class="badge">{{$RoomGuest->ChildAge->int[$j]}}</font> سنة
		@endif
	</div>
</div>
@endfor
@endif
</div>
{{-- more than one room--}}
@else

@foreach($RoomGuest as $room)
<div class="well">
	<h3>غرفة {{++$i}} ({{$room->{"@attributes"}->AdultCount}} بالغ - {{$room->{"@attributes"}->ChildCount}} طفل )</h3>
	<hr>

	<font color="cadetblue" size="2">البالغين</font>
	@for($j=0; $j<$room->{"@attributes"}->AdultCount; $j++)
	<div class="form-group">
		<label class="control-label col-md-1">الاسم</label>
		<div class="col-md-4">
			{{Form::select('adults[]' , $adults , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
		</div>
	</div>
	@endfor

	@if($room->{"@attributes"}->ChildCount != 0)
	<hr>
	<font color="cadetblue" size="2">اﻷطفال</font>
	@for($j=0; $j<$room->{"@attributes"}->ChildCount; $j++)
	<div class="form-group"> 
		<label class="control-label col-md-1">الاسم</label>
		<div class="col-md-4">
			{{Form::select('children[]' , $children , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
		</div>
		<div class="control-label col-md-2">
			@if(property_exists($room , "ChildAge"))
			العمر 
			<font class="badge">{{$room->ChildAge->int[$j]}}</font> سنة
			@endif
		</div>
	</div>
	@endfor
	@endif
</div>

@endforeach

@endif

<div class="text-center">
	<button class="btn btn-primary" id="bookRooms">حجز</button>
</div>

<script type="text/javascript">
	$('#bookRooms').click(function(event) {
		$(this).parent().append("<img src='"+$('#base_url').val()+"/smLoad.gif' >");
		$('#roomToBook').load($('#base_url').val() + "/api/hotel/book/{{$order->id}}/{{$SessionId}}?ResultIndex={{$ResultIndex}}&rooms={{$rooms}}");
		event.preventDefault();
	});
</script>
