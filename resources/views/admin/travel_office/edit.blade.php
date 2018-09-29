@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bubble font-green"></i>
                    <span class="caption-subject font-green bold uppercase">  تعديل بيانات المكتب </span>
                </div>

            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {{Form::open(['route' =>['admin.travel_offices.update' , $office->id], 'method' => 'PATCH' , 'class' =>'form-horizontal'  , 'files' =>true])}}
                <div class="form-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-3">اسم المكتب
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('name', $office->name ,array('placeholder'=>'اسم المؤسسة / الشركة','class'=>'form-control', "autofoucs" => "autofoucs" , "autocomplete" =>"on" ))!!}
                                {!! $errors->first('name','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">اوقات الدوام
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('work_time', $office->work_time ,array('placeholder'=>'اوقات الدوام','class'=>'form-control' , "autocomplete" =>"on" ))!!}
                                {!! $errors->first('work_time','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">اسم صاحب المؤسسة / الشركة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('owner_name', $office->owner_name ,array('class'=>'form-control' , "autocomplete" =>"on" ))!!}
                                {!! $errors->first('owner_name','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">الدولة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <select name='country' class="bs-select form-control"  data-live-search = 'true' id='country' onchange='getCity()'>
                                @if($office->countryName)
                                <option value="{{$office->country}}">{{$office->countryName->name}}</option>
                                @endif
                                @foreach($all_country as $row)
                                <option value="{{$row->code}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">المدينة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <select name='city' class="bs-select form-control"  data-live-search = 'true' id='city' >
                                @if($office->cityName)
                                <option value="{{$office->city}}">{{$office->cityName->name}}</option>
                                @endif
                                @foreach($all_city as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('city','<div class="alert alert-danger">:message</div>')!!}                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">لوغو المؤسسة / الشركة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::file('logo')!!}
                                {!! $errors->first('logo','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                        <div class="col-md-3">
                            {{HTML::image($office->logo , '' , ['width' => '75px'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">البريد الالكتروني
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::email('email',$office->email ,array('placeholder'=>'البريد الالكتروني','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('email','<div class="alert alert-danger">:message</div>')!!}                           
                            </div>
                        </div>
                        <button type="button" id="addNewُEmail" class="btn btn-danger btn-xs" style="margin-bottom:10px">اضف بريد الكتروني اخر</button>

                    </div>
                    @if($emails)
                    @foreach($emails as $row)
                    <div class="form-group">
                        <label class="control-label col-md-3">
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::email('emails[]',$row->email ,array('placeholder'=>'البريد الالكتروني','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div id="newEmail"></div>
                    <div class="form-group">
                        <label class="control-label col-md-3">الجوال
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('mobile',$office->mobile ,array('placeholder'=>'الجوال','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('mobile','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                        <button type="button" id="addOtherMobile" class="btn btn-danger btn-xs" style="margin-bottom:10px">اضف رقم جوال اخر</button>
                    </div>
                    @if($mobiles)
                    @foreach($mobiles as $row)
                    <div class="form-group">
                        <label class="control-label col-md-3">
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('mobiles[]',$row->number ,array('placeholder'=>'الجوال','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div id="newMobile"></div>
                    <div class="form-group">
                        <label class="control-label col-md-3">
                        </label>
                        <div class="alert alert-warning col-md-7">
                            مثال : 966123456789
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">الهاتف
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('phone',$office->phone ,array('placeholder'=>'الهاتف','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('phone','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                        <button type="button" id="addNewPhone" class="btn btn-danger btn-xs" style="margin-bottom:10px">اضف رقم هاتف اخر</button>
                    </div>

                    @if($phones)
                    @foreach($phones as $row)
                    <div class="form-group">
                        <label class="control-label col-md-3">
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('phones[]',$row->number ,array('placeholder'=>'الهاتف','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif


                    <div id="newPhone"></div>


                    <div class="form-group">
                        <label class="control-label col-md-3">السجل تجاري
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('commercial_record', $office->commercial_record ,array('placeholder'=>'السجل التجاري','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('commercial_record','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">صندوق البريد
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('mailbox', $office->mailbox ,array('placeholder'=>'صندوق البريد','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('mailbox','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الرمز البريدي
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('postal_code', $office->postal_code ,array('placeholder'=>' الرمز البريدي','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('postal_code','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">فاكس
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('fax',$office->fax ,array('placeholder'=>' الفاكس','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('fax','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                        <button type="button" id="addNewFax" class="btn btn-danger btn-xs" style="margin-bottom:10px">اضف فاكس اخر</button>
                    </div>

                    @if($faxs)
                    @foreach($faxs as $row)
                    <div class="form-group">
                        <label class="control-label col-md-3">فاكس
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('faxs[]',$row->fax ,array('placeholder'=>' الفاكس','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif


                    <div id="newFax"></div>


                    <div class="form-group">
                        <label class="control-label col-md-3">العنوان
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::textarea('address', $office->address ,array('placeholder'=>'العنوان','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('address','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">الموقع على الخريطة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-4">
                            {!!Form::text('lat', $office->lat ,array('placeholder'=>'lat','class'=>'form-control', "id" => "lat" ))!!}
                            {!! $errors->first('lat','<div class="alert alert-danger">:message</div>')!!}                            

                        </div>
                        <div class="col-md-4">
                            {!!Form::text('lang', $office->lang ,array('placeholder'=>'lang','class'=>'form-control', "id" => "lang" ))!!}
                            {!! $errors->first('lang','<div class="alert alert-danger">:message</div>')!!}                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" >
                            <font color="red" style="float:right;direction:rtl;">اسحب المؤشر حتى يتم تحديد الموقع على الخريطة</font>
                        </label>
                        <div class="col-md-4">
                            <div id="map" style="width: 600px;height: 400px;"></div>
                        </div>
                    </div>
                    <hr>
                    بيانات الدخول
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-md-3">اسم المستخدم
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('userName', $office->userName ,array('placeholder'=>'اسم المستخدم','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('userName','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">كلمة المرور
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::password('password',array('placeholder'=>'كلمة المرور','class'=>'form-control' ))!!}
                                {!! $errors->first('password','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">تأكيد كلمة المرور
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::password('password_confirmation',array('placeholder'=>'تأكيد كلمة المرور','class'=>'form-control' ))!!}
                                {!! $errors->first('password_confirmation','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">حفظ</button>
                            <button type="button" class="btn default">{!! link_to_route('admin.travel_offices.index', 'عودة')  !!} </button>

                        </div>
                    </div>
                </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>

@section('JsScripts')
<script type="text/javascript">
    function getCity()
    {
        var country = $('#country').val();
        var baseurl = document.getElementById('baseurl').value;
        $.ajax({
            url: baseurl + '/city/getCity',
            type: 'GET',
            data: {country},
            success: function (data) {
                console.log(data);
                $('#city').empty();
                if (data == '')
                {
                    var empty = "<option selected disabled>عفوا لا يوجد مدن لهذه الدولة!</option>";
                    $('#city').html(empty);
                } else
                {
                    $.each(data, function (i, val)
                    {
                        $('#city').append('<option value=' + val.id + '>' + val.name + '</option>')
                    });
                }
                $('#city').selectpicker('refresh');
            },
            error: function (e) {
                console.log(e);
            }
        });
    }
</script>



<!-- Google Map -->
<script type="text/javascript">
    function initMap() {

        var lat = $('#lat').val();
        var lang = $('#lang').val();


        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: new google.maps.LatLng(lat, lang),
        });

        var myMarker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, lang),
            draggable: true
        });

        google.maps.event.addListener(myMarker, 'dragend', function (evt) {
            //document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
            document.getElementById('lat').value = evt.latLng.lat().toFixed(3);
            document.getElementById('lang').value = evt.latLng.lng().toFixed(3);
        });

        google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
            //document.getElementById('current').value = '<p>Currently dragging marker...</p>';			
        });

        map.setCenter(myMarker.position);
        myMarker.setMap(map);
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQEAnGc4p12Ad47fvDPj-7IXXmzV9f7-Q&callback=initMap">
</script>
<!-- end google map -->
@stop

@stop