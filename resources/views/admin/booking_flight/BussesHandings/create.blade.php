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
                    <span class="caption-subject font-green bold uppercase">  الرحلات السياحية</span> | <span class="caption-subject font-green  uppercase">  اضافه تسليم باص لسائق</span>
                </div>
                <a href="{{URL::to('/admin/busses/Handings')}}" class="btn btn-success pull-right">عرض الكل</a>
            </div>

            <div class="portlet-body">

                <!-- BEGIN FORM-->
                {{Form::open(array('route' => 'admin.busses.Handings.store', 'method'=>'post' , 'files'=>'true' , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
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


                    <div class="form-group">
                        <label class="control-label col-md-3">اختر اسم السائق</label>
                        <div class="col-md-8">
                            {{Form::select('driverID' , $drivers , '' , [ "class"=>"bs-select form-control" , 'id' => 'driverID' , "data-live-search"=>"true" , "autocomplete" =>"on" , 'placeholder'=>'من فضلك اختر اسم السائق' , 'required'])}}
                            <font color="red">{{$errors->first('driverID')}}</font><br>
                            <div id="driverInfo" style="display: none" class="well">
                                صورة السائق: <img class="img-circle" id="driverImage" width="50" height="50" src="http://placehold.it/200">
                                <br><br>اسم السائق: <span id="driverName"></span>
                                <br><br>تاريخ الميلاد: <span id="age"></span>
                                <br><br>رقم الرخصة: <span id="cardNumber"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">اختر الباص </label>
                        <div class="col-md-8">
                            {{Form::select('busID' , $busses , '' , [ "class"=>"bs-select form-control" , 'id' => 'busID' , "data-live-search"=>"true" , "autocomplete" =>"on" , 'placeholder'=>'من فضلك اختر  الباص' , 'required'])}}
                            <font color="red">{{$errors->first('busID')}}</font><br>
                            <div id="busInfo" style="display: none" class="well">
                                رقم الرخصة: <span id="license_number"></span>
                                <br><br>الموديل: <span id="model"></span>
                                <br><br>الحجم: <span id="size"></span>
                                <br><br>اللون: <span id="color"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3"> استلم كوبون بنزين </label>
                        <div class="col-md-8">
                            {{Form::select('benzeneCoupon' , ['نعم' => 'نعم' , 'لا' => 'لا'] , '' , [ "class"=>"bs-select form-control" , "autocomplete" =>"on" , 'placeholder'=>'هل تم استلام كوبون بنزين' , 'required'])}}
                            <font color="red">{{$errors->first('benzeneCoupon')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">مبلغ كوبون البنزين</label>
                        <div class="col-md-8">
                            {{Form::number('amountCoupon' , '' , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('amountCoupon')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">عدد الكيلومترات عند تسليمه للسائق</label>
                        <div class="col-md-8">
                            {{Form::text('kiloMeter' , '' , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('kiloMeter')}}</font><br>
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