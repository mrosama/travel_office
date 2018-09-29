@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/company">المؤسسات والشركات</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع المؤسسات والشركات </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    @if (Session::has('success')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
                    @endif
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم المؤسسة</th>
                            <th>اسم صاحب المؤسسة</th>
                            <th>لوغو المؤسسة</th>
                            <th>الدولة</th>
                            <th>المدينة</th>
                            <th>السجل التجاري</th>
                            <th>صندوق البريد</th>
                            <th>الرمز البريدي</th>
                            <th>فاكس</th>
                            <th>البريد الالكتروني</th>
                            <th>الجوال</th>
                            <th>الهاتف</th>
                            <th>العنوان</th>
                            <th>ارسال بريد الكتروني</th>
                            <th>ارسال رسالة نصية</th>
                            <th>تعديل</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_company as $row)
                        <tr class="odd gradeX">
                            <td>{{$row->id}}</td>
                            <td>{{$row->name }}</td>
                            <td>{{$row->owner_name }}</td>
                            <td>{{HTML::image($row->logo , '' , ['width' => '75px'])}}</td>
                            <td>{{$row->countryName->name }}</td>
                            <td>{{$row->cityName->name }}</td>
                            <td>{{$row->commercial_record }}</td>
                            <td>{{$row->mailbox }}</td>
                            <td>{{$row->postal_code }}</td>
                            <td>{{$row->fax }}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->mobile}}</td>
                            <td>{{$row->phone}}</td>
                            <td>{{$row->address}}</td>
                            <td>{{Link_to_route('admin.company.send_email' , 'ارسال بريد الكتروني' , $row->id)}}</td>
                            <td>{{Link_to_route('admin.company.send_sms' , 'ارسال رسالة نصية' , $row->id)}}</td>
                            <td>{{Link_to_route('admin.company.edit' , 'تعديل ' , $row->id)}}</td>
                            <td style="display:flex">
                                {{Form::open(['route'=>['admin.company.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}
                                <a href="javascript:;" onclick="if (confirm('هل أنت متأكد من عملية الحذف؟!'))
                                            $('form').submit();"> حذف</a>
                                {{Form::close()}}
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