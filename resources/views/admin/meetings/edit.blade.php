@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
@section('CssLinks')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
@stop

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/meetings">الاجتماعات</a>
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
                    <span class="caption-subject font-green bold uppercase">  اضافه اجتماع جديد</span>
                </div>
            </div>

            <div class="portlet-body">
                @foreach($errors->all() as $error)
                {{$error}}
                @endforeach
                <!-- BEGIN FORM-->
                {{Form::open(array('route' => ['admin.meetings.update' , $data['meeting']->id] , 'method'=>'put' , 'files'=>'true' , 'class'=>'form-horizontal'))}}
                <div class="form-body">

                    @if(Session::has('global_s'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('global_s')}}
                    </div>
                    @endif

                    <div class="form-group">
                        <label class="control-label col-md-3">عنوان الاجتماع</label>
                        <div class="col-md-8">
                            {{Form::text('address' , $data['meeting']->address , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('address')}}</font><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ الاجتماع</label>
                        <div class="col-md-8">
                            <div class="input-group date form_meridian_datetime" data-date="2012-12-21T15:25:00Z">
                                {{Form::text('date' , $data['meeting']->date , ['class'=>'form-control' , "autocomplete" =>"on"])}}
                                <span class="input-group-btn">
                                    <button class="btn default date-reset" type="button" style="padding-top: 10px">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <button class="btn default date-set" type="button" style="padding-top: 10px">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">مكان الاجتماع</label>
                        <div class="col-md-8">
                            {{Form::select('meet_place_id' , $data['places'] , $data['meeting']->meet_place_id , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'placeholder'=>'من فضلك اختر المكان'])}}
                            <font color="red">{{$errors->first('meet_place_id')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">نوع الاجتماع</label>
                        <div class="col-md-8">
                            {{Form::select('meet_type_id' , $data['types'] , $data['meeting']->meet_type_id  , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'placeholder'=>'من فضلك اختر النوع'])}}
                            <font color="red">{{$errors->first('meet_type_id')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">نبذه عن الاجتماع</label>
                        <div class="col-md-8">
                            {{Form::textarea('brief' , $data['meeting']->brief , ['class'=>'form-control'])}}
                            <font color="red">{{$errors->first('brief')}}</font><br>
                        </div>
                    </div>

                    <fieldset>
                        <legend>المدعوين</legend>

                        <div class="form-group">
                            <label class="control-label col-md-3">الموظفين المدعوين</label>
                            <div class="col-md-8">
                                {{Form::select('employee_id[]' , $data['employees'] , json_decode($data['meeting']->employee_id) , ['class'=>'form-control select2-multiple' , 'id'=>'multiple' , 'multiple' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "data-live-search"=>"true" ])}}
                                <font color="red">{{$errors->first('employee_id')}}</font><br>
                            </div>
                        </div>

                        <div>
                            <div class="form-group">
                                <label class="control-label col-md-3">الفرع</label>
                                <div class="col-md-8">
                                    {{Form::select('office' , $data['offices'] , '' , ['class'=>'form-control' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"bs-select form-control" , "data-live-search"=>"true" , 'placeholder'=>'من فضلك اختر فرع'])}}
                                    <font color="red">{{$errors->first('office')}}</font><br>
                                </div>

                                <div class="col-md-1">
                                    <a href="javascript:;" class="btn btn-icon-only green img-circle" id="addEmployee">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div> 
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">الموظفين</label>
                                <div class="col-md-8">
                                    {{Form::select('employee_id[]' , [] , '' , ['class'=>'form-control select2-multiple' , 'id'=>'multiple' , 'multiple' , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "data-live-search"=>"true" ])}}
                                    <font color="red">{{$errors->first('employee_id')}}</font><br>
                                </div>
                            </div>
                        </div>
                        <div id="getNewEmplyee"></div>

                    </fieldset>

                    <div class="form-actions">
                        <div class="row">
                            <div class="text-center">
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

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{URL::to('/')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="{{URL::to('/')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->


    <script src="{{URL::to('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{URL::to('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

    <script type="text/javascript">


var newEmployee = '<div><div class="form-group"><label class="control-label col-md-3">الفرع</label><div class="col-md-8">{{Form::select("office" , $data["offices"] , "" , ["class"=>"form-control" , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "class"=>"bs-select form-control" , "data-live-search"=>"true" , "placeholder"=>"من فضلك اختر فرع"])}}<font color="red">{{$errors->first("office")}}</font><br></div><div class="col-md-1"><a href="javascript:;" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white  tooltips removeParent"><i class="fa fa-times"></i></a></div> </div><div class="form-group"><label class="control-label col-md-3">الموظفين</label><div class="col-md-8">{{Form::select("employee_id[]" , [] , "" , ['class'=>'form - control select2 - multiple' , 'id'=>"multiple" , "multiple" , "autofocus"=>"autofocus" , "autocomplete" =>"on" , "data-live-search"=>"true" ])}}<font color="red">{{$errors->first("employee_id")}}</font><br></div></div><div><br><br>';

$('#addEmployee').click(function (event) {
    $('#getNewEmplyee').append(newEmployee);
    $('select').selectpicker('refresh');
});

$(document).on('click', '.removeParent', function () {
    $(this).parent().parent().parent().remove();
});

$(document).on('change', 'select[name="office"]', function () {
    var employee = $(this).parent().parent().parent().parent().find('select[name="employee_id[]"]');
    console.log(employee);

    $.ajax({
        url: $('#base_url').val() + '/getEmployees',
        data: {id: $(this).val()},
    })
            .done(function (data) {
                employee.empty();
                if (data == 0)
                {
                    employee.append("<option value=''>لا يوجد اى موظفين فى هذا الفرع</option>")
                } else {
                    $.each(data, function (index, val) {
                        employee.append("<option value='" + val.id + "'>" + val.name + "</option>");
                    });
                }
                $('select').selectpicker('refresh');
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });

});
    </script>

    @stop

    @stop