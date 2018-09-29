@extends('admin.layouts.master')

@section('content')

<h3 class="page-title"> العملاء
    <small>بيانات العميل</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}">الرئيسية</a>
            <i class="fa fa-angle-left"></i>
        </li>
        <li>
            <a href="{{URL::to('/admin/clients')}}">العملاء</a>
            <i class="fa fa-angle-left"></i>
        </li>
        <li>
            <span>عرض وطباعة بيانات العميل</span>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<div class="invoice-content-2 ">
    <div class="row invoice-head">
        <div class="col-md-7 col-xs-6">
            <div class="invoice-logo">
                <img src="{{URL::to('/')}}/assets/pages/img/logos/logo5.jpg" class="img-responsive" alt="">
                <h1 class="uppercase">بيانات العميل</h1>
            </div>
        </div>
        <div class="col-md-5 col-xs-6">

        </div>
    </div>
    <div class="row invoice-cust-add">
        <div class="col-xs-3">
            <h2 class="invoice-title uppercase">التاريخ</h2>
            <p class="invoice-desc">{{ date('d-m-Y') }}</p>
        </div>
    </div>
    <div class="row invoice-body">
        <div class="col-xs-12 table-responsive">
            <table class="table table-hover dola">
                <tbody>
                    <tr>
                        <td class="text-center sbold">الاسم بالكامل : </td>
                        <td class="text-center sbold">{{$client->username}}</td>
                        <td class="text-center sbold">الدولة : </td>
                        <td class="text-center sbold">{{$client->getCountry->name}}</td>
                    </tr>
                    <tr>
                        <td class="text-center sbold"> المدينة : </td>
                        <td class="text-center sbold">{{$client->getCityName->name}}</td>
                        <td class="text-center sbold">تاريخ الميلاد : </td>
                        <td class="text-center sbold">{{$client->birth_date}}</td>
                    </tr>
                    <tr>
                        <td class="text-center sbold"> اسم الام : </td>
                        <td class="text-center sbold">{{$client->mother_name}}</td>
                        <td class="text-center sbold">البريد الالكتروني : </td>
                        <td class="text-center sbold">{{$client->email_address}}</td>
                    </tr>
                    <tr>
                        <td class="text-center sbold"> رقم الهاتف : </td>
                        <td class="text-center sbold">{{$client->phone}}</td>
                        <td class="text-center sbold">فاكس : </td>
                        <td class="text-center sbold">{{$client->fax}}</td>
                    </tr>
                    <tr>
                        <td class="text-center sbold"> رقم الجواز : </td>
                        <td class="text-center sbold">{{$client->passport_number}}</td>
                        <td class="text-center sbold">تاريخ اصدار الجواز : </td>
                        <td class="text-center sbold">{{$client->issue_date}}</td>
                    </tr>
                    <tr>
                        <td class="text-center sbold"> تاريخ انتهاء الجواز : </td>
                        <td class="text-center sbold">{{$client->expire_date}}</td>
                        <td class="text-center sbold">السجل المدني / الاقامة : </td>
                        <td class="text-center sbold">{{$client->residence_number}}</td>
                    </tr>
                    <tr>

                        <td class="text-center sbold"> رقم البطاقة : </td>
                        <td class="text-center sbold">{{$client->id_number}}</td>


                    </tr>
                    <tr>
                        <td class="text-center sbold">تاريخ اصدار الرخصة : </td>
                        <td class="text-center sbold">{{$client->license_issue_date}}</td>
                        <td class="text-center sbold"> تاريخ انتهاء الرخصة : </td>
                        <td class="text-center sbold">{{$client->license_expire_date}}</td>

                    </tr>
                    <tr>
                        <td class="text-center sbold">رقم الحفظ : </td>
                        <td class="text-center sbold">{{$client->conservation_number}}</td>
                        <td class="text-center sbold"> جهة اصدار الرخصة : </td>
                        <td class="text-center sbold">{{$client->issuer}}</td>
                    </tr>
                    <tr>
                       <td class="text-center sbold">ملاحظات عن العميل : </td>
                       <td class="text-center sbold">{{$client->notes}}</td>
                   </tr>

               </tbody>
           </table>
       </div>
   </div>

   <div class="row">
    <div class="col-xs-12">
        <a class="btn btn-lg green-haze hidden-print uppercase print-btn" onclick="javascript:window.print();">Print</a>
    </div>
</div>
</div>


@stop