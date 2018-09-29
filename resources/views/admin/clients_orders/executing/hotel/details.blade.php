@extends ('admin.layouts.master')
@section('content')

<link href="{{URL::to('/')}}/assets/global/plugins/cubeportfolio/css/cubeportfolio.css" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/assets/global/plugins/cubeportfolio/css/cubeportfolio.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    li.marg{margin-bottom: 10px;}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-hotel font-green"></i>
                    <span class="caption-subject bold font-green uppercase"> بيانات فندق</span>
                </div>
            </div>
            <div class="portlet-body">

                @if($responseArray != "{}")
                <div class="timeline">

                    <div class="timeline-item">
                        <div class="timeline-badge">
                            <div class="timeline-icon">
                                <i class="fa fa-star-half-o font-red-intense"></i>
                            </div>
                        </div>
                        <div class="timeline-body">
                            <div class="timeline-body-arrow"> </div>
                            <div class="timeline-body-head">
                                <div class="timeline-body-head-caption">
                                    <span class="timeline-body-alerttitle font-green-haze">بيانات الفندق <font size="4" color="darkcyan">{{json_decode($responseArray)->{"@attributes"}->HotelName }}</font></span>
                                </div>
                            </div>
                            <div class="timeline-body-content">
                                <span class="font-grey-cascade">
                                   <ul dir="ltr" style="list-style:none;float: left;">

                                      @if(property_exists(json_decode($responseArray) , "Address"))
                                      <li class="marg">     <i class="f fa fa-map-marker" style="color:darkgray;float:left"></i>{{json_decode($responseArray)->Address}}</li>
                                      @endif

                                      @if(property_exists(json_decode($responseArray) , "PhoneNumber"))
                                      <li class="marg"><i class="fa fa-phone"></i>{{json_decode($responseArray)->PhoneNumber}}</li>
                                      @endif


                                      @if(property_exists(json_decode($responseArray) , "FaxNumber"))
                                      <li class="marg"><i class="fa fa-fax"></i>{{json_decode($responseArray)->FaxNumber}}</li>
                                      @endif

                                      @if(property_exists(json_decode($responseArray) , "HotelRating"))
                                      <li class="marg"><i class="fa fa-star inbox-started" style="color:#fd7b12"></i>{{json_decode($responseArray)->{"@attributes"}->HotelRating }}</li>
                                      @endif

                                      @if(property_exists(json_decode($responseArray) , "TripAdvisorRating"))
                                      <li class="marg"><i class="fa fa-heart" style="color:cadetblue"></i>{{json_decode($responseArray)->TripAdvisorRating}}</li>
                                      @endif
                                  </ul>

                              </span>
                          </div>
                      </div>
                  </div>

                  @if(property_exists(json_decode($responseArray) , "ImageUrls"))
                  <div class="timeline-item">
                    <div class="timeline-badge">
                        <div class="timeline-icon">
                            <i class="icon-camera font-red-intense"></i>
                        </div>
                    </div>
                    <div class="timeline-body">
                        <div class="timeline-body-arrow"> </div>
                        <div class="timeline-body-head">
                            <div class="timeline-body-head-caption">
                                <span class="timeline-body-alerttitle font-green-haze">معرض الصور</span>
                            </div>
                        </div>
                        <div class="timeline-body-content">
                            <span class="font-grey-cascade">

                             <div class="portfolio-content portfolio-1">
                                <div id="js-grid-juicy-projects" class="cbp">

                                 @foreach(json_decode($responseArray)->ImageUrls as $images)
                                 @foreach($images as $image)

                                 <div class="cbp-item web-design logos">
                                    <div class="cbp-caption">
                                        <div class="cbp-caption-defaultWrap">
                                            <img src="{{$image}}" alt=""> </div>
                                            <div class="cbp-caption-activeWrap">
                                                <div class="cbp-l-caption-alignCenter">
                                                    <div class="cbp-l-caption-body">
                                                        <a href="{{$image}}" class="cbp-lightbox cbp-l-caption-buttonRight btn red uppercase btn red uppercase" data-title="World Clock Widget<br>by Paul Flavius Nechita" style="padding: 8px;">عرض الصورة</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endforeach
                                </div>
                            </div>

                        </span>
                    </div>
                </div>
            </div>
            @endif


            <div class="timeline-item">
                <div class="timeline-badge">
                    <div class="timeline-icon">
                        <i class="fa fa-comments font-red-intense"></i>
                    </div>
                </div>
                <div class="timeline-body">
                    <div class="timeline-body-arrow"> </div>
                    <div class="timeline-body-head">
                        <div class="timeline-body-head-caption">
                            <span class="timeline-body-alerttitle font-green-haze">معلومات عن الفندق</span>
                        </div>
                    </div>
                    <div class="timeline-body-content">
                        <span class="font-grey-cascade" style="float:left;text-align:left" dir="ltr"> 
                           {{json_decode($responseArray)->Description}}
                       </span>
                   </div>
               </div>
           </div>

           <div class="timeline-item">
            <div class="timeline-badge">
                <div class="timeline-icon">
                    <i class="fa fa-hotel font-red-intense"></i>
                </div>
            </div>
            <div class="timeline-body">
                <div class="timeline-body-arrow"> </div>
                <div class="timeline-body-head">
                    <div class="timeline-body-head-caption">
                        <span class="timeline-body-alerttitle font-green-haze">الغرف المتاحة</span>
                    </div>
                </div>
                <div class="timeline-body-content">
                    <center>
                        {{HTML::image('ring.gif' ,'' , ['id'=>"loadImg"])}}
                    </center>
                    <span class="font-grey-cascade">
                        <div id="availableRooms"> </div>
                    </span>
                </div>
            </div>
        </div>

        @if(!is_object(json_decode($responseArray)->HotelPolicy))
        <div class="timeline-item">
            <div class="timeline-badge">
                <div class="timeline-icon">
                    <i class="fa fa-gavel font-red-intense"></i>
                </div>
            </div>
            <div class="timeline-body">
                <div class="timeline-body-arrow"> </div>
                <div class="timeline-body-head">
                    <div class="timeline-body-head-caption">
                        <span class="timeline-body-alerttitle font-green-haze">سياسة الفندق</span>
                    </div>
                </div>
                <div class="timeline-body-content">
                    <span class="font-grey-cascade" style="float:left;text-align:left" dir="ltr">
                       {{json_decode($responseArray)->HotelPolicy}}
                   </span>
               </div>
           </div>
       </div>
       @endif


       <div class="timeline-item">
        <div class="timeline-badge">
            <div class="timeline-icon">
                <i class="fa fa-life-ring font-red-intense"></i>
            </div>
        </div>
        <div class="timeline-body">
            <div class="timeline-body-arrow"> </div>
            <div class="timeline-body-head">
                <div class="timeline-body-head-caption">
                    <span class="timeline-body-alerttitle font-green-haze">مرافق الفندق</span>
                </div>
            </div>
            <div class="timeline-body-content">
                <span class="font-grey-cascade">
                   <ul dir="ltr">
                       <?php $i=0 ?>
                       <div style="float:left;padding-right: 50px">
                           @foreach(json_decode($responseArray)->HotelFacilities as $HotelFacilities)
                           @foreach($HotelFacilities as $HotelFacility)
                           @if(++$i==50)
                           <?php $i=0 ?>
                       </div>
                       <div style="float:left;padding-right: 50px" >
                           <li>{{$HotelFacility}}</li>
                           @else
                           <li>{{$HotelFacility}}</li>
                           @endif

                           @endforeach
                           @endforeach
                       </ul>

                   </span>
               </div>
           </div>
       </div>

       @if(property_exists(json_decode($responseArray) , "Attractions"))
       <div class="timeline-item">
        <div class="timeline-badge">
            <div class="timeline-icon">
                <i class="fa fa-heartbeat font-red-intense"></i>
            </div>
        </div>
        <div class="timeline-body">
            <div class="timeline-body-arrow"> </div>
            <div class="timeline-body-head">
                <div class="timeline-body-head-caption">
                    <span class="timeline-body-alerttitle font-green-haze">المناطق الجذابة بالفندق</span>
                </div>
            </div>
            <div class="timeline-body-content">
                <span class="font-grey-cascade">
                   <ul dir="ltr">
                       <?php $i=0 ?>
                       <div style="float:left;padding-right: 50px">
                        @if(!is_array(json_decode($responseArray)->Attractions->Attraction))
                        <li>{{json_decode($responseArray)->Attractions->Attraction}}</li>
                        @else
                        @foreach(json_decode($responseArray)->Attractions->Attraction as $attraction)
                    @if(!is_object($attraction))
                        @if(++$i==50)
                        <?php $i=0 ?>
                    </div>
                    <div style="float:left;padding-right: 50px" >
                       <li>{{$attraction}}</li>
                       @else
                       <li>{{$attraction}}</li>
                       @endif
                       @endif
                       @endforeach
                       @endif
                   </ul>

               </span>
           </div>
       </div>
   </div>
   @endif

   @if(!is_object(json_decode($responseArray)->Map))
   <div class="timeline-item">
    <div class="timeline-badge">
        <div class="timeline-icon">
            <i class="fa fa-map font-red-intense"></i>
        </div>
    </div>
    <div class="timeline-body">
        <div class="timeline-body-arrow"> </div>
        <div class="timeline-body-head">
            <div class="timeline-body-head-caption">
                <span class="timeline-body-alerttitle font-green-haze">موقع الفندق</span>
            </div>
        </div>
        <div class="timeline-body-content">
            <span class="font-grey-cascade">

             <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABaErEWtegygkQxPJh_t0oMIxHjbfPJw4&libraries=places"></script>

             <div id="mapholder"></div>

             <script type="text/javascript"> 
              function initialize() {
                 pyrmont    = new google.maps.LatLng({{str_replace("|" , "," , json_decode($responseArray)->Map)}});
                 mapholder  = document.getElementById('mapholder');
                 mapholder.style.height='350px';
                 mapholder.style.width='100%';
                 mapholder.style.alignItems='center';

                 var myOptions={
                    center:pyrmont,
                    zoom:17,
                    mapTypeId:google.maps.MapTypeId.ROADMAP,
                    mapTypeControl:true,
                    navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
                };

                var map    = new google.maps.Map(document.getElementById("mapholder"),myOptions);

                var marker = new google.maps.Marker({
                    position: pyrmont,
                    map     : map,
                    title   : "موقع الفندق",
                });
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script> 

    </span>
</div>
</div>
</div>
@endif

</div>

@else
<div class="note note-danger text-center" style="margin: 60px;">
    <h3>عفوا!! لقد تم انتهاء الجلسة الخاصة بك. من فضلك قم بالرجوع الى صفحة البحث وحاول مرة اخرى لتقوم بفتح جلسة جديدة</h3>
    <p>مدة الجلسة الخاصة بك عند كل عملية بحث هى (30 د)</p>
</div>
@endif

</div>
</div>
</div>
</div>

@section('JsScripts')
<script src="{{URL::to('/')}}/assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/pages/scripts/portfolio-1.min.js" type="text/javascript"></script>
<script type="text/javascript">
        $('#availableRooms').load($('#base_url').val() + "/api/hotel/available/rooms/{{$SessionId}}/{{$HotelCode}}?ResultIndex=" + {{$ResultIndex}});
</script>

@stop

@stop