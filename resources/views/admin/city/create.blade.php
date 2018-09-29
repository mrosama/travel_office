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
                    <span class="caption-subject font-green bold uppercase">  اضافه مدينة جديده</span>
                </div>
                <a href="{{URL::to('/admin/city')}}" class="btn btn-success" style="float: left">عرض جميع المدن</a>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {!!Form::open(array('url' => 'admin/city','method'=>'post','class'=>'form-horizontal'))!!}
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
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::select('country_id', $countries , '',array('placeholder'=>'اسم الدولة', "autofocus"=>"autofocus",'class'=>'form-control bs-select' , 'data-live-search' => 'true'))!!}
                                {!! $errors->first('country_id','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <a href="{{URL::to('/admin/country/create')}}" target="_blank" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة دولة </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">اسم المدينة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('name','',array('placeholder'=>'اسم المدينة','class'=>'form-control',  "autocomplete" =>"on" ))!!}
                                {!! $errors->first('name','<div class="alert alert-danger">:message</div>')!!}                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">فتح الخط
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('lineOpen' , '' , ['placeholder' => 'فتح الخط' , 'class' => 'form-control' , 'autocomplete' => 'on'])!!}
                                {!! $errors->first('lineOpen','<div class="alert alert-danger">:message</div>')!!}
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