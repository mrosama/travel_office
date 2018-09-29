<style>
 table{cursor:pointer;}
</style>
<div class="row">
 @if(json_decode($responseArray)->Status->StatusCode == "01")
 @for($i=0; $i<$RoomsCount; $i++)

 @if($RoomsCount == 5)
 <div class="col-md-2" style="margin-right: 30px;padding:0">
  @else
  <div class="col-md-{{(12/$RoomsCount)}}" style="margin:0;padding:0">
   @endif

   <table class="table table-hover table-responsive checkCombination" @if($i != 0)style="background-color:rgb(93, 88, 88)"@endif>

     @if($RoomsCount != 1)
     <div class="price-table-head"><h4 class="no-margin text-center">غرفة {{$i+1}}</h4></div>
     @endif

     <tr>
      <th class="text-center">النوع</th>
      @if($RoomsCount == 1 || $RoomsCount == 2 || $RoomsCount == 3 || $RoomsCount == 4)
      <th class="text-center">سياسة الالغاء</th>
      @endif
      <th class="text-center">السعر الكلى</th>
    </tr>
    @foreach(json_decode($responseArray)->HotelRooms as $rooms)
    @foreach($rooms as $room)

    @if(!is_array($rooms))
    {{!$room = $rooms}}
    @endif

    <tr>
      <td class="text-center">
       {{Form::radio('roomChoise'.$i , $room->RoomIndex)}} {{$room->RoomTypeName}}<br>

       @if(!is_object($room->Inclusion))
       <font>{{$room->Inclusion}}</font>
       @else
       <font>_____</font>
       @endif
       <br>
       @if(!is_object($room->RoomPromtion))
       <font>{{$room->RoomPromtion}}</font>
       @else
       <font>_____</font>
       @endif

       @if($RoomsCount == 1 || $RoomsCount == 2 || $RoomsCount == 3 || $RoomsCount == 4)
     </td>
     <td class="text-center">
       <a class="btn green btn-outline sbold btn-sm" data-toggle="modal" href="#draggable" onclick="getCancellationPolicies({{$room->RoomIndex}})"> عرض </a>
       @else
       <a class="btn green btn-outline sbold btn-sm" data-toggle="modal" href="#draggable" onclick="getCancellationPolicies({{$room->RoomIndex}})"> سياسة الالغاء </a>
       @endif
     </td>

     <td class="text-center">{{$room->RoomRate->{"@attributes"}->TotalFare}} $</td>
   </tr>

   @endforeach
   @endforeach

 </table>

</div>
@endfor

<div class="col-md-12 text-center">
 @for($j=0; $j<$RoomsCount; $j++)
 {{Form::text('bookedRooms[]' , '' , ['style'=>'width:50px;text-align:center;padding-top: 7px;
 padding-bottom: 4px;' , 'disabled' , 'id'=>'room'.$j])}}
 @endfor
 <button class="btn btn-primary" id="bookRooms">حجز</button>
</div>

@if($RoomsCount != 1)
<script>
  //disable each table except the first
  $.each($('.checkCombination'), function(index, val) {
   var tr    = $(this).children().children();
   var input = tr.children().children('input');
   if(index != 0){
    tr.css('cursor', 'no-drop');
    input.attr('disabled', true);}
  });
 //while clicking on radio button change it's tr color
 $('input:radio').change(function(event) {
  var input_value = $(this).val();
  var table_tr = $(this).parent().parent().parent().parent().children().children();
  $.each(table_tr, function(index, val) {
   this.checked = false;
 });
  this.checked = true;

  var arr = {{str_replace('"' , "" , json_encode(json_decode($responseArray)->OptionsForBooking->RoomCombination))}};
  var valueExsist = 0;
  $.each(arr, function(index, val) {

   // if($.inArray(parseInt(input_value) , val.RoomIndex) != -1)
   // {
   //      console.log(val.RoomIndex);
   //      console.log(input_value);
   //      var index = $.inArray(parseInt(input_value) , val.RoomIndex);
   // }
   if(val.length == undefined)
    var RoomIndex = val.RoomIndex[0];
  else
    var RoomIndex = val[0];

  if(input_value == RoomIndex){
    ++valueExsist;
    for(var j=1; j<={{$RoomsCount}};j++){
     var tr    = $('.checkCombination').eq(j).children().children();
     $.each(tr, function(index, tr_val) {
      var input = $(this).children('td').children('input');

      if(val.length == undefined)
        var value = val.RoomIndex;
      else
        var value = val;

      if(input.val() == value[j]){
        input.removeAttr('disabled');
        $(this).css('cursor', 'pointer');
        $(this).css('background-color', 'white');
      }
    });
   } 
 }

});
  if(this.name == "roomChoise0"){
  //remove the values from bookedRooms inputs
  $.each($('input[name="bookedRooms[]"]'), function(index, val) {
   this.value = "";
 });
  //add this value (first radio button) to bookedRooms input
  $('input[id="room0"]').val(this.value);
  if(valueExsist == 0){
   for(var j=1; j<={{$RoomsCount}};j++){
     var tr    = $('.checkCombination').eq(j).children().children();
     $.each(tr, function(index, tr_val) {
      var input = $(this).children('td').children('input');
      input.attr('disabled' , 'disabled');
      input.removeAttr('checked');
      $(this).css('cursor', 'no-drop');
      $(this).css('background-color', 'rgb(93, 88, 88)');
    });
   }
 }
}
else if(this.name == "roomChoise1")
  $('input[id="room1"]').val(this.value);
else if(this.name == "roomChoise2")
  $('input[id="room2"]').val(this.value);
else if(this.name == "roomChoise3")
  $('input[id="room3"]').val(this.value);
else if(this.name == "roomChoise4")
  $('input[id="room4"]').val(this.value);
else if(this.name == "roomChoise5")
  $('input[id="room5"]').val(this.value);
});
 //while clicking on table tr trigger the input radio
 $('tr').click(function(event) {
  var input = $(this).children().first().children('input');
  if(!input.attr('disabled')){
    input.trigger('change');}
  });
</script>
@else
<script type="text/javascript">

 $('input:radio').change(function(event) {
   var input_value = $(this).val();
   var table_tr = $(this).parent().parent().parent().parent().children().children();
   $.each(table_tr, function(index, val) {
    this.checked = false;
  });
   this.checked = true;

   if(this.name == "roomChoise0"){
    $.each($('input[name="bookedRooms[]"]'), function(index, val) {
     this.value = "";
   });
    $('input[id="room0"]').val(this.value);}

    else if(this.name == "roomChoise1")
      $('input[id="room1"]').val(this.value);
    else if(this.name == "roomChoise2")
      $('input[id="room2"]').val(this.value);
    else if(this.name == "roomChoise3")
      $('input[id="room3"]').val(this.value);
    else if(this.name == "roomChoise4")
      $('input[id="room4"]').val(this.value);
    else if(this.name == "roomChoise5")
      $('input[id="room5"]').val(this.value);
  });
 $('tr').click(function(event) {
   var input = $(this).children().first().children('input');
   input.trigger('change');
 });
</script>
@endif


@else
<div class="note note-danger text-center" style="margin: 60px;">
 <h3>عفوا!! لقد تم انتهاء الجلسة الخاصة بك. من فضلك قم بالرجوع الى صفحة البحث وحاول مرة اخرى لتقوم بفتح جلسة جديدة</h3>
 <p>مدة الجلسة الخاصة بك عند كل عملية بحث هى (30 د)</p>
</div>
@endif

</div>

<div class="modal fade draggable in" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-body">
    <div id="showPolicies"></div>
  </div>
  <div style="text-align:left;padding:10px">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">اغلاق</button>
  </div>
</div>
</div>
</div>

<script type="text/javascript">
 $('#screen').removeAttr('disabled');
 $('#loadImg').hide();
 $('.smLoad').hide();

 function getCancellationPolicies(RoomIndex) {
  $('#showPolicies').children().remove();
  $('#showPolicies').append("<center><img src='"+$('#base_url').val()+"/ring.gif'></center>");
  $('#showPolicies').load($('#base_url').val() + "/api/hotel/cancellation/policies/{{$SessionId}}?ResultIndex={{$ResultIndex}}&RoomIndex="+RoomIndex);
}
$('#bookRooms').click(function(event) {
  var rooms = [];
  var j    = 0;
  for(var i =0; i<{{$RoomsCount}}; i++){
    if($('#room'+i).val() == "")
    {
      ++j;
      alert("يجب اختيار الغرفة رقم ("+ parseInt(i+1)+")");
      event.preventDefault();
    }
    else
     rooms.push($('#room'+i).val());
 }
 if(j > 0)
  event.preventDefault();
else
{
  $(this).parent().append("<img src='"+$('#base_url').val()+"/smLoad.gif' >");
  $('#roomToBook').load($('#base_url').val() + "/api/hotel/book/{{$order_id}}/{{$SessionId}}?ResultIndex={{$ResultIndex}}&rooms="+rooms);
  event.preventDefault();
}
});
</script>




