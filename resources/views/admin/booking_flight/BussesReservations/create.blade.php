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
                    <span class="caption-subject font-green bold uppercase">  الرحلات السياحية</span> | <span class="caption-subject font-green  uppercase">  اضافه حجز باص </span>
                </div>
                <a href="{{URL::to('/admin/busses/reservations')}}" class="btn btn-success pull-right">عرض الكل</a>
            </div>

            <div class="portlet-body">

                <!-- BEGIN FORM-->
                {{Form::open(array('route' => 'admin.busses.reservations.store', 'method'=>'post' , 'files'=>'true' , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
                <div class="form-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('error')}}
                    </div>
                    @endif


                    <h3>بيانات العميل</h3><br>
                    <div class="form-group">
                        <label class="control-label col-md-3">اختر اسم العميل</label>
                        <div class="col-md-7">
                            {{Form::select('clientID' , $clients , '' , [ "class"=>"bs-select form-control" , 'id' => 'clientID' , "data-live-search"=>"true" , "autocomplete" =>"on" , 'placeholder'=>'من فضلك اختر اسم العميل' , 'required'])}}
                            <font color="red">{{$errors->first('clientID')}}</font><br>
                            <div id="clientInfo" style="display: none" class="well">
                                صورة العميل: <img class="img-circle" id="clientImage" width="50" height="50" src="http://placehold.it/200">
                                <br><br>تاريخ الميلاد: <span id="birth_date"></span>
                                <br><br>البريد الالكتروني : <span id="email_address"></span>
                                <br><br>اسم الام : <span id="mother_name"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <a href="" class="btn btn-primary">اضافة عميل جديد</a>
                        </div>
                    </div>


                    <h3>بيانات الباص</h3><br>
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
                        <label class="control-label col-md-3"> اختر رقم الباص</label>
                        <div class="col-md-7">
                            <select id="bus_id" name="bus_id" class="form-control" data-live-search="true" data-size="8">
                                <option disabled="" selected="" value=""> اختر مزود الباص اولا ...</option>
                            </select>
                            <font color="red">{{$errors->first('bus_id')}}</font><br>
                        </div>
                        <div class="col-md-2">
                            <a href="{{URL::to('admin/busses/create')}}" target="_blank" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة باص جديد</a>
                        </div>
                    </div>


                    <h3>بيانات الحجز</h3><br>
                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ بداية الحجز</label>
                        <div class="col-md-8">
                            {{Form::text('startDate' , '' , ['class'=>'form-control date-picker' , "data-date-format"=>"dd/mm/yyyy"  , 'required'])}}
                            <font color="red">{{$errors->first('startDate')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">عدد ايام الحجز</label>
                        <div class="col-md-8">
                            {{Form::text('dayNumber' , '' , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('dayNumber')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ نهاية الحجز</label>
                        <div class="col-md-8">
                            {{Form::text('endDate' , '' , ['class'=>'form-control date-picker' , "data-date-format"=>"dd/mm/yyyy", 'required'])}}
                            <font color="red">{{$errors->first('endDate')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">دولة الانطلاق</label>
                        <div class="col-md-8">
                            {{Form::select('countryDeparture' , $countries , '' , [ "class"=>"bs-select form-control", "id" => "countryDeparture" , "data-live-search"=>"true" , "autocomplete" =>"on" , 'placeholder'=>'اختر دولة الانطلاق' , 'required'])}}
                            <font color="red">{{$errors->first('kiloMeter')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">مدينة الانطلاق</label>
                        <div class="col-md-8">                            
                            <select id="cityDeparture" name="cityDeparture" class="form-control" data-live-search="true" data-size="8">
                                <option disabled="" selected="" value=""> اختر الدولة اولا ...</option>
                            </select>
                            <font color="red">{{$errors->first('cityDeparture')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">مكان الانطلاق</label>
                        <div class="col-md-8">
                            {{Form::text('placeDeparture' , '' , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('kiloMeter')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">احداثيات مكان الانطلاق</label>
                        <div class="col-md-4">
                            {{Form::text('longitudeDeparture' , '' , ['class'=>'form-control' , 'required' , 'placeholder' => 'خط الطول'])}}
                            <font color="red">{{$errors->first('longitudeDeparture')}}</font><br>
                        </div>
                        <div class="col-md-4">
                            {{Form::text('latitudeDeparture' , '' , ['class'=>'form-control' , 'required' , 'placeholder' => 'خط العرض'])}}
                            <font color="red">{{$errors->first('latitudeDeparture')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">دولة الوصول</label>
                        <div class="col-md-8">
                            {{Form::select('countryArrival' , $countries , '' , [ "class"=>"bs-select form-control", "id" => "countryArrival" , "data-live-search"=>"true" , "autocomplete" =>"on" , 'placeholder'=>'اختر دولة الوصول' , 'required'])}}
                            <font color="red">{{$errors->first('countryArrival')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">مدينة الوصول</label>
                        <div class="col-md-8">
                            <select id="cityArrival" name="cityArrival" class="form-control" data-live-search="true" data-size="8">
                                <option disabled="" selected="" value=""> اختر الدولة اولا ...</option>
                            </select>
                            <font color="red">{{$errors->first('cityArrival')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">مكان الوصول</label>
                        <div class="col-md-8">
                            {{Form::text('placeArrival' , '' , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('kiloMeter')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">احداثيات مكان الوصول</label>
                        <div class="col-md-4">
                            {{Form::text('longitudeArrival' , '' , ['class'=>'form-control' , 'required' , 'placeholder' => 'خط الطول'])}}
                            <font color="red">{{$errors->first('longitudeArrival')}}</font><br>
                        </div>
                        <div class="col-md-4">
                            {{Form::text('latitudeArrival' , '' , ['class'=>'form-control' , 'required' , 'placeholder' => 'خط العرض'])}}
                            <font color="red">{{$errors->first('latitudeArrival')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">ملاحظات</label>
                        <div class="col-md-8">
                            {{Form::textarea('notes' , '' , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('notes')}}</font><br>
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