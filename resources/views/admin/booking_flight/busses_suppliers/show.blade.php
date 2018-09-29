@extends('admin.layouts.master')
@section('content')

@section('CssLinks')
<link href="{{URL::to('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    .dola td{
        text-align: center !important;
    }
    td{
        width: 50%;
    }
</style>
@stop

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/busses/suppliers">المزودين</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">

        <div class="portlet light ">
            <div class="portlet-body">

                <div class="text-center">
                    <h2>
                        عرض بيانات المزود <font color="red" size="6">{{$busses_supplier->name}}</font>

                </div>

                <table class="table dola">
                    <tr>
                        <td>لوجو المزود</td>
                        <td><a href="{{URL::to($busses_supplier->logo)}}" id="single_image">{{HTML::image($busses_supplier->logo , '' , ['width'=>100 , 'height'=>100 , 'class'=>'img-circle' ])}}</a></td>
                    </tr>

                    <tr>
                        <td>اسم الفرع</td>
                        <td>{{$busses_supplier->bussesBranch->name}}</td>
                    </tr>

                    <tr>
                        <td>اسم الجهة</td>
                        <td>{{$busses_supplier->name}}</td>
                    </tr>

                    <tr>
                        <td>الهاتف</td>
                        <td>{{$busses_supplier->tel}}</td>
                    </tr>

                    <tr>
                        <td>الجوال</td>
                        <td>{{$busses_supplier->mobile}}</td>
                    </tr>

                    <tr>
                        <td>البريد الالكترونى</td>
                        <td>{{$busses_supplier->email}}</td>
                    </tr>

                    <tr>
                        <td>تويتر</td>
                        <td>{{$busses_supplier->twitter}}</td>
                    </tr>

                    <tr>
                        <td>فيس بوك</td>
                        <td>{{$busses_supplier->face}}</td>
                    </tr>
                    <tr>
                        <td>سكايب</td>
                        <td>{{$busses_supplier->skype}}</td>
                    </tr>
                    <tr>
                        <td>رقم السجل التجارى</td>
                        <td>{{$busses_supplier->Commercial_record_no}}</td>
                    </tr>
                    <tr>
                        <td>الدولة</td>
                        <td>{{$busses_supplier->country}}</td>
                    </tr>
                    <tr>
                        <td>المدينة</td>
                        <td>{{$busses_supplier->city}}</td>
                    </tr>
                    <tr>
                        <td>الشارع</td>
                        <td>{{$busses_supplier->street}}</td>
                    </tr>
                    <tr>
                        <td>صندوق البريد</td>
                        <td>{{$busses_supplier->mailbox}}</td>
                    </tr>
                    <tr>
                        <td>الرمز البريدى</td>
                        <td>{{$busses_supplier->postal_code}}</td>
                    </tr>
                    <tr>
                        <td>فاكس</td>
                        <td>{{$busses_supplier->fax}}</td>
                    </tr>
                    <tr>
                        <td>الموقع الالكترونى</td>
                        <td>{{$busses_supplier->website}}</td>
                    </tr>
                    <tr>
                        <td>صورة السجل التجارى</td>
                        <td><a href="{{URL::to($busses_supplier->commercial_reg_img)}}" id="single_image">{{HTML::image($busses_supplier->commercial_reg_img , '' , ['width'=>100 , 'height'=>100 , 'class'=>'img-circle' ])}}</a></td>
                    </tr>

                </table>
            </div>
        </div>

    </div>
</div>

@section('JsScripts')
<script src="{{URL::to('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function () {
    $("a#single_image").fancybox();
});
</script>
@stop

@stop