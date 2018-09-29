@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/advertisements">الاعلانات و البنرات</a>
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
                    <span class="caption-subject font-green bold uppercase">  اضافه اعلان جديد</span>
                </div>
                <a href="{{URL::to('admin/advertisements')}}" class="btn btn-danger" style="float: left"> عرض جميع الاعلانات </a>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {{Form::open(array('route' => 'admin.advertisements.store', 'method'=>'post' , 'files'=>'true' , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
                <div class="form-body">

                    @if(Session::has('global_s'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('global_s')}}
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-3">اسم مصصم الاعلان</label>
                        <div class="col-md-7">
                            {{Form::select('designer_id' , $designers , '' , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار المصمم' , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'required'])}}
                            <font color="red">{{$errors->first('designer_id')}}</font><br>
                        </div>
                        <div class="col-md-2">
                            <a href="{{URL::to('/admin/designer_advertising/create')}}" class="btn btn-success" target="_blank"><i class="fa fa-plus"></i> اضافة مصمم جديد </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">عنوان الاعلان</label>
                        <div class="col-md-8">
                            {{Form::text('title' ,'', ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('title')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">الجوال</label>
                        <div class="col-md-8">
                            {{Form::text('mobile' ,'', ['class'=>'form-control' , "autocomplete" =>"on" , 'required' , 'number'])}}
                            <font color="red">{{$errors->first('mobile')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">الهاتف</label>
                        <div class="col-md-8">
                            {{Form::text('phone' ,'', ['class'=>'form-control' , "autocomplete" =>"on" , 'required' , 'number'])}}
                            <font color="red">{{$errors->first('phone')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">البريد الالكترونى</label>
                        <div class="col-md-8">
                            {{Form::email('email' ,'', ['class'=>'form-control' , "autocomplete" =>"on" , 'required' , 'email'])}}
                            <font color="red">{{$errors->first('email')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">بداية الاعلان</label>
                        <div class="col-md-8">
                            {{Form::date('start' ,'', ['class'=>'form-control' , "autocomplete" =>"on" , 'required' , 'date'])}}
                            <font color="red">{{$errors->first('start')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">نهاية الاعلان</label>
                        <div class="col-md-8">
                            {{Form::date('end' ,'', ['class'=>'form-control' , "autocomplete" =>"on" , 'required' , 'date'])}}
                            <font color="red">{{$errors->first('end')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">عدد ايام الاعلان</label>
                        <div class="col-md-8">
                            {{Form::text('duration' ,'', ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('duration')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">الدولة</label>
                        <div class="col-md-8">
                            {{Form::select('country' , $countries , '' , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار الدولة' , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'required'])}}
                            <font color="red">{{$errors->first('country')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">المدينة</label>
                        <div class="col-md-8">
                            {{Form::select('city' , [''=>'من فضلك قم باختيار الدولة اولا'] , '' , ['class'=>'form-control' , "autocomplete" =>"on" , "data-live-search"=>"true" , 'required'])}}
                            <font color="red">{{$errors->first('city')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">التصميم</label>
                        <div class="col-md-8">
                            {{Form::file('file' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('file')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">ملاحظات</label>
                        <div class="col-md-8">
                            {{Form::textarea('notes' ,'', ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
                            <font color="red">{{$errors->first('notes')}}</font><br>
                        </div>
                    </div>
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
    <script type="text/javascript" src="{{URL::to('/assets/getCityAjax.js')}}"></script>

    @stop

    @stop