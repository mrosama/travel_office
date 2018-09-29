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
            <a href="{{URL::to('/')}}/admin/employees">الموظفين</a>
        </li>
        <i class="fa fa-angle-left"></i>
        <li>تعديل موظف لدى شريك</li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form ">
            <div class="portlet-title">
                <div class="caption" style="float:right">
                    <i class="fa fa-user font-green"></i>
                    <span class="caption-subject font-green bold uppercase"> تعديل موظف لدى شريك</span>
                </div>
            </div>

            <div class="portlet-body">

                <!-- BEGIN FORM-->
                {{Form::open(array('route' => ['admin.employees.update' , $employee->id], 'method'=>'put'  , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
                <div class="form-body">

                    @if(Session::has('global_s'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('global_s')}}
                    </div>
                    @endif

                    <div class="form-group">
                        <label class="control-label col-md-3">اسم المستخدم
                        </label>
                        <div class="col-md-7">
                            {{Form::text('user_name' , $employee->user->user_name , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">كلمة المرور
                        </label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <input type="text" class="form-control" name="password" value="{{$employee->user->shown_password}}" id="generatedPass"  >
                                <span class="input-group-btn">
                                    <button class="btn btn-inverse btn-md" type="button" id="generatePass" style="padding: 8px 15px;">توليد</button>
                                </span>
                            </div>
                            <font color="red">{{$errors->first('password')}}</font>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group">
                        <label class="control-label col-md-3">الشريك</label>
                        <div class="col-md-7">
                            {{Form::select('partner_id' , $partners , $employee->partner_id , ["class"=>"bs-select form-control" , "data-live-search"=>"true"  , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'من فضلك اختر الشريك' , 'required'])}}
                            <font color="red">{{$errors->first('partner_id')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">اسم الموظف</label>
                        <div class="col-md-7">
                            {{Form::text('name' , $employee->name , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('name')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الجنسية</label>
                        <div class="col-md-7">
                            {{Form::select('nationality' , $countries , $employee->nationality , ["class"=>"bs-select form-control" , "data-live-search"=>"true"  , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'من فضلك اختر الجنسية' , 'required'])}}
                            <!--                            {{Form::text('nationality' , $employee->nationality , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}-->
                            <font color="red">{{$errors->first('nationality')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الجنس</label>
                        <div class="col-md-7">
                            {{Form::select('gender' , [""=>"من فضلك اختر نوع الموظف" ,"m"=>"ذكر" ,"f"=>"انثى"] , $employee->gender ,  ["class"=>"bs-select form-control" , "data-live-search"=>"true" , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('gender')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">البريد الالكترونى</label>
                        <div class="col-md-7">
                            {{Form::text('email' , $employee->email , ['class'=>'form-control' , "autocomplete" =>"on" , 'required' , 'email'])}}
                            <font color="red">{{$errors->first('email')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الجوال</label>
                        <div class="col-md-7">
                            {{Form::text('mobile' , $employee->mobile , ['class'=>'form-control' , "autocomplete" =>"on" , 'required' , 'number'])}}
                            <font color="red">{{$errors->first('mobile')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الهاتف</label>
                        <div class="col-md-7">
                            {{Form::text('phone' , $employee->phone , ['class'=>'form-control' , "autocomplete" =>"on" , 'required' , 'number'])}}
                            <font color="red">{{$errors->first('phone')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">فاكس</label>
                        <div class="col-md-7">
                            {{Form::text('fax' , $employee->fax , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('fax')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">مسئول عن</label>
                        <div class="col-md-7">
                            <!--                            {{--Form::text('responsible_for' , $employee->responsible_for , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])--}}-->
                            {{Form::select('responsible_for' , $nature_work , $employee->responsible_for , ["class"=>"bs-select form-control" , "data-live-search"=>"true"  , "autofocus"=>"autofocus" , "autocomplete" =>"on" , 'placeholder'=>'من فضلك اختر ' , 'required'])}}
                            <font color="red">{{$errors->first('responsible_for')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">سكايب</label>
                        <div class="col-md-7">
                            {{Form::text('skype' , $employee->skype , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('skype')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">اخرى</label>
                        <div class="col-md-7">
                            {{Form::text('other' , $employee->other , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('other')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">ملاحظات</label>
                        <div class="col-md-7">
                            {{Form::textarea('notes' , $employee->notes , ['class'=>'form-control', 'required'])}}
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
    <script src="{{URL::to('/')}}/assets/form-validation.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{URL::to('/assets/getCityAjax.js')}}"></script>
    <script type="text/javascript">
$('#generatePass').click(function (event) {
    $('#generatedPass').val(Math.random().toString(36).slice(-10));
});
    </script>
    @stop

    @stop