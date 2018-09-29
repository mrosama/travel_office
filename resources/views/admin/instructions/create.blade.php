@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/instructions">المعلومات الخاصة و العامة</a>
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
                    <span class="caption-subject font-green bold uppercase">  اضافه معلومات جديدة</span>
                </div>
            </div>

            <div class="portlet-body">

                <!-- BEGIN FORM-->
                {{Form::open(array('route' => 'admin.instructions.store', 'method'=>'post' , 'files'=>'true' , 'class'=>'form-horizontal'))}}
                <div class="form-body">

                    @if(Session::has('global_s'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('global_s')}}
                    </div>
                    @endif


                    <div class="form-group">
                        <label class="control-label col-md-3">النوع</label>
                        <div class="col-md-8">

                            <div class="col-md-4">
                                خاص للعميل{{Form::radio('type' , 's' , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" ])}}
                            </div>
                            <div class="col-md-4">
                                عام للعميل{{Form::radio('type' , 'g' , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" ])}}
                            </div>
                            <div class="col-md-4">
                                خاص للمكتب{{Form::radio('type' , 'o' , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" ])}}
                            </div>
                            <font color="red">{{$errors->first('type')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">عنوان المعلومة</label>
                        <div class="col-md-8">
                            {{Form::text('title', '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'placeholder' => 'عنوان المعلومة'])}}
                            <font color="red">{{$errors->first('title')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الدولة</label>
                        <div class="col-md-8">
                            {{Form::select('country' , $data['countries'] , '' , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار الدولة' , "class"=>"bs-select form-control" , "data-live-search"=>"true"])}}
                            <font color="red">{{$errors->first('country')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">المدينة</label>
                        <div class="col-md-8">
                            {{Form::select('city' , [''=>'من فضلك قم باختيار الدولة اولا'] , '' , ['class'=>'form-control' , "autocomplete" =>"on" , "data-live-search"=>"true"])}}
                            <font color="red">{{$errors->first('city')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">ملف</label>
                        <div class="col-md-8">
                            {{Form::file('file' , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('file')}}</font><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">ملاحظات</label>
                        <div class="col-md-8">
                            {{Form::textarea('notes', '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'placeholder' => 'ملاحظات'])}}
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