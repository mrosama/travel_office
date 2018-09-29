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
                    <span class="caption-subject font-green bold uppercase">  تعديل بيانات موقف باص </span>
                </div>
                <a href="{{URL::to('admin/busStops')}}" class="btn btn-primary btn-sm" style="float:left;"> عرض الكل </a>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {{Form::open(array('route' => ['admin.busStops.update' , $busStop->id  ], 'method'=>'patch' , 'files'=>'true' , 'class'=>'form-horizontal'))}}
                <div class="form-body">
                    @if(Session::has('global_s'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('global_s')}}
                    </div>
                    @endif
                    <div class="form-group">
                        <center>
                            <label for="inputEmail3" class="col-sm-3 control-label">لوجو الموقف</label>
                            <div class="col-md-8">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 265px; height: 200px;">
                                        @if($busStop->logo)
                                        <img src="{{URL::to('/') . $busStop->logo}}" alt="" width="265" />
                                        @else
                                        <img src="{{URL::to('/')}}/noimage.gif" alt="" width="265" />
                                        @endif
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
                        <label class="control-label col-md-3">الاسم </label>
                        <div class="col-md-8">
                            {{Form::text('name' , $busStop->name , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('name')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الهاتف</label>
                        <div class="col-md-8">
                            {{Form::text('tel' , $busStop->tel , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('tel')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الجوال</label>
                        <div class="col-md-8">
                            {{Form::text('mobile' , $busStop->mobile , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('mobile')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">البريد الالكترونى</label>
                        <div class="col-md-8">
                            {{Form::email('email' , $busStop->email , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('email')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">تويتر</label>
                        <div class="col-md-8">
                            {{Form::text('twitter' , $busStop->twitter , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('twitter')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">فيس بوك</label>
                        <div class="col-md-8">
                            {{Form::text('face' , $busStop->face , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('face')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">سكايب</label>
                        <div class="col-md-8">
                            {{Form::text('skype' , $busStop->skype , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('skype')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">رقم السجل التجارى</label>
                        <div class="col-md-8">
                            {{Form::text('commercial_record_no' , $busStop->commercial_record_no , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('commercial_record_no')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الدولة</label>
                        <div class="col-md-8">
                            {{Form::select('country' , $countries , $busStop->country , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار الدولة' , "class"=>"bs-select form-control" , "data-live-search"=>"true"])}}
                            <font color="red">{{$errors->first('country')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">المدينة</label>
                        <div class="col-md-8">
                            <select name="city" class="form-control bs-select" autocomplete="on" data-live-search="true">
                                <option selected="" value="{{$busStop->city}}">{{\App\Http\Models\City::find($busStop->city)->name}}</option>
                                @foreach($cities as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            <font color="red">{{$errors->first('city')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الشارع</label>
                        <div class="col-md-8">
                            {{Form::text('street' , $busStop->street , ['class'=>'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('street')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الموقع على الخريطة</label>
                        <div class="col-md-1">خط العرض</div>
                        <div class="col-md-3">
                            {{Form::text('lat' , $busStop->lat , ['class'=>'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('lat')}}</font><br>
                        </div>
                        <div class="col-md-1">خط الطول</div>
                        <div class="col-md-3">
                            {{Form::text('long' , $busStop->long , ['class'=>'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('long')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">صندوق البريد</label>
                        <div class="col-md-8">
                            {{Form::text('mailbox' , $busStop->mailbox , ['class'=>'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('mailbox')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">الرمز البريدى</label>
                        <div class="col-md-8">
                            {{Form::text('postal_code' , $busStop->postal_code , ['class'=>'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('postal_code')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">فاكس</label>
                        <div class="col-md-8">
                            {{Form::text('fax' , $busStop->fax , ['class'=>'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('fax')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">الموقع الالكترونى</label>
                        <div class="col-md-8">
                            {{Form::text('website' , $busStop->website , ['class'=>'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('website')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <center>
                            <label for="inputEmail3" class="col-sm-3 control-label">صورة السجل التجارى</label>
                            <div class="col-md-8">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 265px; height: 200px;">
                                        @if($busStop->commercial_reg_img)
                                        <img src="{{URL::to('/') . $busStop->commercial_reg_img}}" alt="" width="265" />
                                        @else
                                        <img src="{{URL::to('/')}}/noimage.gif" alt="" width="265" />
                                        @endif
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 265px; max-height: 200px;">
                                    </div>
                                    <div>
                                        <span class="btn  btn-large btn-primary btn-file">
                                            <span class="fileinput-new">
                                                تغيير الصورة </span>
                                            <span class="fileinput-exists">
                                                تغيير </span>
                                            <input type="file" name="commercial_reg_img"  class="btn btn-danger">
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
                            {{Form::textarea('notes' , $busStop->notes , ['class'=>'form-control'])}}
                            <font color="red">{{$errors->first('notes')}}</font><br>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="text-center">
                                <button type="submit" class="btn green">تعديل</button>
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
    @stop
    @stop