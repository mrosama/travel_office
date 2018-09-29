@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
@section('CssLinks')
<link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@stop

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/partners">الشركاء</a>
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
                    <span class="caption-subject font-green bold uppercase">  تعديل شريك</span>
                </div>
            </div>

            <div class="portlet-body">

                <!-- BEGIN FORM-->
                {{Form::open(array('route' => ['admin.partners.update' , $partner->id], 'method'=>'put' , 'files'=>'true' , 'class'=>'form-horizontal' ,"novalidate"=>"novalidate" , "id"=>"form"))}}
                <div class="form-body">

                    @if(Session::has('global_s'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('global_s')}}
                    </div>
                    @endif

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-green"></i>
                            <span class="caption-subject font-green sbold uppercase">البيانات الاساسية</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">اسم المستخدم
                        </label>
                        <div class="col-md-7">
                            {{Form::text('user_name' , $partner->user->user_name , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">كلمة المرور
                        </label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <input type="text" class="form-control" name="password" value="{{$partner->user->shown_password}}" id="generatedPass"  >
                                <span class="input-group-btn">
                                    <button class="btn btn-inverse btn-md" type="button" id="generatePass" style="padding: 8px 15px;">توليد</button>
                                </span>
                            </div>
                            <font color="red">{{$errors->first('password')}}</font>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group">
                        <center>
                            <label for="inputEmail3" class="col-sm-3 control-label">اللوجو</label>
                            <div class="col-md-8">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 265px; height: 200px;">
                                        <img src="{{URL::to($partner->logo)}}" alt="" style="width: 265px; height: 200px;"/>
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
                        <label class="control-label col-md-3">النوع</label>
                        <div class="col-md-8">
                            {{Form::select('type' , $data['partner_types'] , $partner->type , ['class'=>'form-control' ,'placeholder' => 'اختر النوع من فضلك ....',  "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('type')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الاسم</label>
                        <div class="col-md-8">
                            {{Form::text('name' , $partner->name , ['class'=>'form-control'  , "autofocus"=>"autofocus" , 'required'])}}
                            <font color="red">{{$errors->first('name')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الجوال</label>
                        <div class="col-md-8">
                            {{Form::text('mobile' , $partner->mobile , ['class'=>'form-control' , 'required' , 'number'])}}
                            <font color="red">{{$errors->first('mobile')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">الهاتف</label>
                        <div class="col-md-8">
                            {{Form::text('phone' , $partner->phone , ['class'=>'form-control' , "autocomplete" =>"on"  , 'required'])}}
                            <font color="red">{{$errors->first('phone')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الموقع الالكترونى</label>
                        <div class="col-md-8">
                            {{Form::text('site_url' , $partner->site_url , ['class'=>'form-control' , 'required' , 'url'])}}
                            <font color="red">{{$errors->first('site_url')}}</font><br>
                        </div>
                    </div>

                    @foreach(json_decode($partner->email) as $email)
                    @if(++$i % 2 == 1)
                    <div class="form-group">
                        <label class="control-label col-md-3">البريد الالكترونى / الهدف منه</label>
                        <div class="col-md-4">
                            <input type="text" name="email[]" value="{{$email}}" class='form-control' placeholder='البريد الالكترونى' autocomplete ="on" , 'required' , 'email'>
                            <font color="red">{{$errors->first('email.'.($i-1))}}</font><br>
                        </div>
                        @else
                        <div class="col-md-4">
                            <input type="text" name="email[]" value="{{$email}}" class='form-control' placeholder='الهدف منه' autocomplete ="on" , 'required' , 'email'>
                            <font color="red">{{$errors->first('email')}}</font><br>
                        </div>

                        @if($i != 2)
                        <a href="javascript:;" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white  tooltips removeParent"><i class="fa fa-close"></i></a>
                        @else
                        <a href="javascript:;" class="btn btn-icon-only green img-circle">
                            <i class="fa fa-plus"></i>
                        </a>
                        @endif

                    </div>
                    @endif
                    @endforeach

                    <div id="addMoreEmail"></div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الدولة</label>
                        <div class="col-md-8">
                            {{Form::select('country' , $data['countries'] , $partner->country  , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار الدولة' , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'required'])}}
                            <font color="red">{{$errors->first('country')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">المدينة</label>
                        <div class="col-md-8">
                            {{Form::select('city' , $data['cities'] , $partner->city , ['class'=>'bs-select form-control' , "autocomplete" =>"on" , "data-live-search"=>"true" , 'required'])}}
                            <font color="red">{{$errors->first('city')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الشارع</label>
                        <div class="col-md-8">
                            {{Form::text('street' , $partner->street , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('street')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">الموقع على الخريطة</label>
                        <div class="col-md-4">
                            {{Form::text('latitude' , $partner->latitude , ['class'=>'form-control' ,"autocomplete" =>"on", 'placeholder' => 'خط العرض'  , 'required'])}}
                            <font color="red">{{$errors->first('street')}}</font><br>
                        </div>
                        <div class="col-md-4">
                            {{Form::text('longitude' , $partner->longitude , ['class'=>'form-control' ,"autocomplete" =>"on" ,'placeholder' => 'خط الطول'   , 'required'])}}
                            <font color="red">{{$errors->first('street')}}</font><br>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">صندوق البريد</label>
                        <div class="col-md-8">
                            {{Form::text('mail_box' , $partner->mail_box , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('mail_box')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الفاكس</label>
                        <div class="col-md-8">
                            {{Form::text('fax' , $partner->fax , ['class'=>'form-control' , 'required' , 'number'])}}
                            <font color="red">{{$errors->first('fax')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">سكايب</label>
                        <div class="col-md-8">
                            {{Form::text('skype' , $partner->skype , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('skype')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">تويتر</label>
                        <div class="col-md-8">
                            {{Form::text('twitter' , $partner->twitter , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('twitter')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">فيس بوك</label>
                        <div class="col-md-8">
                            {{Form::text('facebook' , $partner->facebook , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('facebook')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">اخرى</label>
                        <div class="col-md-8">
                            {{Form::text('other' , $partner->other , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('other')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">ملاحظات</label>
                        <div class="col-md-8">
                            {{Form::textarea('notes' , $partner->notes , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('notes')}}</font><br>
                        </div>
                    </div>


                    <div class="form-actions text-center">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-9">
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
    <script type="text/javascript" src="{{URL::to('/assets/getCityAjax.js')}}"></script>

    <script type="text/javascript">

$('input[name="remaining_amount"]').click(function (event) {
    calculation($(this));
});

$('input[name="required_amount"]').keyup(function (event) {
    calculation($('input[name="remaining_amount"]'));
});

$('input[name="paid_amount"]').keyup(function (event) {
    calculation($('input[name="remaining_amount"]'));
});

function calculation(data)
{
    var required_amount = $('input[name="required_amount"]').val();
    var paid_amount = $('input[name="paid_amount"]').val();
    data.val(parseInt(required_amount) - parseInt(paid_amount));
}

$('.btn-icon-only').click(function (event) {
    $('#addMoreEmail').append('<div class="form-group"><label class="control-label col-md-3">البريد الالكترونى / الهدف منه</label><div class="col-md-4"><input type="email" value="" class="form-control" placeholder="البريد الالكترونى" name="email[]"></div><div class="col-md-4"><input type="text" value="" class="form-control" placeholder="الهدف منه" name="email[]"></div><a href="javascript:;" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white  tooltips removeParent"><i class="fa fa-times"></i></a></div>');
});

$(document).on('click', '.removeParent', function () {
    console.log($(this).parent().remove());
});
$('#generatePass').click(function (event) {
    $('#generatedPass').val(Math.random().toString(36).slice(-10));
});
    </script>
    @stop

    @stop