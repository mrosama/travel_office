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
                    <span class="caption-subject font-green bold uppercase">  اضافه سائق جديد</span>
                </div>
            </div>

            <div class="portlet-body">

                <!-- BEGIN FORM-->
                {{Form::open(array('route' => 'admin.drivers.store', 'method'=>'post' , 'files'=>'true' , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
                <div class="form-body">

                    @if(Session::has('global_s'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('global_s')}}
                    </div>
                    @endif

                    <div class="form-group">
                        <center>
                            <label for="inputEmail3" class="col-sm-3 control-label">صورة السائق</label>
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
                        <label class="control-label col-md-3">مزود الباص</label>
                        <div class="col-md-8">
                            {{Form::select('supplier_id' , $busses_suppliers , '' , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"bs-select form-control" , "data-live-search"=>"true" ,  'placeholder'=>'من فضلك اختر مزود الباص' , 'required'])}}
                            <font color="red">{{$errors->first('supplier_id')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">اسم السائق</label>
                        <div class="col-md-8">
                            {{Form::text('name' , '' , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('name')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ الميلاد</label>
                        <div class="col-md-8">
                            {{Form::date('age' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('age')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الجنسية</label>
                        <div class="col-md-8">
                            {{Form::text('nationality' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('nationality')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الجوال</label>
                        <div class="col-md-8">
                            <input type="text" name="mobile[]" , class="form-control" required>
                            <font color="red">{{$errors->first('mobile.0')}}</font><br>
                        </div>
                        <div class="col-md-1">
                            <a href="javascript:;" class="btn btn-icon-only green img-circle" id="addMobile">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>

                    <div id="getNewMobile"></div>


                    <div class="form-group">
                        <label class="control-label col-md-3">الدولة</label>
                        <div class="col-md-8">
                            {{Form::select('country' , $countries , '' , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار الدولة' , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'required'])}}
                            <font color="red">{{$errors->first('country')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">المدينة</label>
                        <div class="col-md-8">
                            {{Form::select('city' , [''=>'من فضلك قم باختيار الدولة اولا'] , '' , ['class'=>'form-control' , "autocomplete" =>"on" , "data-live-search"=>"true" , 'required'])}}
                            <font color="red">{{$errors->first('city')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">السجل المدنى/الاقامة</label>
                        <div class="col-md-8">
                            {{Form::text('card_number' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('card_number')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">رقم الرخصة</label>
                        <div class="col-md-8">
                            {{Form::text('licence' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('licence')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <center>
                            <label for="inputEmail3" class="col-sm-3 control-label">صورة الرخصة</label>
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
                                            <input type="file" name="licence_img"  class="btn btn-danger">
                                        </span>
                                        <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                                            مسح </a>
                                    </div>
                                    <span style="color:red">{{$errors->first('licence_img')}}</span>
                                </div>
                            </div>
                        </center>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">ملاحظات</label>
                        <div class="col-md-8">
                            {{Form::textarea('notes' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('notes')}}</font><br>
                        </div>
                    </div>


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
    <script type="text/javascript" src="{{URL::to('/assets/getCityAjax.js')}}"></script>
    <script type="text/javascript">
newMobile = '<div class="form-group"><label class="control-label col-md-3">الجوال</label><div class="col-md-8"><input type="text" name="mobile[]" , class="form-control" required></div><div class="col-md-1"><a href="javascript:;" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white  tooltips removeNewMobile"><i class="fa fa-times"></i></a></div></div>'
$('#addMobile').click(function (event) {
    $('#getNewMobile').append(newMobile);
});
$(document).on('click', '.removeNewMobile', function () {
    $(this).parent().parent().remove();
});
    </script>
    @stop

    @stop