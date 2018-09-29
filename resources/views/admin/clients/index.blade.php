@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/client">قائمة العملاء</a>
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
                    <span class="caption-subject bold uppercase"> عرض العملاء</span>
                </div>
                <div class="actions">

                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="btn-group">
                                <button id="sample_editable_1_new" onclick="SendEmailGroup();"class="btn blue">
                                    ارسال بريد الكتروني للاعضاء المحددين
                                    <i class="fa fa-envelope-o"></i>
                                </button>
                            </div>
                            <div class="btn-group">
                                <button id="sample_editable_1_new" onclick="SendSmsGroup();"class="btn  green">
                                    ارسال رسالة نصية للاعضاء المحددين
                                    <i class="fa fa-envelope-o"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    @if (Session::has('error')) 
                    <div class="alert alert-danger"  style="text-align: right;"><strong>خطأ! </strong>{{Session::get('error')}}</div>
                    @endif
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /> 
                            </th>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>الجنسية</th>
                            <th>الدولة</th>
                            <th>المدينة</th>
                            <th>الصورة</th>
                            <th>البريد الالكتروني</th>
                            <th>الهاتف</th>
                            <th>تعديل</th>
                            <th>حذف</th>
                            <th>عرض وطباعة</th>
                            <th>ارسال بريد الكتروني</th>
                            <th>ارسال رسالة نصية</th>
                            <th>بيانات تسجيل الدخول</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr class="odd gradeX">
                            <td>
                                <input type="checkbox" class="checkboxes client_selected"  name="client_selected[]" value="{{$client->id}}" /> 
                            </td>
                            <td>{{$client->id}}</td>
                            <td>{{$client->username}}</td>
                            <td>{{$client->nationality}}</td>
                            <td>{{$client->getCountry['name']}}</td>
                            <td>{{$client->getCityName['name']}}</td>
                            <td><img src="{{URL::to('/').$client->photo}}" width="75px"/></td>
                            <td>{{$client->email_address}}</td>
                            <td>{{$client->phone}}</td>
                            <td style="display:flex">
                                {{--Link_to_route('admin.clients.edit' , 'تعديل ' , $client->id)--}}
                                <a href="{{URL::to('/admin/clients/edit/first').'/'.$client->id}}">تعديل</a>
                            </td>	
                            <td>
                                {{Form::open(['route'=>['admin.clients.destroy' , $client->id] ,'method'=>'delete' , 'id'=>'form'])}}
                                <a href="javascript:;" onclick="if (confirm('هل أنت متأكد من عملية الحذف؟!'))
                                            $('form').submit();"> حذف</a>
                                {{Form::close()}}
                            </td>
                            <td>
                                {{Link_to_route('admin.clients.show' , 'عرض وطباعة ' , $client->id)}}
                            </td>
                            <td>
                                {{Link_to_route('admin.clients.send_email' , 'ارسال بريد الكتروني' , $client->id)}}
                            </td>
                            <td>
                                {{Link_to_route('admin.clients.send_sms' , 'ارسال رسالة نصية' , $client->id)}}
                            </td>
                            <td>
                                <a href="#openModal">بيانات تسجيل الدخول</a>
                                <div id="openModal" class="modalDialog">
                                    <div>	
                                        <a href="#close" title="Close" class="close-M">X</a>

                                        <h2 style="margin-top:5px">
                                            بيانات التسجيل 
                                        </h2>
                                        <div class="log-info"> 
                                            <div>اسم المستخدم: {{$client->user->user_name}}</div>
                                            <div>كلمة المررو: {{$client->user->shown_password}}</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>




            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>



@stop