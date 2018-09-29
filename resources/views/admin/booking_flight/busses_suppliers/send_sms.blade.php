@extends ('admin.layouts.master')
@section('content')

<!-- END PAGE HEADER-->

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/busses/suppliers">مزودى الباصات</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bubble font-green"></i>
                    <span class="caption-subject font-green bold uppercase"> 
                        ارسال رسالة نصية  لمجموعة من المزودين
                    </span>
                </div>

            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {!!Form::open(array('route' => 'suppliers.send.sms','method'=>'post','class'=>'form-horizontal'))!!}
                <div class="form-body">

                    @if(Session::has('global_s'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('global_s')}}
                    </div>
                    @endif

                    @if(Session::has('global_r'))
                    <div class="alert alert-danger" style="text-align : right;">
                        <strong>خطأ ! </strong> {{Session::get('global_r')}}
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-3" style="margin-top: -10px;">ارسال رسالة نصية  لجميع المزودين
                        </label>
                        <div class="col-md-8">
                            {{Form::checkbox('all_suppliers' , 1)}}
                        </div>
                    </div>
                    <div class="form-group" id="choose">
                        <label class="control-label col-md-3">اختر مجموعة مخصصة من المزودين </label>
                        <div class="col-md-8">
                            {{Form::select('mobiles[]' , $suppliers , '' , ['class'=>'form-control select2-multiple' , 'id'=>'multiple' , 'multiple'])}}
                            <font color="red">{{$errors->first('mobiles')}}</font>    
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"> نص الرسالة</label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {{Form::textarea('message' , '' , ['placeholder' => 'نص الرسالة' , 'class' => 'form-control'])}}
                                <font color="red">{{$errors->first('message')}}</font>    
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="text-center">
                                <button type="submit" class="btn green">ارسال</button>
                                <button type="reset" class="btn default">الغاء </button>
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

@section('JsScripts')
<script src="{{URL::to('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<script type="text/javascript">
$('input[name="all_suppliers"]').click(function (event) {
    if ($(this).is(':checked'))
        $('#choose').hide();
    else
        $('#choose').show();
});
</script>
@stop
@stop