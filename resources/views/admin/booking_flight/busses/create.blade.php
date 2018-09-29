@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
@section('CssLinks')
<link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@stop

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form ">
            <div class="portlet-title">
                <div class="caption" style="float:right">
                    <i class="fa fa-user font-green"></i>
                    <span class="caption-subject font-green bold uppercase">  اضافه باص جديد</span>
                </div>
                <a href="{{URL::to('/admin/busses')}}" class="btn btn-success pull-right">عرض الباصات</a>
            </div>

            <div class="portlet-body">

                <!-- BEGIN FORM-->
                {{Form::open(array('route' => 'admin.busses.store', 'method'=>'post' , 'files'=>'true' , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
                <div class="form-body">

                    @if(Session::has('global_s'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('global_s')}}
                    </div>
                    @endif

                    <div class="form-group">
                        <center>
                            <label for="inputEmail3" class="col-sm-3 control-label">صورة الباص</label>
                            <div class="col-md-8">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 265px; height: 200px;">
                                        <img src="{{URL::to('/')}}/noimage.gif" alt="" width="265" />
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 265px; max-height: 200px;">
                                    </div>
                                    <div>
                                        <span class="btn  btn-large btn-primary btn-file">
                                            <span class="fileinput-new">
                                                تغيير الصورة </span>
                                            <span class="fileinput-exists">
                                                تغيير </span>
                                            <input type="file" name="photo"  class="btn btn-danger">
                                        </span>
                                        <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                                            مسح </a>
                                    </div>
                                    <span style="color:red">{{$errors->first('photo')}}</span>
                                </div>
                            </div>
                        </center>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">اختر الفرع</label>
                        <div class="col-md-7">
                            {{Form::select('branch_id' , $bussesBranches , '' , ["autofocus"=>"autofocus" , "id" => "branch_id" , "autocompletebranch_id" =>"on" , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'placeholder'=>'من فضلك اختر الفرع' , 'required'])}}
                            <font color="red">{{$errors->first('branch_id')}}</font><br>
                        </div>
                        <div class="col-md-2">
                            <a href="{{URL::to('admin/busses/branches/create')}}" target="_blank" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة فرع جديد</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">مزود الباص</label>
                        <div class="col-md-7">
                            <select id="supplier_id" name="supplier_id" class="form-control" data-live-search="true" data-size="8">
                                <option disabled="" selected="" value=""> اختر الفرع اولا ...</option>
                            </select>
                            <font color="red">{{$errors->first('supplier_id')}}</font><br>

                        </div>
                        <div class="col-md-2">
                            <a href="{{URL::to('admin/busses/suppliers/create')}}" target="_blank" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة مزود جديد</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">رقم الباص</label>
                        <div class="col-md-8">
                            {{Form::text('number' , '' , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on"  , 'required'])}}
                            <font color="red">{{$errors->first('number')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">موديل الباص</label>
                        <div class="col-md-8">
                            {{Form::text('model' , '' , ['class'=>'form-control' , "autocomplete" =>"on"  , 'required'])}}
                            <font color="red">{{$errors->first('model')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">لون الباص</label>
                        <div class="col-md-8">
                            {{Form::text('color' , '' , ['class'=>'form-control' , "autocomplete" =>"on"  , 'required'])}}
                            <font color="red">{{$errors->first('color')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">حجم الباص</label>
                        <div class="col-md-8">
                            {{Form::select('size' , ['كبير 50 مقعد'=>'كبير 50 مقعد' ,'وسط 25 مقعد'=>'وسط 25 مقعد' , 'صغير 12 مقعد'=>'صغير 12 مقعد'] , '' , [ "class"=>"bs-select form-control" , "data-live-search"=>"true" , "autocomplete" =>"on" , 'placeholder'=>'من فضلك اختر حجم الباص' , 'required'])}}
                            <font color="red">{{$errors->first('size')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">رقم الرخصة</label>
                        <div class="col-md-8">
                            {{Form::text('license_number' , '' , ['class'=>'form-control' , "autocomplete" =>"on"  , 'required'])}}
                            <font color="red">{{$errors->first('license_number')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">رقم كارت التشغيل</label>
                        <div class="col-md-8">
                            {{Form::text('run_card_number' , '' , ['class'=>'form-control' , "autocomplete" =>"on"  , 'required'])}}
                            <font color="red">{{$errors->first('run_card_number')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">تصريح الحج</label>
                        <div class="col-md-8">
                            {{Form::text('hajj_permit' , '' , ['class'=>'form-control' , "autocomplete" =>"on"  , 'required'])}}
                            <font color="red">{{$errors->first('hajj_permit')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">رقم التصريح</label>
                        <div class="col-md-8">
                            {{Form::text('permit_number' , '' , ['class'=>'form-control' , "autocomplete" =>"on"  , 'required'])}}
                            <font color="red">{{$errors->first('permit_number')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">مدة التصريح</label>
                        <div class="col-md-8">
                            {{Form::text('permit_duration' , '' , ['class'=>'form-control' , "autocomplete" =>"on"  , 'required'])}}
                            <font color="red">{{$errors->first('permit_duration')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ التصريح</label>
                        <div class="col-md-8">
                            {{Form::date('permit_date' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required' ])}}
                            <font color="red">{{$errors->first('permit_date')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ انتهاء التصريح</label>
                        <div class="col-md-8">
                            {{Form::date('permit_end_date' , '' , ['class'=>'form-control' , "autocomplete" =>"on"  , 'required'])}}
                            <font color="red">{{$errors->first('permit_end_date')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">ملاحظات</label>
                        <div class="col-md-8">
                            {{Form::textarea('notes' , '' , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('notes')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group" style="min-height: 25px;">
                        {{ Form::label('map','الاحداثيات',array('class'=>'control-label col-md-3')) }}
                        <div class="col-md-8">
                            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=ar"></script>
                            <script type="text/javascript">
var marker;
var lat;
var lng;
var map;

function updateMarkerPosition(latLng) {
    document.getElementById('lat').value = latLng.lat();
    document.getElementById('lng').value = latLng.lng();
}

function placeMarker(location) {
    if (marker) {
        marker.setPosition(location);
    } else {
        marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }
}

function initialize() {
    var latLng = new google.maps.LatLng("20.5904603", "44.9751636");

    map = new google.maps.Map(document.getElementById('mapCanvas'), {
        zoom: 5,
        center: latLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var marker = new google.maps.Marker({
        position: latLng,
        title: "Hello World!"
    });
    marker.setMap(map);

    updateMarkerPosition(latLng);

    google.maps.event.addListener(map, 'click', function (event) {
        marker.setMap(null);
        placeMarker(event.latLng);
        updateMarkerPosition(event.latLng);
    });

}

google.maps.event.addDomListener(window, 'load', initialize);
                            </script>

                            <div id="mapCanvas" style="width:100%; height:300px;"></div>
                            {{ Form::hidden('latitude','' ,['id' => 'lat']) }}
                            {{ Form::hidden('longitude','' ,['id' => 'lng']) }}
                        </div>
                    </div>

                    <div class="clearfix"></div>


                    <div class="form-actions">
                        <div class="row">
                            <div class="text-center">
                                <button type="submit" class="btn green">حفظ</button>
                                <button type="reset" class="btn default">الغاء </button>
                            </div>
                        </div>
                    </div>

                    {{Form::close()}}
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>

    @section('JsScripts')

    <script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    @stop

    @stop