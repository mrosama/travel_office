@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/income">الايرادات</a>
        </li>
        <i class="fa fa-angle-left"></i>
        <li>اضافة ايراد جديد</li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bubble font-green"></i>
                    <span class="caption-subject font-green bold uppercase">  اضافة ايراد جديد</span>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {!!Form::open(array('url' => 'admin/income','method'=>'post','class'=>'form-horizontal' , 'files' => 'true' , 'id'=>'form'))!!}
                <div class="form-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif

                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">نوع الايراد
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {!!Form::select('income_type_id', $income_types , '',array('placeholder'=>'من فضلك اختر نوع الايراد', "autofocus"=>"autofocus","class"=>"bs-select form-control" , "data-live-search"=>"true" , 'id' => "employee_id" , 'required'))!!}
                            {!! $errors->first('income_type_id','<div class="alert alert-danger">:message</div>')!!}
                        </div>
                    </div>

                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">اسم الموظف
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {!!Form::select('employee_id', $all_employee , '',array('placeholder'=>'اسم الموظف', "autofocus"=>"autofocus","class"=>"bs-select form-control" , "data-live-search"=>"true" , 'required'))!!}
                            {!! $errors->first('employee_id','<div class="alert alert-danger">:message</div>')!!}
                            <div id="EmployeeInfo"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">المبلغ المستلم
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('receipt','',array('placeholder'=>'المبلغ المستلم','class'=>'form-control',  "autocomplete" =>"on" , 'required'))!!}
                                {!! $errors->first('receipt','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">اسم البنك
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('bank','',array('placeholder'=>'اسم البنك','class'=>'form-control',  "autocomplete" =>"on" , 'required'))!!}
                                {!! $errors->first('bank','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>


                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">نوع الاستلام
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {!!Form::select('receipt_type', ['cash'=>'كاش' , 'check' => "شيك" , 'exchange' => 'صرافة'] , '',array('placeholder'=>'نوع الاستلام', "autofocus"=>"autofocus","class"=>"bs-select form-control" , "data-live-search"=>"true" , 'required'))!!}
                            {!! $errors->first('receipt_type','<div class="alert alert-danger">:message</div>')!!}
                            <div id="EmployeeInfo"></div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class= "control-label col-md-3"> صورة الاستلام
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8"> 
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {{Form::file('receipt_photo' , ['required'])}}
                                {!! $errors->first('receipt_photo','<div class="alert alert-danger">:message</div>')!!}     
                            </div>
                        </div>	
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ الاستلام
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                <input class="form-control" required date name="receipt_date" size="16" type="date">
                                {!! $errors->first('receipt_date','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">اجمالي الاستلام اليومي
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('receipt_daily_total','',array('placeholder'=>'اجمالي الاستلام اليومي','class'=>'form-control',  "autocomplete" =>"on" , 'required'))!!}
                                {!! $errors->first('receipt_daily_total','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">عدد مرات الاستلام اليومي
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('receipt_daily_number','',array('placeholder'=>'عدد مرات الاستلام اليومي','class'=>'form-control',  "autocomplete" =>"on" , 'required'))!!}
                                {!! $errors->first('receipt_daily_number','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>

                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">مصدر المبلغ
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {!!Form::select('money_source', ['tickets'=>'تذاكر' , 'hotel' => "فنادق"] , '',array('placeholder'=>'مصدر المبلغ', "autofocus"=>"autofocus","class"=>"bs-select form-control" , "data-live-search"=>"true" ,'required'))!!}
                            {!! $errors->first('money_source','<div class="alert alert-danger">:message</div>')!!}
                            <div id="EmployeeInfo"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">ملاحظات
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::textarea('notes','',array('placeholder'=>'ملاحظات', 'class'=>'form-control',  "autocomplete" =>"on" , 'required'))!!}
                                {!! $errors->first('notes','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-md-3">الاجمالي
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('total','',array('placeholder'=>'الاجمالي','class'=>'form-control',  "autocomplete" =>"on" , 'required'))!!}
                                {!! $errors->first('total','<div class="alert alert-danger">:message</div>')!!}                            
                            </div>
                        </div>
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
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>

@section('JsScripts')

<script type="text/javascript">
$(document).on('change', 'select[name="employee_id"]', function (event) {
    var thisEmployee = $(this);

    $.ajax({
        url: $('#base_url').val() + '/getEmployeeInformation',
        data: {id: this.value},
    })
            .done(function (data) {
                if (data == 0)
                    thisEmployee.parent().parent().find('#EmployeeInfo').hide();
                else
                {
                    console.log(data);
                    thisEmployee.parent().parent().find('#EmployeeInfo').show();
                    thisEmployee.parent().parent().find('#EmployeeInfo').addClass('well');
                    thisEmployee.parent().parent().find('#EmployeeInfo').html("صورة الموظف: <img class='img-circle' width='50' height='50' src='" + $('#base_url').val() + "/employee/profile/" + data.profile_img + "'>" + "<br>اسم الموظف: " + data.name + "<br>الهاتف " + data.mobile + "<br>نوع العمل: " + data.work_type);
                }
            })
});
</script>
@stop

@stop