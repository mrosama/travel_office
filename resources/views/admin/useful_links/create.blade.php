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
                    <span class="caption-subject font-green bold uppercase">  اضافه رابط \ موقع جديد</span>
                </div>
                <a href="{{URL::to('/admin/useful_link')}}" target="_blank" class="btn btn-danger" style="float: left; margin-top:5px; "> عرض الكل</a>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {!!Form::open(array('url' => 'admin/useful_link','method'=>'post','class'=>'form-horizontal' , 'files' => true ))!!}
                <div class="form-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif

                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">العنوان
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('title','',array('placeholder'=>'مثلا "معرفة حالة الطقس"', "autofocus"=>"autofocus",'class'=>'form-control'))!!}
                                {!! $errors->first('title','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">الرابط
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('link','',array('placeholder'=>'http://www.google.com','class'=>'form-control'))!!}
                                {!! $errors->first('link','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">نبذة
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::textarea('notes','',array('placeholder'=>'نبذة عن الرابط او الموقع','class'=>'form-control'))!!}
                                {!! $errors->first('notes','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">اللوجو
                        </label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {{Form::file('logo')}}
                                {!! $errors->first('logo','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group margin-top-20">
                        <label class="control-label col-md-3">
                            مرفقات
                        </label>
                        <div class="col-md-4">
                            <button type="button" onclick="addAttachment()" class="btn red btn-sm">اضف ملفات</button>

                        </div>
                    </div>
                    <div id="newAttachment"></div>
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
    function addAttachment()
    {
        var newAttachment = '<div class="form-group  margin-top-20">' +
                '<label class="control-label col-md-3"></label>' +
                '<div class="col-md-4">' +
                '<div class="input-icon right">' +
                '<i class="fa"></i>' +
                '<input type="file" name="attachment[]">' +
                '</div>' +
                '</div>' +
                '</div>';
        $('#newAttachment').append(newAttachment);
    }
</script>
@stop


@stop