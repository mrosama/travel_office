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
                    <span class="caption-subject font-green bold uppercase">  اضافه مؤسسة / شركة جديده</span>
                </div>
                <a href="{{URL::to('/admin/company')}}" class="btn btn-success btn-sm" style="float: left;">عرض الكل</a>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {!!Form::open(array('url' => 'admin/company','method'=>'post','class'=>'form-horizontal'  , 'files' =>true))!!}
                <div class="form-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-3">اسم المؤسسة / الشركة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('name','',array('placeholder'=>'اسم المؤسسة / الشركة','class'=>'form-control', "autofoucs" => "autofoucs" , "autocomplete" =>"on" ))!!}
                                {!! $errors->first('name','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">طبيعة عمل المؤسسة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('work_type','',array('placeholder'=>'طبيعة عمل المؤسسة','class'=>'form-control', "autofoucs" => "autofoucs" , "autocomplete" =>"on" ))!!}
                                {!! $errors->first('work_type','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">اوقات الدوام
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('work_time','',array('placeholder'=>'اوقات الدوام','class'=>'form-control', "autofoucs" => "autofoucs" , "autocomplete" =>"on" ))!!}
                                {!! $errors->first('work_time','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">اسم صاحب المؤسسة / الشركة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('owner_name','',array('placeholder'=>'اسم صاحب المؤسسة / الشركة','class'=>'form-control', "autofoucs" => "autofoucs" , "autocomplete" =>"on" ))!!}
                                {!! $errors->first('owner_name','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">الدولة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {!!Form::select('country', $all_country , '',array('placeholder'=>'الدولة ....','class'=>'bs-select form-control', 'data-live-search' => 'true' ,  'id' => 'country' , 'onchange' =>'getCity()'))!!}
                            {!! $errors->first('country','<div class="alert alert-danger">:message</div>')!!}                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">المدينة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {!!Form::select('city', [] , '',array('placeholder'=>'اختر الدولة اولا ....','class'=>'bs-select form-control', 'data-live-search' => 'true' ,  'id' => 'city'))!!}
                            {!! $errors->first('city','<div class="alert alert-danger">:message</div>')!!}                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">لوغو المؤسسة / الشركة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::file('logo')!!}
                                {!! $errors->first('logo','<div class="alert alert-danger">:message</div>')!!}           
                                @if(Session::has('logo'))
                                <br><img src="{{URL::to('/').Session::get('logo')}}" width="100px;" height="100px;" />
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">البريد الالكتروني
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::email('email','',array('placeholder'=>'البريد الالكتروني','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('email','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                        <button type="button" id="addNewُEmail" class="btn btn-danger btn-xs" style="margin-bottom:10px">اضف بريد الكتروني اخر</button>
                    </div>
                    <div id="newEmail"></div>




                    <div class="form-group">
                        <label class="control-label col-md-3">الجوال
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('mobile','',array('placeholder'=>'الجوال','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('mobile','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                        <button type="button" id="addOtherMobile" class="btn btn-danger btn-xs" style="margin-bottom:10px">اضف رقم جوال اخر</button>
                    </div>

                    <div id="newMobile"></div>

                    <div class="form-group">
                        <label class="control-label col-md-3">
                        </label>
                        <div class="alert alert-warning col-md-6">
                            مثال : 966123456789
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الهاتف
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('phone','',array('placeholder'=>'الهاتف','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('phone','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                        <button type="button" id="addNewPhone" class="btn btn-danger btn-xs" style="margin-bottom:10px">اضف رقم هاتف اخر</button>
                    </div>

                    <div id="newPhone"></div>

                    <div class="form-group">
                        <label class="control-label col-md-3">السجل تجاري
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('commercial_record','',array('placeholder'=>'السجل التجاري','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('commercial_record','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">صندوق البريد
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('mailbox','',array('placeholder'=>'صندوق البريد','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('mailbox','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">الرمز البريدي
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('postal_code','',array('placeholder'=>' الرمز البريدي','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('postal_code','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">فاكس
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('fax','',array('placeholder'=>' الفاكس','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('fax','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                        <button type="button" id="addNewFax" class="btn btn-danger btn-xs" style="margin-bottom:10px">اضف فاكس اخر</button>
                    </div>

                    <div id="newFax"></div>

                    <div class="form-group">
                        <label class="control-label col-md-3">العنوان
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::textarea('address','',array('placeholder'=>'العنوان','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('address','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">الموقع على الخريطة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-4">
                            {!!Form::text('lat','',array('placeholder'=>'خط العرض','class'=>'form-control', "id" => "lat" ))!!}
                            {!! $errors->first('lat','<div class="alert alert-danger">:message</div>')!!}                            

                        </div>
                        <div class="col-md-4">
                            {!!Form::text('lang','',array('placeholder'=>'خط الطول','class'=>'form-control', "id" => "lang" ))!!}
                            {!! $errors->first('lang','<div class="alert alert-danger">:message</div>')!!}                            

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3" >
                            <font color="red" style="float:right;direction:rtl;">اسحب المؤشر حتى يتم تحديد الموقع على الخريطة</font>
                        </label>
                        <div class="col-md-4">
                            <div id="map" style="width: 650px;height: 400px;"></div>
                        </div>
                    </div>



                    <hr>
                    بيانات الدخول
                    <hr>

                    <div class="form-group">
                        <label class="control-label col-md-3">اسم المستخدم
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('userName','',array('placeholder'=>'اسم المستخدم','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('userName','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">كلمة المرور
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
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
                        <div class="col-md-8">
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
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5,
            center: new google.maps.LatLng(24.739, 46.700),
        });

        var myMarker = new google.maps.Marker({
            position: new google.maps.LatLng(24.739, 46.700),
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