@extends ('admin.layouts.master')
@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> وسائل النقل
    <small>اضافة وسيلة نقل جديدة</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/admin')}}">الرئيسية</a>
            <i class="fa fa-angle-left"></i>
        </li>
        <li>
            <a href="{{URL::to('admin/transportations')}}">وسائل النقل</a>
            <i class="fa fa-angle-left"></i>
        </li>
        <li>
            <span>اضافة وسيلة نقل جديدة</span>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bubble font-green"></i>
                    <span class="caption-subject font-green bold uppercase">  اضافه وسيلة نقل جديدة</span>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {!!Form::open(array('route' => 'admin.transportations.store','method'=>'post','class'=>'form-horizontal'))!!}
                <div class="form-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-3">وسيلة النقل
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('transName','',array('placeholder'=>'وسيلة النقل','class'=>'form-control' ,"autocomplete" =>"on"))!!}
                                {!! $errors->first('transName','<div class="alert alert-danger">:message</div>')!!}                            
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