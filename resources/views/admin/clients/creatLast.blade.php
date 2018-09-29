@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
             مراجعة وتأكيد بيانات العميل 
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> مراجعة وتأكيد بيانات العميل</span>
                </div>
                <div class="actions">

                </div>
            </div>
            <div class="portlet-body">
                <h3>بيانات العميل</h3>
                <table class="table table-striped   table-checkable order-column" >
                    <tbody>
                        <tr>
                            <th style="width: 50%;">اسم المستخدم</th>
                            <td>{{Session::has('userInfo.user_name') ? Session::get('userInfo.user_name') : ""}}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;"> كلمة المرور</th>
                            <td>{{Session::has('userInfo.password') ? Session::get('userInfo.password') : '' }}</td>

                        </tr>
                        <tr>
                            <th style="width: 50%;"> نوع المستخدم</th>
                            <td>
                                @if(Session::get('userInfo')['userType'] == 'foreign')
                                اجنبي
                                @else
                                عربي
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">الاسم بالعربية</th>
                            <td>{{Session::has('userInfo.username') ? Session::get('userInfo.username')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">  الاسم بالانجليزية</th>
                            <td>{{Session::has('userInfo.username_en') ? Session::get('userInfo.username_en')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">  الجنسية</th>
                            <td>{{Session::has('userInfo.nationality') && !empty(Session::get('userInfo.nationality')) ?  \App\Http\Models\Country::where('code',Session::get('userInfo.nationality'))->first()->name : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">  الدولة</th>
                            <td>{{Session::has('userInfo.country') && !empty(Session::get('userInfo.country')) ?  \App\Http\Models\Country::where('code',Session::get('userInfo.country'))->first()->name : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">  المدينة</th>
                            <td>{{Session::has('userInfo.city') && !empty(Session::get('userInfo.city')) ?  \App\Http\Models\City::find(Session::get('userInfo.city'))->name : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">  رقم الجوال</th>
                            <td>{{Session::get('userInfo.code')}}{{Session::has('userInfo.mobile') ? Session::get('userInfo.mobile')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">  تاريخ الميلاد</th>                            
                            <td>{{Session::has('userInfo.birth_date') ? Session::get('userInfo.birth_date')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;"> اسم الام </th>
                            <td>{{Session::has('userInfo.mother_name') ? Session::get('userInfo.mother_name')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">  البريد الالكتروني</th>
                            <td>{{Session::has('userInfo.email_address') ? Session::get('userInfo.email_address')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">   التلفون</th>
                            <td>{{Session::has('userInfo.phone') ? Session::get('userInfo.phone')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">   فاكس</th>
                            <td>{{Session::has('userInfo.fax') ? Session::get('userInfo.fax')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">   تويتر</th>
                            <td>{{Session::has('userInfo.twitter') ? Session::get('userInfo.twitter')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">   انستغرام</th>
                            <td>{{Session::has('userInfo.instgram') ? Session::get('userInfo.instgram')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">  سكايب </th>
                            <td>{{Session::has('userInfo.skype') ? Session::get('userInfo.skype')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">  فيس بوك </th>
                            <td>{{Session::has('userInfo.facebook') ? Session::get('userInfo.facebook')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">   رقم الجواز</th>
                            <td>{{Session::has('userInfo.passport_number') ? Session::get('userInfo.passport_number')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">   تاريخ اصدار الجواز</th>
                            <td>{{Session::has('userInfo.issue_date') ? Session::get('userInfo.issue_date')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">   تاريخ انتهاء الجواز</th>
                            <td>{{Session::has('userInfo.expire_date') ? Session::get('userInfo.expire_date')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">  مكان اصدار الجواز </th>
                             <td>{{Session::has('userInfo.passport_issue_place') && !empty(Session::get('userInfo.passport_issue_place')) ?  \App\Http\Models\Country::where('code',Session::get('userInfo.passport_issue_place'))->first()->name : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">   السجل المدني /الاقامة</th>
                            <td>{{Session::has('userInfo.residence_number') ? Session::get('userInfo.residence_number')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">  ملاحظات </th>
                            <td>{{Session::has('userInfo.notes') ? Session::get('userInfo.notes')  : '' }}</td>
                        </tr>
                    </tbody>
                </table>

                <br>
                <h3>بيانات الرخصة</h3>
                <table class="table table-striped   table-checkable order-column" >
                    <tbody>
                        <tr>
                            <th style="width: 50%;"> رقم البطاقة</th>
                            <td>{{Session::has('userInfo.id_number') ? Session::get('userInfo.id_number')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">  تاريخ اصدار الرخصة</th>
                            <td>{{Session::has('userInfo.license_issue_date') ? Session::get('userInfo.license_issue_date')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">  تاريخ انتهاء الرخصة</th>
                            <td>{{Session::has('userInfo.license_expire_date') ? Session::get('userInfo.license_expire_date')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">  جهة اصدار الرخصة</th>
                            <td>{{Session::has('userInfo.issuer') ? Session::get('userInfo.issuer')  : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 50%;"> رقم الحفظ</th>
                            <td>{{Session::has('userInfo.conservation_number') ? Session::get('userInfo.conservation_number')  : '' }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <a href="{{ URL::to('admin/clients/confirm/last') }}" class="btn btn-success">حفظ البيانات <i class="fa fa-check"></i></a>
                            <a href="{{ URL::to('admin/clients/create/second') }}" class="btn btn-danger">السابق </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@stop