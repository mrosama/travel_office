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
                    <span class="caption-subject font-green bold uppercase"> 
                        ارسال بريد الكتروني لشركة  - {{$company->name}}
                    </span>
                </div>

            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {!!Form::open(array('route' => 'admin.company.do_send_email','method'=>'post','class'=>'form-horizontal'))!!}
                <div class="form-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif
                    <!-- Company id -->
                    <input type="hidden" value="{{$company->id}}" type="text" name="companyId">
                    <div class="form-group">
                        <label class="control-label col-md-3">البريد الالكتروني
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('email', $company->email ,array('placeholder'=>'EMAIL','class'=>'form-control','readonly'))!!}
                                {!! $errors->first('email','<div class="alert alert-danger">:message</div>')!!}    
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">عنوان الرسالة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('title','',array('placeholder'=>'عنوان الرسالة', "autofocus"=>"autofocus" ,'class'=>'form-control','maxlength'=>'50'))!!}
                                {!! $errors->first('title','<div class="alert alert-danger">:message</div>')!!}    
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3"> نص الرسالة
                            <span class="required">*</span></label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {{Form::textarea('msg' , '' , ['placeholder' => 'نص الرسالة' , 'class' => 'form-control'])}}
                                {!! $errors->first('msg','<div class="alert alert-danger">:message</div>')!!}    
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">ارسال</button>
                                <a href="{{URL::route('admin.company.index')}}" class="btn red"> عودة لقائمة الشركات</a>
                            </div>
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