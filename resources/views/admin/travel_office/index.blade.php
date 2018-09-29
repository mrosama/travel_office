@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="">المكاتب السياحية والدينية</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع المكاتب السياحية والدينية </div>
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
                            <th>اسم المكتب</th>
                            <th>اسم صاحب المكتب</th>
                            <th>لوغو المكتب</th>
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
                            <th>خيارات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_office as $row)
                        <tr class="odd gradeX">
                            <td>{{$row->id}}</td>
                            <td>{{$row->name }}</td>
                            <td>{{$row->owner_name }}</td>
                            <td>{{HTML::image($row->logo , '' , ['width' => '75px'])}}</td>
                            <td>@if($row->countryName){{$row->countryName->name}}@endif</td>
                            <td>@if($row->cityName){{$row->cityName->name }}@endif</td>
                            <td>{{$row->commercial_record }}</td>
                            <td>{{$row->mailbox }}</td>
                            <td>{{$row->postal_code }}</td>
                            <td>{{$row->fax }}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->mobile}}</td>
                            <td>{{$row->phone}}</td>
                            <td>{{$row->address}}</td>
                            <td style="display:flex">
                                {{Link_to_route('admin.travel_offices.edit' , 'تعديل ' , $row->id ,  ["class" => "btn btn-circle" ])}}

                                {{Form::open(['route'=>['admin.travel_offices.destroy' , $row->id] , "class" => "btn btn-circle" , 'method'=>'delete' , 'id'=>'form'])}}
                                <a href="javascript:;" onclick="if (confirm('هل أنت متأكد من عملية الحذف؟!'))
                                            $('form').submit();"> حذف <i class="fa fa-times" aria-hidden="true"></i></a>
                                {{Form::close()}}
                                <a class="btn btn-circle" href="{{URL::to('admin/travel_offices/sendEmail').'/'.$row->id}}" >ارسال بريد الالكتروني <i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                <a class="btn btn-circle" href="{{URL::to('admin/travel_offices/sendSMS').'/'.$row->id}}" >ارسال رسالة نصية <i class="fa fa-mobile" aria-hidden="true"></i></a>
                                <a class="btn btn-circle" href="" >ارسال رسالة داخلية <i class="fa fa-envelope-o" aria-hidden="true"></i></a>
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