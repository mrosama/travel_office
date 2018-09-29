                @if($responseArray != "{}")
                <table class="table table-hover table-bordered" style="margin-top: 20px">
                        <tr>
                                <th class="text-center">من تاريخ</th>
                                <th class="text-center">الى تاريخ</th>
                                <th class="text-center">تكلفة الالغاء</th>
                        </tr>
                        @foreach(json_decode($responseArray)->CancelPolicy as $policy)
                        <tr>

                               @if(property_exists($policy , "@attributes"))
                               <td class="text-center">{{$policy->{"@attributes"}->FromDate}}</td>
                               <td class="text-center">{{$policy->{"@attributes"}->ToDate}}</td>
                               <td class="text-center">
                                {{$policy->{"@attributes"}->CancellationCharge}}@if($policy->{"@attributes"}->ChargeType == "Percentage")%@else$@endif
                                @else
                                <td class="text-center">{{$policy->FromDate}}</td>
                                <td class="text-center">{{$policy->ToDate}}</td>
                                <td class="text-center">
                                {{$policy->CancellationCharge}}@if($policy->ChargeType == "Percentage")%@else$@endif
                                        @endif
                                </td>
                        </tr>

                        @endforeach
                </table>
                <p style="text-align: center;color:cadetblue" dir="ltr">{{json_decode($responseArray)->DefaultPolicy}}</p>
                @else
                <div class="note note-danger text-center" style="margin: 15px;">
                        <h5>عفوا!! لقد تم انتهاء الجلسة الخاصة بك. من فضلك قم بالرجوع الى صفحة البحث وحاول مرة اخرى لتقوم بفتح جلسة جديدة</h5>
                        <p>مدة الجلسة الخاصة بك عند كل عملية بحث هى (30 د)</p>
                </div>
                @endif

                <script type="text/javascript">
                        $('#loadImgPolicy').remove();
                </script>