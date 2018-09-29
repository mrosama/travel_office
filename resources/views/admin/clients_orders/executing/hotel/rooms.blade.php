                @if($responseArray != "{}")
                <table class="table table-hover">
                <tr>
                <th class="text-center">م</th>
                <th class="text-center">النوع</th>
                <th class="text-center">تتضمن</th>
                <th class="text-center">ترويج الغرفة</th>
                <th class="text-center">سياسة الالغاء</th>
                <th class="text-center">ضريبة الغرفة</th>
                <th class="text-center">سعر الغرفة</th>
                <th class="text-center">السعر الكلى</th>
                </tr>

                @if(is_array(json_decode($responseArray)->HotelRoom))

                @foreach(json_decode($responseArray) as $rooms)
                @foreach($rooms as $room)
                <tr>
                <td class="text-center">{{$room->RoomIndex}}</td>
                <td class="text-center">{{$room->RoomTypeName}}</td>

                @if(!is_object($room->Inclusion))
                <td class="text-center">{{$room->Inclusion}}</td>
                @else
                <td>_____</td>
                @endif

                @if(!is_object($room->RoomPromtion))
                <td class="text-center">{{$room->RoomPromtion}}</td>
                @else
                <td class="text-center">_____</td>
                @endif

                <td class="text-center"> <a class="btn green btn-outline sbold" data-toggle="modal" href="#draggable" onclick="getCancellationPolicies({{$room->RoomIndex}})"> عرض </a></td>

                <td class="text-center">{{$room->RoomRate->{"@attributes"}->RoomTax}} $</td>
                <td class="text-center">{{$room->RoomRate->{"@attributes"}->RoomFare}} $</td>
                <td class="text-center">{{$room->RoomRate->{"@attributes"}->TotalFare}} $</td>
                </tr>

                @endforeach
                @endforeach

                @else
                @foreach(json_decode($responseArray) as $room)
                <tr>
                <td class="text-center">{{$room->RoomIndex}}</td>
                <td class="text-center">{{$room->RoomTypeName}}</td>

                @if(!is_object($room->Inclusion))
                <td class="text-center">{{$room->Inclusion}}</td>
                @else
                <td>_____</td>
                @endif

                @if(!is_object($room->RoomPromtion))
                <td class="text-center">{{$room->RoomPromtion}}</td>
                @else
                <td class="text-center">_____</td>
                @endif

                <td class="text-center"> <a class="btn green btn-outline sbold" data-toggle="modal" href="#draggable" onclick="getCancellationPolicies({{$room->RoomIndex}})"> عرض </a></td>

                <td class="text-center">{{$room->RoomRate->{"@attributes"}->RoomTax}} $</td>
                <td class="text-center">{{$room->RoomRate->{"@attributes"}->RoomFare}} $</td>
                <td class="text-center">{{$room->RoomRate->{"@attributes"}->TotalFare}} $</td>
                </tr>

                @endforeach
                @endif

                </table>

                @else
                <div class="note note-danger text-center" style="margin: 60px;">
                <h3>عفوا!! لقد تم انتهاء الجلسة الخاصة بك. من فضلك قم بالرجوع الى صفحة البحث وحاول مرة اخرى لتقوم بفتح جلسة جديدة</h3>
                <p>مدة الجلسة الخاصة بك عند كل عملية بحث هى (30 د)</p>
                </div>
                @endif


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

                $('#loadImg').remove();

                function getCancellationPolicies(RoomIndex) {
                	$('#showPolicies').children().remove();
                	$('#showPolicies').append("<center><img src='"+$('#base_url').val()+"/ring.gif'></center>");
                	$('#showPolicies').load($('#base_url').val() + "/api/hotel/cancellation/policies/{{$SessionId}}?ResultIndex={{$ResultIndex}}&RoomIndex="+RoomIndex);
                }
                </script>