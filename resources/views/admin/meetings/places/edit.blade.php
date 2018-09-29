@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/meeting_places">اماكن الاجتماعات</a>
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
                    <span class="caption-subject font-green bold uppercase">  تعديل مكان اجتماع </span>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {{Form::open(array('route' => ['admin.meeting_places.update' , $place->id ], 'method'=>'put' , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
                <div class="form-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-3">مكان الاجتماع</label>
                        <div class="col-md-8">
                            {{Form::text('place' , $place->place , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('place')}}</font><br>
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
    @stop