@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bubble font-green"></i>
                    <span class="caption-subject font-green bold uppercase">  تعديل بيانات مصمم </span>
                </div>
                <a href="{{URL::to('admin/designer_advertising')}}" class="btn btn-danger" style="float: left"> عرض جميع المصممين </a>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {!!Form::open(array('route' => ['admin.designer_advertising.update' , $designer->id] ,'method'=>'patch','class'=>'form-horizontal' , 'files' => 'true'))!!}
                <div class="form-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">الاسم
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('name', $designer->name ,array('placeholder'=>'الاسم', 'class'=>'form-control',"autocomplete" =>"on"  , "autofocus"=>"autofocus"))!!}
                                {!! $errors->first('name','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">الهاتف
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('phone',$designer->phone,array('placeholder'=>'الهاتف', 'class'=>'form-control',"autocomplete" =>"on"))!!}
                                {!! $errors->first('phone','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">الجوال
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('mobile', $designer->mobile ,array('placeholder'=>'الجوال', 'class'=>'form-control',"autocomplete" =>"on"))!!}
                                {!! $errors->first('mobile','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">البريد الالكتروني
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('email', $designer->email ,array('placeholder'=>'البريد الالكتروني', 'class'=>'form-control',"autocomplete" =>"on"))!!}
                                {!! $errors->first('email','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>  
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">فيس بوك
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('facebook', $designer->facebook ,array('placeholder'=>'فيس بوك', 'class'=>'form-control',"autocomplete" =>"on"))!!}
                                {!! $errors->first('facebook','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>  
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">تويتر
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('twitter', $designer->twitter ,array('placeholder'=>'تويتر', 'class'=>'form-control',"autocomplete" =>"on"))!!}
                                {!! $errors->first('twitter','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>  
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">انستغرام
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('instagram', $designer->instagram ,array('placeholder'=>'انستغرام', 'class'=>'form-control',"autocomplete" =>"on"))!!}
                                {!! $errors->first('instagram','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>  
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">سكايب
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('skype', $designer->skype,array('placeholder'=>'سكايب', 'class'=>'form-control',"autocomplete" =>"on"))!!}
                                {!! $errors->first('skype','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>  
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">حفظ</button>
                                <button type="reset" class="btn default">الغاء </button>
                            </div>
                        </div>
                    </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
    @stop