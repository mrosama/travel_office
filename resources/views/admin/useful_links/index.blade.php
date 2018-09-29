@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/transport_type">المواقع المفيدة</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع المواقع </div>
                <a href="{{URL::to('/admin/useful_link/create')}}" target="_blank" class="btn btn-danger" style="float: left; margin-top:5px; "><i class="fa fa-plus"></i>اضافة موقع </a>

            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    @if (Session::has('success')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
                    @endif
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>العنوان</th>
                            <th>الرابط </th>
                            <th>اللوجو </th>
                            <th>نبذة </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($links as $link)
                        <tr class="odd gradeX">
                            <td>{{$link->id}}</td>
                            <td>{{$link->title }}</td>
                            <td>{{$link->link}}</td>
                            <td>
                                {{HTML::image($link->logo ,'', ['style' => 'width:80px;'])}}
                            </td>
                            <td>{{$link->notes}}</td>
                            <td style="display:flex">
                                {{Link_to_route('admin.useful_link.edit' , 'تعديل ' , $link->id)}}&nbsp; |&nbsp;
                                {{Form::open(['route'=>['admin.useful_link.destroy' , $link->id] , 'method'=>'delete' , 'id'=>'form'])}}
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