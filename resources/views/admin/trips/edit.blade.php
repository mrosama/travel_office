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
            <a href="{{URL::to('/')}}/admin/trips ">انواع  الرحلات</a>
        </li>
        <i class="fa fa-angle-left"></i>
        <li>تعديل نوع الرحلة  </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form ">
            <div class="portlet-title">
                <div class="caption" style="float:right">
                    <i class="fa fa-user font-green"></i>
                    <span class="caption-subject font-green bold uppercase"> تعديل نوع الرحلة </span>
                </div>
            </div>

            <div class="portlet-body">

                <!-- BEGIN FORM-->
                {{Form::open(array('route' => ['admin.trips.update' , $trip->id], 'method'=>'patch'  , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
                <div class="form-body">

                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-3"> نوع الرحلة  
                        </label>
                        <div class="col-md-7">
                            {{Form::text('name' , $trip->name , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" , 'required'])}}
                        </div>
                    </div>
                    <div class="form-actions text-center">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-9">
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
    <script src="{{URL::to('/')}}/assets/form-validation.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{URL::to('/assets/getCityAjax.js')}}"></script>
    <script type="text/javascript">
$('#generatedPass').val(Math.random().toString(36).slice(-10));
$('#generatePass').click(function (event) {
    $('#generatedPass').val(Math.random().toString(36).slice(-10));
});
    </script>
    @stop

    @stop