@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/tourist/programmes">البرامج السياحية</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form ">
            <div class="portlet-title">
                <div class="caption" style="float:right">
                    <i class="fa fa-user font-green"></i>
                    <span class="caption-subject font-green bold uppercase">  اضافه برنامج سياحى</span>
                </div>
                <a href="{{URL::to('/admin/tourist/programmes')}}" class="btn btn-success pull-right">عرض البرامج السياحية</a>
            </div>

            <div class="portlet-body">

                <!-- BEGIN FORM-->
                {{Form::open(array('route' => 'admin.tourist.programmes.store', 'method'=>'post' , 'files'=>'true' , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
                <div class="form-body">

                    @if(Session::has('global_s'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('global_s')}}
                    </div>
                    @endif

                    <div class="form-group">
                        <label class="control-label col-md-3">اسم البرنامج السياحى</label>
                        <div class="col-md-8">
                            {{Form::text('name' , '' , ["autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"form-control " , 'required'])}}
                            <font color="red">{{$errors->first('name')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">اختر نوع  الرحلة
                        </label>
                        <div class="col-md-8">
                            {{Form::select('trip_id' , $trips , '' , ['class'=>'form-control select2-multiple'  , 'required' , 'placeholder' => ''])}}
                            <font color="red">{{$errors->first('trip_id')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">اختر المشرفين على الرحلة
                        </label>
                        <div class="col-md-8">
                            {{Form::select('supervisors[]' , $supervisors , '' , ['class'=>'form-control select2-multiple' , 'id'=>'multiple' , 'multiple' , 'required'])}}
                            <font color="red">{{$errors->first('supervisors')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="control-label col-md-2">انشطة البرنامج السياحي
                        </label>
                        <div class="col-md-4 ">
                            <textarea name="event[]" class='form-control' placeholder='الحدث' style='margin-left: -101.344px; margin-right: 0px; width:439px;' required rows="10"></textarea>
                        </div>
                        <div class="col-md-2 col-md-push-1">
                            <input type="text" name="time[]" class="form-control" placeholder='الساعة' required>
                        </div>
                        <div class="col-md-2 col-md-push-1">
                            <input type="text" name="duration[]" class="form-control" placeholder='المدة' required>
                        </div>

                        <div class="col-md-1 col-md-push-1">
                            <a href="javascript:;" class="btn btn-icon-only green img-circle" id="addActivity">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>

                    </div>

                    <div id="addMoreActivity"></div>

                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ الذهاب</label>
                        <div class="col-md-8">
                            {{Form::date('going_date' , '' , ["autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"form-control" , 'required'])}}
                            <font color="red">{{$errors->first('going_date')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">عدد ايام الرحلة</label>
                        <div class="col-md-8">
                            {{Form::text('flight_days_no' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('flight_days_no')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">عدد ساعات الرحلة</label>
                        <div class="col-md-8">
                            {{Form::text('flight_hours_no' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('flight_hours_no')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الوجبات</label>
                        <div class="col-md-8">
                            {{Form::select('meals[]' , ["فطور"=>"فطور" , "غداء"=>"غداء" , "عشاء"=>"عشاء" , "اخرى"=>"اخرى"] , '' , ['class'=>'form-control select2-multiple' , 'id'=>'multiple' , 'multiple'])}}
                            <font color="red">{{$errors->first('meals')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">ملاحظات</label>
                        <div class="col-md-8">
                            {{Form::textarea('program_notes' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('program_notes')}}</font><br>
                        </div>
                    </div>

                    <fieldset>
                        <legend>الانطلاق من:</legend>

                        <div class="form-group">
                            <label class="control-label col-md-3">الدولة</label>
                            <div class="col-md-8">
                                {{Form::select('from_country' , $countries , '' , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار الدولة' , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'required'])}}
                                <font color="red">{{$errors->first('from_country')}}</font><br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">المدينة</label>
                            <div class="col-md-8">
                                {{Form::select('from_city' , [''=>'من فضلك قم باختيار الدولة اولا'] , '' , ['class'=>'form-control' , "autocomplete" =>"on" , "data-live-search"=>"true" , 'required'])}}
                                <font color="red">{{$errors->first('from_city')}}</font><br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">مكان الانطلاق</label>
                            <div class="col-md-8">
                                {{Form::text('from_place' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                                <font color="red">{{$errors->first('from_place')}}</font><br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">ساعة الانطلاق</label>
                            <div class="col-md-8">
                                {{Form::text('launch_hour' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                                <font color="red">{{$errors->first('launch_hour')}}</font><br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">ملاحظات</label>
                            <div class="col-md-8">
                                {{Form::textarea('launching_notes' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                                <font color="red">{{$errors->first('launching_notes')}}</font><br>
                            </div>
                        </div>

                    </fieldset>

                    <fieldset>
                        <legend>الوصول الى:</legend>

                        <div class="form-group">
                            <label class="control-label col-md-3">الدولة</label>
                            <div class="col-md-8">
                                {{Form::select('to_country' , $countries , '' , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار الدولة' , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'required'])}}
                                <font color="red">{{$errors->first('to_country')}}</font><br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">المدينة</label>
                            <div class="col-md-8">
                                {{Form::select('to_city' , [''=>'من فضلك قم باختيار الدولة اولا'] , '' , ['class'=>'form-control' , "autocomplete" =>"on" , "data-live-search"=>"true" , 'required'])}}
                                <font color="red">{{$errors->first('to_city')}}</font><br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">المكان</label>
                            <div class="col-md-8">
                                {{Form::text('to_place' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                                <font color="red">{{$errors->first('to_place')}}</font><br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">ملاحظات</label>
                            <div class="col-md-8">
                                {{Form::textarea('arriving_notes' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                                <font color="red">{{$errors->first('arriving_notes')}}</font><br>
                            </div>
                        </div>

                    </fieldset>

                    <fieldset>
                        <legend>بيانات الباص:</legend>
                        <div>
                            <div class="form-group">
                                <label class="control-label col-md-3">مزود الباص</label>
                                <div class="col-md-8">
                                    {{Form::select('supplier_id[]' , $busses_suppliers , '' , ["class"=>"bs-select form-control" , "data-live-search"=>"true" , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'من فضلك اختر مزود الباص'])}}
                                    <font color="red">{{$errors->first('supplier_id')}}</font><br>
                                </div>
                                <div class="col-md-1">
                                    <a href="javascript:;" class="btn btn-icon-only green img-circle" id="addBus">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">الباص</label>
                                <div class="col-md-8">
                                    {{Form::select('bus_id[]' , [""=>"من فضلك اختر المزود اولا"] , '' , ["class"=>"form-control" , "data-live-search"=>"true" , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'required'])}}
                                    <font color="red">{{$errors->first('bus_id')}}</font><br>

                                    <div id="BusInfo"></div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">السائق</label>
                                <div class="col-md-8">
                                    {{Form::select('driver_id[]' , [""=>"من فضلك اختر المزود اولا"] , '' , ["class"=>"form-control" , "data-live-search"=>"true" , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'required'])}}
                                    <font color="red">{{$errors->first('driver_id')}}</font><br>

                                    <div id="DriverInfo"></div>

                                </div>
                            </div>
                        </div>
                        <div id="getNewBus"></div>

                    </fieldset>

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


    <script src="{{URL::to('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{URL::to('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

    <script src="{{URL::to('/')}}/assets/touristProgramAjax.js" type="text/javascript"></script>

    

    <script type="text/javascript">
$('#addBus').click(function (event) {
    $('#getNewBus').append('<br><br><div><div class="form-group"><label class="control-label col-md-3">مزود الباص</label><div class="col-md-8">{{Form::select("supplier_id[]" , $busses_suppliers , "" , ["class"=>"bs-select form-control" , "data-live-search"=>"true" , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "placeholder"=>"من فضلك اختر مزود الباص"])}}</div><div class="col-md-1"><a href="javascript:;" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white  tooltips removeParentBus"><i class="fa fa-times"></i></a></div></div><div class="form-group"><label class="control-label col-md-3">الباص</label><div class="col-md-8">{{Form::select("bus_id[]" , [""=>"من فضلك اختر المزود اولا"] , "" , ["class"=>"form-control" , "data-live-search"=>"true" , "autofocus"=>"autofocus" , "autocomplete" =>"on" ])}}<div id="BusInfo"></div></div></div><div class="form-group"><label class="control-label col-md-3">السائق</label><div class="col-md-8">{{Form::select("driver_id[]" , [""=>"من فضلك اختر المزود اولا"] , "" , ["class"=>"form-control" , "data-live-search"=>"true" , "autofocus"=>"autofocus" , "autocomplete" =>"on" ])}}<div id="DriverInfo"></div></div></div></div>');
    $('select').selectpicker('refresh');
});
    </script>
    @stop

    @stop