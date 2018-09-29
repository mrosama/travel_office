@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
@section('CssLinks')
<style type="text/css">
    label.mt-checkbox.mt-checkbox-outline{margin-left:10px;}
</style>
@stop

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/visas">الفيزا و التأشيرات</a>
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
                    <span class="caption-subject font-green bold uppercase">اضافة متطلبات فيزا</span>
                </div>
            </div>

            <div class="portlet-body">

                <!-- BEGIN FORM-->
                {{Form::open(['route' => ['admin.visas.update' , $visa->id], 'method'=>'put' , 'files'=>'true' , 'class'=>'form-horizontal'])}}
                <div class="form-body">

                    @if(Session::has('global_s'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('global_s')}}
                    </div>
                    @endif

                    @foreach($errors->all() as $error)
                    <font color="red">{{$error}}</font><br><br>
                    @endforeach

                    <div class="form-group">
                        <label class="control-label col-md-3">جنسية العميل</label>
                        <div class="col-md-8">
                            {{Form::select('from_country' , $countries , $visa->from_country , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'placeholder'=>'من فضلك اختر الدولة'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الى دولة</label>
                        <div class="col-md-8">
                            {{Form::select('to_country' , $countries , $visa->to_country , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'placeholder'=>'من فضلك اختر الدولة'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">السفارة</label>
                        <div class="col-md-8">
                            {{Form::select('embassy_id' , $embassies ,  $visa->embassy_id , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'placeholder'=>'من فضلك اختر السفارة'])}}
                        </div>
                    </div>

                    <fieldset>
                        <legend>المتطلبات</legend>
                        <div class="form-group">
                            <label class="col-md-1 control-label"></label>
                            <div class="col-md-10">
                                <div class="mt-checkbox-list">
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        حجز طيران {{Form::checkbox("booking_flight" , 1 , ($visa->booking_flight)?true:false)}}
                                    </label>
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        حجز فندق {{Form::checkbox("hotel_booking" , 1 , ($visa->hotel_booking)?true:false)}}
                                    </label>
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        تعريف عمل مختوم{{Form::checkbox("action_definition" , 1 , ($visa->action_definition)?true:false)}}
                                    </label>
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        تأمين صحى {{Form::checkbox("health_insurance" , 1 , ($visa->health_insurance)?true:false)}}
                                    </label>

                                    <label class="mt-checkbox mt-checkbox-outline">
                                        كشف حساب {{Form::checkbox("account_statement" , 1 , ($visa->account_statement)?true:false)}}
                                        <span></span>
                                    </label>
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        صورة الجواز {{Form::checkbox("passport_photocopy" , 1 , ($visa->passport_photocopy)?true:false)}}
                                        <span></span>
                                    </label>

                                    <label class="mt-checkbox mt-checkbox-outline">
                                        تعبئة نموذج اون لاين {{Form::checkbox("fill_form_online" , 1 , ($visa->passport_photocopy)?true:false)}}
                                        <span></span>
                                    </label>

                                    <label class="mt-checkbox mt-checkbox-outline">
                                        تعبئة نموذج خارجي {{Form::checkbox("fill_form_external" , 1 , ($visa->fill_form_external)?true:false)}}
                                        <span></span>
                                    </label>

                                    <label class="mt-checkbox mt-checkbox-outline">
                                        امكانية عمل الفيزا فى المطار {{Form::checkbox("visa_in_airport" , 1 , ($visa->visa_in_airport)?true:false)}}
                                        <span></span>
                                    </label>

                                    <label class="mt-checkbox mt-checkbox-outline">
                                        الجواز الاصلي مع صورة {{Form::checkbox("passport_with_picture" , 1 , ($visa->passport_with_picture)?true:false)}}
                                        
                                        <span></span>
                                    </label>
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        كرت العائلة مع صورة{{Form::checkbox("family_card_with_picture" , 1 , ($visa->family_card_with_picture)?true:false)}}
                                        <span></span>
                                    </label>
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        الاقامة مع صورة{{Form::checkbox("residence_with_picture" , 1 , ($visa->residence_with_picture)?true:false)}}
                                        <span></span>
                                    </label>
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        كشف حساب بنكي بالراتب مختوم من قبل البنك 3-6 أشهر {{Form::checkbox("bank_account" , 1 , ($visa->bank_account)?true:false)}}
                                        <span></span>
                                    </label>

                                    <br><br>

                                    @if($visa->requirements->count() != 0)
                                    <div id="visaRequirements">
                                        <label class="col-md-12">متطلبات عمل الفيزا في المطار</label>
                                        @foreach($visa->requirements as $requirement)
                                        <div class="form-group">
                                            <div class="col-md-11">
                                                <input type="text" name="visa_requirements[]" , class="form-control" value="{{$requirement->requirement}}">
                                            </div>
                                            @if(++$i == 1)
                                            <div class="col-md-1"><a href="javascript:;" class="btn btn-icon-only green img-circle" id="addRequirement"><i class="fa fa-plus"></i></a></div>
                                            @else
                                            <div class="col-md-1"><a href="javascript:;" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white  tooltips removeNewRequirement"><i class="fa fa-times"></i></a></div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                    <div id="visaRequirements" style="display:none">
                                        <label class="col-md-12">متطلبات عمل الفيزا في المطار</label>
                                    </div>
                                    @endif

                                    <div id="getNewRequirement"></div>

                                    <div class="col-md-3">
                                        {{Form::text('total_photos' , $visa->total_photos , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'عدد الصور'])}}
                                    </div>
                                    <div class="col-md-3">
                                        {{Form::text('fill_out_form' , $visa->fill_out_form ,  ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'تغيير النموذج'])}}
                                    </div>
                                    <div class="col-md-3">
                                        {{Form::text('payment_of_fees' , $visa->payment_of_fees, ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'دفع الرسوم'])}}
                                    </div>
                                    <div class="col-md-3">
                                        {{Form::text('visa_duration' , $visa->visa_duration, ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'مدة التأشيرة'])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group">
                        <label class="control-label col-md-2"></label>
                        <div class="col-md-8">
                            {{Form::textarea('notes' , $visa->notes , ['class'=>'form-control' , 'placeholder'=>'طلبات اضافية / ملاحظات'])}}
                            <font color="red">{{$errors->first('notes')}}</font><br>
                        </div>
                    </div>
                    <hr>

                    @if($visa->officialFiles->count() !=0)
                    @foreach($visa->officialFiles as $file)
                    <div class="form-group">
                        <label class="control-label col-md-2">
                            @if(++$j == 1)
                            ملف استمارة التأشيرة الرسمي
                            @endif</label>
                        <div class="col-md-8">
                            <input type="file" name="edit_official_files[{{$file->id}}]" , class="form-control">
                            <p>
                                لرؤية الملف المرفوع من قبل <a href="{{URL::to($file->file)}}"> اضغط هنا</a>
                            </p>
                        </div>
                        @if(++$j == 2)
                        <div class="col-md-1"><a href="javascript:;" class="btn btn-icon-only green img-circle" id="addOfficialFiles"><i class="fa fa-plus"></i></a></div>
                        @else
                        <div class="col-md-1"><a href="javascript:;" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white  tooltips removeNewRequirement"><i class="fa fa-times"></i></a></div>
                        @endif
                    </div>
                    @endforeach
                    @else
                    <div class="form-group">
                        <label class="control-label col-md-2">ملف استمارة التأشيرة الرسمي</label>
                        <div class="col-md-8">
                            <input type="file" name="official_files[]" , class="form-control">
                            <p>
                                لا يوجد ملف مرفوع من قبل
                            </p>
                        </div>
                        <div class="col-md-1"><a href="javascript:;" class="btn btn-icon-only green img-circle" id="addOfficialFiles"><i class="fa fa-plus"></i></a></div>
                    </div>
                    @endif

                    <div id="getNewOfficialFiles"></div>

                    @if($visa->modefiedFiles->count() !=0)
                    @foreach($visa->modefiedFiles as $file)
                    <div class="form-group">
                        <label class="control-label col-md-2">@if(++$x == 1)ملف استمارة التأشيرة المعدل@endif</label>
                        <div class="col-md-8">
                            <input type="file" name="edit_modified_files[{{$file->id}}]" , class="form-control">
                            <p>
                                لرؤية الملف المرفوع من قبل <a href="{{URL::to($file->file)}}"> اضغط هنا</a>
                            </p>
                        </div>
                        @if(++$x == 2)
                        <div class="col-md-1"><a href="javascript:;" class="btn btn-icon-only green img-circle" id="addModefiedFiles"><i class="fa fa-plus"></i></a></div>
                        @else
                        <div class="col-md-1"><a href="javascript:;" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white  tooltips removeNewRequirement"><i class="fa fa-times"></i></a></div>
                        @endif
                    </div>
                    @endforeach
                    @else
                    <div class="form-group">
                        <label class="control-label col-md-2">ملف استمارة التأشيرة المعدل</label>
                        <div class="col-md-8">
                            <input type="file" name="modefied_files[]" , class="form-control">
                            <p>
                                لا يوجد ملف مرفوع من قبل
                            </p>
                        </div>
                        <div class="col-md-1"><a href="javascript:;" class="btn btn-icon-only green img-circle" id="addModefiedFiles"><i class="fa fa-plus"></i></a></div>
                    </div>
                    @endif
                    <div id="getNewModefiedFiles"></div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="text-center">
                                <button type="submit" class="btn green">تعديل</button>
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
    <script type="text/javascript">

        $('input[name="visa_in_airport"]').click(function (event) {
            if ($(this).is(':checked'))
            {
                $('#visaRequirements').append('<div class="form-group"><div class="col-md-11"><input type="text" name="visa_requirements[]" , class="form-control"></div><div class="col-md-1"><a href="javascript:;" class="btn btn-icon-only green img-circle" id="addRequirement"><i class="fa fa-plus"></i></a></div></div>');
                $('#visaRequirements').show();
                $('#getNewRequirement').show();
            } else
            {
                console.log($('#visaRequirements').children().remove('div.form-group'));
                $('#visaRequirements').hide();
                $('#getNewRequirement').children().remove();
            }
        });

        newRequirement = '<div class="form-group"><div class="col-md-11"><input type="text" name="visa_requirements[]" , class="form-control"></div><div class="col-md-1"><a href="javascript:;" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white  tooltips removeNewRequirement"><i class="fa fa-times"></i></a></div></div>'
        $(document).on('click', '#addRequirement', function () {
            $('#getNewRequirement').append(newRequirement);
        });
        $(document).on('click', '.removeNewRequirement', function () {
            $(this).parent().parent().remove();
        });

        $(document).on('click', '#addOfficialFiles', function () {
            $('#getNewOfficialFiles').append('<div class="form-group"><label class="control-label col-md-2"></label><div class="col-md-8"><input type="file" name="official_files[]" , class="form-control"></div><div class="col-md-1"><a href="javascript:;" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white  tooltips removeNewRequirement"><i class="fa fa-times"></i></a></div></div>');
        });
        $(document).on('click', '#addModefiedFiles', function () {
            $('#getNewModefiedFiles').append('<div class="form-group"><label class="control-label col-md-2"></label><div class="col-md-8"><input type="file" name="modefied_files[]" , class="form-control"></div><div class="col-md-1"><a href="javascript:;" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white  tooltips removeNewRequirement"><i class="fa fa-times"></i></a></div></div>');
        });
    </script>
    @stop
    @stop