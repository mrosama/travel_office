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
                    <span class="caption-subject font-green bold uppercase">  تعديل بيانات مزود الباص </span>
                </div>
                <a href="{{URL::to('/admin/busses/suppliers')}}" class="btn btn-success pull-right">عرض جميع المزودين</a>
            </div>

            <div class="portlet-body">

                <!-- BEGIN FORM-->
                {{Form::open(array('route' => ['admin.busses.suppliers.update' , $busses_supplier->id] , 'method'=>'put' , 'files'=>'true' , 'class'=>'form-horizontal'))}}
                <div class="form-body">

                    @if(Session::has('global_s'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('global_s')}}
                    </div>
                    @endif

                    <div class="form-group">
                        <center>
                            <label for="inputEmail3" class="col-sm-3 control-label">لوجو الشركة</label>
                            <div class="col-md-8">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 265px; height: 200px;">
                                        <img src="{{URL::to($busses_supplier->logo)}}" alt="" width="265" />
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 265px; max-height: 200px;">
                                    </div>
                                    <div>
                                        <span class="btn  btn-large btn-primary btn-file">
                                            <span class="fileinput-new">
                                                تغيير الصورة </span>
                                            <span class="fileinput-exists">
                                                تغيير </span>
                                            <input type="file" name="logo"  class="btn btn-danger">
                                        </span>
                                        <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                                            مسح </a>
                                    </div>
                                    <span style="color:red">{{$errors->first('logo')}}</span>
                                </div>
                            </div>
                        </center>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">اختر الفرع</label>
                        <div class="col-md-7">
                            {{Form::select('branch_id' , $bussesBranches , $busses_supplier->branch_id , ["autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'placeholder'=>'من فضلك اختر الفرع' , 'required'])}}
                            <font color="red">{{$errors->first('branch_id')}}</font><br>
                        </div>
                        <div class="col-md-2">
                            <a href="{{URL::to('admin/busses/branches/create')}}" target="_blank" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة فرع جديد</a>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">اسم الجهة</label>
                        <div class="col-md-8">
                            {{Form::text('name' , $busses_supplier->name , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('name')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الهاتف</label>
                        <div class="col-md-8">
                            {{Form::text('tel' , $busses_supplier->tel , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('tel')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الجوال</label>
                        <div class="col-md-8">
                            {{Form::text('mobile' , $busses_supplier->mobile , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('mobile')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">البريد الالكترونى</label>
                        <div class="col-md-8">
                            {{Form::email('email' , $busses_supplier->email , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('email')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">تويتر</label>
                        <div class="col-md-8">
                            {{Form::text('twitter' , $busses_supplier->twitter , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('twitter')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">فيس بوك</label>
                        <div class="col-md-8">
                            {{Form::text('face' , $busses_supplier->face , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('face')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">سكايب</label>
                        <div class="col-md-8">
                            {{Form::text('skype' , $busses_supplier->skype , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('skype')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">رقم السجل التجارى</label>
                        <div class="col-md-8">
                            {{Form::text('Commercial_record_no' , $busses_supplier->Commercial_record_no , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('Commercial_record_no')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الدولة</label>
                        <div class="col-md-8">
                            {{Form::text('country' , $busses_supplier->country , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('country')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">المدينة</label>
                        <div class="col-md-8">
                            {{Form::text('city' , $busses_supplier->city , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('city')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الشارع</label>
                        <div class="col-md-8">
                            {{Form::text('street' , $busses_supplier->street , ['class'=>'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('street')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الموقع على الخريطة</label>
                        <div class="col-md-1">خط العرض</div>
                        <div class="col-md-3">
                            {{Form::text('lat' , $busses_supplier->lat , ['class'=>'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('lat')}}</font><br>
                        </div>
                        <div class="col-md-1">خط الطول</div>
                        <div class="col-md-3">
                            {{Form::text('long' , $busses_supplier->long , ['class'=>'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('long')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">صندوق البريد</label>
                        <div class="col-md-8">
                            {{Form::text('mailbox' , $busses_supplier->mailbox , ['class'=>'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('mailbox')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">الرمز البريدى</label>
                        <div class="col-md-8">
                            {{Form::text('postal_code' , $busses_supplier->postal_code , ['class'=>'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('postal_code')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">فاكس</label>
                        <div class="col-md-8">
                            {{Form::text('fax' , $busses_supplier->fax , ['class'=>'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('fax')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">الموقع الالكترونى</label>
                        <div class="col-md-8">
                            {{Form::text('website' , $busses_supplier->website , ['class'=>'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('website')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <center>
                            <label for="inputEmail3" class="col-sm-3 control-label">صورة السجل التجارى</label>
                            <div class="col-md-8">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 265px; height: 200px;">
                                        <img src="{{URL::to($busses_supplier->commercial_reg_img)}}" alt="" width="265" />
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 265px; max-height: 200px;">
                                    </div>
                                    <div>
                                        <span class="btn  btn-large btn-primary btn-file">
                                            <span class="fileinput-new">
                                                تغيير الصورة </span>
                                            <span class="fileinput-exists">
                                                تغيير </span>
                                            <input type="file" name="commercial_reg_img"  class="btn btn-danger" >
                                        </span>
                                        <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                                            مسح </a>
                                    </div>
                                    <span style="color:red">{{$errors->first('commercial_reg_img')}}</span>
                                </div>
                            </div>
                        </center>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">ملاحظات</label>
                        <div class="col-md-8">
                            {{Form::textarea('notes' , $busses_supplier->notes , ['class'=>'form-control'])}}
                            <font color="red">{{$errors->first('notes')}}</font><br>
                        </div>
                    </div>

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
    <script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    @stop

    @stop