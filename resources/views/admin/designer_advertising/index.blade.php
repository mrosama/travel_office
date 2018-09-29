@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/designer_advertising">مصممين الاعلانات</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع المصممين </div>
                <a href="{{URL::to('/admin/designer_advertising/create')}}" class="btn btn-danger" style="float: left; margin-top: 5px;"><i class="fa fa-plus"></i> اضافة مصمم جديد</a>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    @if (Session::has('success')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
                    @endif
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>الهاتف</th>
                            <th>الجوال</th>
                            <th>البريد الالكتروني</th>
                            <th>فيس بوك</th>
                            <th>تويتر</th>
                            <th>انستغرام</th>
                            <th>سكايب</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($designers as $row)
                        <tr class="odd gradeX">
                            <td>{{$row->id}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->phone}}</td>
                            <td>{{$row->mobile}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->facebook}}</td>
                            <td>{{$row->twitter}}</td>
                            <td>{{$row->instagram}}</td>
                            <td>{{$row->skype}}</td>
                            <td style="display:flex">
                                {{Link_to_route('admin.designer_advertising.edit' , 'تعديل ' , $row->id)}}&nbsp; |&nbsp; {{Form::open(['route'=>['admin.designer_advertising.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}
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