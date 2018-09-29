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
                    <span class="caption-subject font-green bold uppercase">اضافة عميل جديد</span>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {!!Form::open(array('url' => 'admin/clients/check/second','method'=>'post','class'=>'form-horizontal' , 'files' => true))!!}
                <div class="form-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif	
                    <h3>بيانات الرخصة</h3><br>
                    <div class="form-group">
                        <label class="control-label col-md-3">رقم البطاقة<span class="required"> * </span></label>
                        <div class="col-md-8">
                            {{Form::text('id_number' , Session::has('userInfo.id_number') ?  Session::get('userInfo')['id_number'] : ''  , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('id_number')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">صورة الرخصة<span class="required"> * </span></label>
                        <div class="col-md-8">
                            {{Form::file('license_copy' ,  ['class' => 'form-control'])}}
                            @if(Session::has('userInfo.license_copy'))
                            <image src="{{URL::to('/').'/'.Session::get('userInfo.license_copy')}}" width="100px;" />
                            @endif
                            <font color="red">{{$errors->first('license_copy')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ اصدار الرخصة<span class="required"> * </span></label>
                        <div class="col-md-8">
                            <input class="form-control form-control-inline date-picker"   placeholder="dd/mm/yyyy" name="license_issue_date"  value="{{Session::has('userInfo.license_issue_date') ?  Session::get('userInfo')['license_issue_date'] : '' }}" id="license_issue_date"  type="text" data-date-format="dd/mm/yyyy" data-date-end-date="+0d" />
                            <span class="help-block"> d/m/y </span>
                            <font color="red">{{$errors->first('license_issue_date')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ انتهاء الرخصة<span class="required"> * </span></label>
                        <div class="col-md-8">
                            <input class="form-control form-control-inline date-picker"   placeholder="dd/mm/yyyy" name="license_expire_date"  value="{{Session::has('userInfo.license_expire_date') ?  Session::get('userInfo')['license_expire_date'] : '' }}" id="license_expire_date"  type="text" data-date-format="dd/mm/yyyy" />
                            <span class="help-block"> d/m/y </span>
                            <font color="red">{{$errors->first('license_expire_date')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">جهة اصدار الرخصة<span class="required"> * </span></label>
                        <div class="col-md-8">
                            {{Form::text('issuer' , Session::has('userInfo.issuer') ?  Session::get('userInfo')['issuer'] : '' , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('issuer')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">رقم الحفظ<span class="required"> * </span></label>
                        <div class="col-md-8">
                            {{Form::text('conservation_number' , Session::has('userInfo.conservation_number') ?  Session::get('userInfo')['conservation_number'] : ''  , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('conservation_number')}}</font>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">التالي</button>
                            <a href="{{ URL::to('admin/clients/create/first') }}" class="btn btn-danger">السابق </a>
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

@stop

@stop