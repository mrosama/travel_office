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
            <a href="{{URL::to('/')}}/admin/employee_vacations ">طلبات الاجازة</a>
        </li>
        <i class="fa fa-angle-left"></i>
        <li>تعديل طلب اجازة  </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form ">
            <div class="portlet-title">
                <div class="caption" style="float:right">
                    <i class="fa fa-user font-green"></i>
                    <span class="caption-subject font-green bold uppercase">تعديل طلب اجازة  </span>
                </div>
            </div>

            <div class="portlet-body">

                <!-- BEGIN FORM-->
                {{Form::open(array('route' => ['admin.employee_vacations.update', $employee_vacation->id] , 'method'=>'put'  , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
                <div class="form-body">

                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-3"> اسم  الموظف
                        </label>
                        <div class="col-md-7">
                            {{Form::select('emp_id' , $employees , $employee_vacation->emp_id , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" , 'placeholder' => 'اختر اسم الموظف ....'])}}
                            <font color="red">{{$errors->first('emp_id')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"> نوع الاجازة
                        </label>
                        <div class="col-md-7">
                            {{Form::select('vacation_type_id' , $vacation_types ,  $employee_vacation->vacation_type_id , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" , 'placeholder' => 'اختر نوع الاجازة ....'])}}
                            <font color="red">{{$errors->first('vacation_type_id')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"> عدد الايام المطلوبة
                        </label>
                        <div class="col-md-7">
                            {{Form::text('day_number' , $employee_vacation->day_number , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on"])}}
                            <font color="red">{{$errors->first('day_number')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"> تاريخ بداية الاجازة
                        </label>
                        <div class="col-md-7">
                            {{Form::text('vacation_start' , $employee_vacation->vacation_start , ['class' => 'form-control form-control-inline date-picker' , "autofocus"=>"autofocus" , 'placeholder' => 'dd/mm/yyyy', 'data-date-format' => 'dd/mm/yyyy' ,"autocomplete" =>"on" , 'id' =>'vacation_start'])}}
                            <font color="red">{{$errors->first('vacation_start')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"> تاريخ نهاية الاجازة
                        </label>
                        <div class="col-md-7">
                            {{Form::text('vacation_end' , $employee_vacation->vacation_end , ['class' => 'form-control form-control-inline date-picker' , "autofocus"=>"autofocus" , 'placeholder' => 'dd/mm/yyyy', 'data-date-format' => 'dd/mm/yyyy' ,"autocomplete" =>"on" , 'id' =>'vacation_end'])}}
                            <font color="red">{{$errors->first('vacation_end')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"> سبب الاجازة
                        </label>
                        <div class="col-md-7">
                            {{Form::text('reason' , $employee_vacation->reason , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on"])}}
                            <font color="red">{{$errors->first('reason')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"> طبيعة الاجازة
                        </label>
                        <div class="col-md-7">
                            {{Form::select('nature' , ['1' => 'اجازة براتب' , '2' => 'اجازة بدون راتب'] , $employee_vacation->nature , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ,  'placeholder' => 'اختر من فضلك....' ])}}
                            <font color="red">{{$errors->first('nature')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"> عدد الايام المتبقية
                        </label>
                        <div class="col-md-7">
                            {{Form::text('remaining' , $employee_vacation->remaining , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('remaining')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"> الاجازات السابقة
                        </label>
                        <div class="col-md-7">
                            {{Form::text('previous' , $employee_vacation->previous , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('previous')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"> ملاحظات
                        </label>
                        <div class="col-md-7">
                            {{Form::textarea('notes' , $employee_vacation->notes , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('notes')}}</font><br>
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