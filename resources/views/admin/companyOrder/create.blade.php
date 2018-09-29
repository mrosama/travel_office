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
                    <span class="caption-subject font-green bold uppercase">  اضافه طلب للمؤسسة / الشركة</span>
                </div>
                <a href="{{URL::to('admin/companyOrder')}}" class="btn btn-success" style="float:left;">عرض الطلبات</a>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {!!Form::open(array('url' => 'admin/companyOrder','method'=>'post','class'=>'form-horizontal'))!!}
                <div class="form-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-3">اسم المؤسسة / الشركة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::select('companyId', $all_company , '',array('placeholder'=>'اسم المؤسسة / الشركة','class'=>'form-control bs-select','data-live-search' => 'true' ,  "autofoucs" => "autofoucs" , 'id' => 'companyId' , 'onchange' =>'getSection()' ))!!}
                                {!! $errors->first('companyId','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a href="{{URL::to('admin/company/create')}}" target="_blank" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> اضافة مؤسسة </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">اسم القسم
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <select name="sectionId" id="sectionId" onchange="getEmpName()" class="form-control bs-select" data-live-search='true' >
                                <option selected="" disabled="">اختر المؤسسة / الشركة اولا ...</option>
                            </select>
                            {!! $errors->first('sectionId','<div class="alert alert-danger">:message</div>')!!}                            
                        </div>
                        <div class="col-md-3">
                            <a href="{{URL::to('admin/companySection/create')}}" target="_blank" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> اضافة قسم </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">اسم الموظف
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <select id="empId" name="empId[]" multiple="" class="form-control bs-select" data-live-search="true">
                                <option selected="" disabled="">اختر قسم المؤسسة / الشركة اولا ...</option>
                            </select>
                            {!! $errors->first('empId','<div class="alert alert-danger">:message</div>')!!}   
                        </div>
                        <div class="col-md-3">
                            <a href="{{URL::to('admin/companyEmployee/create')}}" target="_blank" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> اضافة شركة </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">
                            نوع الطلب
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            {{Form::select('order_type' , $orders_types , '' , array('placeholder' =>  'نوع الطلب' , 'class' => 'form-control bs-select' , 'data-live-search' => 'true'))}}
                            {!! $errors->first('order_type' , '<div class="alert alert-danger">:message</div>')!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ الذهاب
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <input class="form-control form-control-inline date-picker"  name="date_takeoff" id="date_takeoff"  placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-start-date="+0d"  size="16" type="text">
                            {!! $errors->first('date_takeoff','<div class="alert alert-danger">:message</div>')!!}                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">عدد الايام
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::number('dayNumbers','',array('placeholder'=>'عدد الايام','class'=>'form-control',  "onchange" => "getDateArrival()"  , 'id' => 'dayNumbers' ,  "min" => "0" ,  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('dayNumbers','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ العودة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">

                            <input class="form-control form-control-inline date-picker"  name="date_arrival" id="date_arrival" placeholder="dd/mm/yyyy" data-date-start-date="+0d" data-date-format="dd/mm/yyyy" size="16" type="text">
                            {!! $errors->first('date_arrival','<div class="alert alert-danger">:message</div>')!!}                            

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">دولة الاقلاع
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {!!Form::select('country_takeoff', $countries , '',array('placeholder'=>'دولة الاقلاع ....','class'=>'bs-select form-control', 'data-live-search' => 'true' ,  'id' => 'country_takeoff' , 'onchange' =>'getCityTakeOff()'))!!}
                            {!! $errors->first('country_takeoff','<div class="alert alert-danger">:message</div>')!!}                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">مدينة الاقلاع
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <select name="city_takeoff" id="city_takeoff" class="form-control bs-select" data-live-search="true">
                                <option selected="" disabled="">اختر دولة الاقلاع اولا ...</option>
                            </select>
                            {!! $errors->first('city_takeoff','<div class="alert alert-danger">:message</div>')!!}                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">دولة الوصول
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {!!Form::select('country_arrival', $countries , '',array('placeholder'=>'دولة الوصول ....','class'=>'bs-select form-control', 'data-live-search'=> 'true' , 'id' => 'country_arrival' , 'onchange' =>'getCityArrival()'))!!}
                            {!! $errors->first('country_arrival','<div class="alert alert-danger">:message</div>')!!}    
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">مدينة الوصول
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <select name="city_arrival" id="city_arrival" class="form-control bs-select" data-live-search = 'true'>
                                <option selected="" disabled="">اختر دولة الوصول اولا ...</option>
                            </select>
                            {!! $errors->first('city_arrival','<div class="alert alert-danger">:message</div>')!!}                            
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
@section('JsScripts')
<script type="text/javascript">
    function getSection()
    {
    var companyId = $('#companyId').val();
    var baseurl = document.getElementById('baseurl').value;
    $.ajax({
    url:  baseurl + '/companyEmployee/getCompanySection',
            type: 'GET',
            data: {companyId},
            success : function(data){
            //console.log(data);
            $('#sectionId').empty();
            if (data == '')
            {
            var empty = "<option selected disabled>عفوا لا يوجد اقسام داخل هذه المؤسسة !</option>";
            $('#sectionId').html(empty);
            }
            else
            {
            $('#sectionId').html('<option value="0">جميع الاقسام</option>');
            $.each(data, function(i, val)
            {
            $('#sectionId').append('<option value=' + val.id + '>' + val.sectionName + '</option>')
            });
            }
            $('#sectionId').selectpicker('refresh');
            },
            error : function(e){
            console.log(e);
            }
    });
    // get All employees in this section
    $.ajax({
    url  : baseurl + '/companyEmployee/getEmployeesBySectionId',
            type : 'GET',
            data : {companyId},
            success : function(data){
            console.log(data);
            if (data != '')
            {
            $('#empId').empty();
            $('#empId').html('<option disabled vlaue="">اختر اسماء الموظفين</oprion>');
            $.each(data, function(i, val)
            {
            $('#empId').append('<option value=' + val.id + '>' + val.empName + '</option>')
            });
            }
            else
            {
            $('#empId').empty();
            $('#empId').html('<option vlaue="">عفوا لا يوجد موظفين لهذه الشركة حاليا !</oprion>');
            }
            $('#empId').selectpicker('refresh');
            }
    });
    }

    function getCityTakeOff()
    {

    var country = $('#country_takeoff').val();
    var baseurl = document.getElementById('baseurl').value;
    $.ajax({
    url:  baseurl + '/city/getCity',
            type: 'GET',
            data: {country},
            success : function(data){
            console.log(data);
            $('#city_takeoff').empty();
            if (data == '')
            {
            var empty = "<option selected disabled>عفوا لا يوجد مدن لهذه الدولة!</option>";
            $('#city_takeoff').html(empty);
            }
            else
            {
            $('#city_takeoff').html('<option value="" disabled>اختر مدينة الاقلاع</option>');
            $.each(data, function(i, val)
            {
            $('#city_takeoff').append('<option value=' + val.id + '>' + val.name + '</option>')
            });
            }
            $('#city_takeoff').selectpicker('refresh');
            },
            error : function(e){
            console.log(e);
            }
    });
    }


    function getCityArrival()
    {
    var country = $('#country_arrival').val();
    var baseurl = document.getElementById('baseurl').value;
    $.ajax({
    url:  baseurl + '/city/getCity',
            type: 'GET',
            data: {country},
            success : function(data){
            console.log(data);
            $('#city_arrival').empty();
            if (data == '')
            {
            var empty = "<option selected disabled>عفوا لا يوجد مدن لهذه الدولة!</option>";
            $('#city_arrival').html(empty);
            }
            else
            {
            $('#city_arrival').html('<option value="" disabled>اختر مدينة الوصو</option>');
            $.each(data, function(i, val)
            {
            $('#city_arrival').append('<option value=' + val.id + '>' + val.name + '</option>')
            });
            }
            $('#city_arrival').selectpicker('refresh');
            },
            error : function(e){
            console.log(e);
            }
    });
    }

    function getEmpName()
    {
    var companyId = $('#companyId').val();
    var sectionId = $('#sectionId').val();
    var baseurl = document.getElementById('baseurl').value;
    if (sectionId == 0)
    {
    // get All employees in this section
    $.ajax({
    url  : baseurl + '/companyEmployee/getEmployeesBySectionId',
            type : 'GET',
            data : {companyId},
            success : function(data){
            console.log(data);
            if (data != '')
            {
            $('#empId').empty();
            $('#empId').html('<option disabled vlaue="">اختر اسماء الموظفين</oprion>');
            $.each(data, function(i, val)
            {
            $('#empId').append('<option value=' + val.id + '>' + val.empName + '</option>')
            });
            }
            else
            {
            $('#empId').empty();
            $('#empId').html('<option vlaue="">عفوا لا يوجد موظفين لهذه الشركة حاليا !</oprion>');
            }
            $('#empId').selectpicker('refresh');
            }
    });
    }
    else
    {

    $.ajax({
    url:  baseurl + '/companyOrder/getEmpName',
            type: 'GET',
            data: {companyId : companyId, sectionId, sectionId},
            success : function(data){
            console.log(data);
            $('#empId').empty();
            if (data == '')
            {
            var empty = "<option selected disabled>عفوا لا يوجد موظفين داخل هذا القسم!</option>";
            $('#empId').html(empty);
            }
            else
            {
            $('#empId').html('<option disabled vlaue="">اختر اسماء الموظفين</oprion>');
            $.each(data, function(i, val)
            {
            $('#empId').append('<option value=' + val.id + '>' + val.empName + '</option>')
            });
            }
            $('#empId').selectpicker('refresh');
            },
            error : function(e){
            console.log(e);
            }
    });
    }

    }

</script>
@stop

@stop