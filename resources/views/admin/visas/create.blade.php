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
                {{Form::open(array('route' => 'admin.visas.store', 'method'=>'post' , 'files'=>'true' , 'class'=>'form-horizontal'))}}
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
                            {{Form::select('from_country' , $countries , '' , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'placeholder'=>'من فضلك اختر الدولة'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الى دولة</label>
                        <div class="col-md-8">
                            {{Form::select('to_country' , $countries , '' , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'placeholder'=>'من فضلك اختر الدولة'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">السفارة</label>
                        <div class="col-md-8">
                            {{Form::select('embassy_id' , $embassies , '' , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'placeholder'=>'من فضلك اختر السفارة'])}}
                        </div>
                    </div>

                    <fieldset>
                        <legend>المتطلبات</legend>
                        <div class="form-group">
                            <label class="col-md-1 control-label"></label>
                            <div class="col-md-10">
                                <div class="mt-checkbox-list">
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        حجز طيران <input type="checkbox" name="booking_flight" value="1">
                                        <span></span>
                                    </label>
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        حجز فندق <input type="checkbox" name="hotel_booking" value="1">
                                        <span></span>
                                    </label>
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        تعريف عمل مختوم<input type="checkbox" name="action_definition" value="1">
                                        <span></span>
                                    </label>
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        تأمين صحى <input type="checkbox" name="health_insurance" value="1">
                                        <span></span>
                                    </label>

                                    <label class="mt-checkbox mt-checkbox-outline">
                                        كشف حساب <input type="checkbox" name="account_statement" value="1">
                                        <span></span>
                                    </label>
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        صورة الجواز <input type="checkbox" name="passport_photocopy" value="1">
                                        <span></span>
                                    </label>

                                    <label class="mt-checkbox mt-checkbox-outline">
                                        تعبئة نموذج اون لاين <input type="checkbox" name="fill_form_online" value="1">
                                        <span></span>
                                    </label><br><br>

                                    <label class="mt-checkbox mt-checkbox-outline">
                                        تعبئة نموذج خارجي <input type="checkbox" name="fill_form_external" value="1">
                                        <span></span>
                                    </label>

                                    <label class="mt-checkbox mt-checkbox-outline">
                                        امكانية عمل الفيزا فى المطار <input type="checkbox" name="visa_in_airport" value="1">
                                        <span></span>
                                    </label>
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        الجواز الاصلي مع صورة <input type="checkbox" name="passport_with_picture" value="1">
                                        <span></span>
                                    </label>
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        كرت العائلة مع صورة<input type="checkbox" name="family_card_with_picture" value="1">
                                        <span></span>
                                    </label>
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        الاقامة مع صورة<input type="checkbox" name="residence_with_picture" value="1">
                                        <span></span>
                                    </label>
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        كشف حساب بنكي بالراتب مختوم من قبل البنك 3-6 أشهر <input type="checkbox" name="bank_account" value="1">
                                        <span></span>
                                    </label>
                                    <br><br>

                                    <div id="visaRequirements" style="display:none">
                                        <label class="col-md-12">متطلبات عمل الفيزا في المطار</label>
                                    </div>

                                    <div id="getNewRequirement"></div>

                                    <div class="form-group">
                                        <div class="col-md-3">
                                            {{Form::text('total_photos' ,'' , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'عدد الصور'])}}
                                        </div>
                                        <div class="col-md-3">
                                            {{Form::text('fill_out_form' , '', ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'تغيير النموذج'])}}
                                        </div>
                                        <div class="col-md-3">
                                            {{Form::text('payment_of_fees' , '', ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'دفع الرسوم'])}}
                                        </div>
                                        <div class="col-md-3">
                                            {{Form::text('visa_duration' , '', ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'مدة التأشيرة'])}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group">
                        <label class="control-label col-md-2"></label>
                        <div class="col-md-8">
                            {{Form::textarea('notes' , '' , ['class'=>'form-control' , 'placeholder'=>'طلبات اضافية / ملاحظات'])}}
                            <font color="red">{{$errors->first('notes')}}</font><br>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group">
                        <label class="control-label col-md-2">ملف استمارة التأشيرة الرسمي</label>
                        <div class="col-md-8">
                            <input type="file" name="official_files[]" , class="form-control">
                        </div>
                        <div class="col-md-1"><a href="javascript:;" class="btn btn-icon-only green img-circle" id="addOfficialFiles"><i class="fa fa-plus"></i></a></div>
                    </div>
                    <div id="getNewOfficialFiles"></div>

                    <div class="form-group">
                        <label class="control-label col-md-2">ملف استمارة التأشيرة المعدل</label>
                        <div class="col-md-8">
                            <input type="file" name="modefied_files[]" , class="form-control">
                        </div>
                        <div class="col-md-1"><a href="javascript:;" class="btn btn-icon-only green img-circle" id="addModefiedFiles"><i class="fa fa-plus"></i></a></div>
                    </div>
                    <div id="getNewModefiedFiles"></div>

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
    <script type="text/javascript">

        ;
        (function () {
            if ($('input[name="visa_in_airport"]').is(':checked'))
            {
                $('#visaRequirements').append('<div class="form-group"><div class="col-md-11"><input type="text" name="visa_requirements[]" , class="form-control"></div><div class="col-md-1"><a href="javascript:;" class="btn btn-icon-only green img-circle" id="addRequirement"><i class="fa fa-plus"></i></a></div></div>');
                $('#visaRequirements').show();
                $('#getNewRequirement').show();
            } else
            {
                $('#visaRequirements').children('div.form-group').remove();
                $('#visaRequirements').hide();
                $('#getNewRequirement').children().remove();
            }
        })();

        $('input[name="visa_in_airport"]').click(function (event) {
            if ($(this).is(':checked'))
            {
                $('#visaRequirements').append('<div class="form-group"><div class="col-md-11"><input type="text" name="visa_requirements[]" , class="form-control"></div><div class="col-md-1"><a href="javascript:;" class="btn btn-icon-only green img-circle" id="addRequirement"><i class="fa fa-plus"></i></a></div></div>');
                $('#visaRequirements').show();
                $('#getNewRequirement').show();
            } else
            {
                $('#visaRequirements').children('div.form-group').remove();
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