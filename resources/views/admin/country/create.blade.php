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
                    <span class="caption-subject font-green bold uppercase">  اضافه دولة جديده</span>
                </div>
                <a href="{{URL::to('admin/country')}}" class="btn btn-success" style="float: left"> عرض جميع الدول </a>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {!!Form::open(array('url' => 'admin/country','method'=>'post','class'=>'form-horizontal' , 'files' => 'true'))!!}
                <div class="form-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">اسم الدولة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('name','',array('placeholder'=>'اسم الدولة',
                                'class'=>'form-control',"autocomplete" =>"on"  , "autofocus"=>"autofocus"))!!}
                                {!! $errors->first('name','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">كود الدولة 
                            <span class="required"> * </span><br>(مثال : eg , sa)
                        </label>
                        <div class="col-md-6">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('code','',array('placeholder'=>'كود الدولة',
                                'class'=>'form-control',"autocomplete" =>"on" ))!!}
                                {!! $errors->first('code','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">فتح الخط 
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('lineOpen','',array('placeholder'=>'فتح الخط','class'=>'form-control',"autocomplete" =>"on" ))!!}
                                {!! $errors->first('lineOpen','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">لوغو الدولة 
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::file('logo')!!}
                                {!! $errors->first('logo','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
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