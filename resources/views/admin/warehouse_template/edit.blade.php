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
                    <span class="caption-subject font-green bold uppercase">  تعديل بيانات نموذج </span>
                </div>
                <a href="{{URL::to('admin/warehouse_template')}}" class="btn btn-danger" style="float: left"> عرض جميع النماذج </a>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {!!Form::open(array('route' => ['admin.warehouse_template.update' , $template->id],'method'=>'put', 'files' => true ,'class'=>'form-horizontal'))!!}
                <div class="form-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3"> عنوان النموذج
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('title', $template->title,array('placeholder'=>'عنوان النموذج','class'=>'form-control',"autocomplete" =>"on"  , "autofocus"=>"autofocus"))!!}
                                {!! $errors->first('title','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3"> نوع النموذج
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::select('type', [ 'public' => 'عام' , 'private' => 'خاص'] ,$template->type ,array('placeholder'=>'نوع النموذج','class'=>'form-control',"autocomplete" =>"on"))!!}
                                {!! $errors->first('type','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3"> الملف المرفق
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-3">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::file('attachment')!!}
                                {!! $errors->first('attachment','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a href="{{URL::to('/').'/'.$template->attachment}}" class="btn btn-success" target="_blank">رابط الملف المرفق مسبقا</a>
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
