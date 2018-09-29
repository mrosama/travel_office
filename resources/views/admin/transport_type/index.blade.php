@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/transport_type">وسائل المواصلات</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع وسائل المواصلات 
                </div>
                <a href="{{URL::to('/admin/transport_type/create')}}" class="btn btn-danger" style="float: left; margin-top: 5px;"><i class="fa fa-plus"></i> اضافة وسيلة مواصلات</a>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    @if (Session::has('success')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
                    @endif
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الدولة</th>
                            <th>المدينة من </th>
                            <th>المدينة الى </th>
                            <th>وسيلة النقل </th>
                            <th>المدة المستغرقة </th>
                            <th>المسافة </th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transports as $transport)
                        <tr class="odd gradeX">
                            <td>{{$transport->id}}</td>
                            <td>{{$transport->getCountry->name}}</td>
                            <td>{{$transport->getToCity->name}}</td>
                            <td>{{$transport->getFromCity->name}}</td>
                            <td>{{$transport->getTransportation->transName}}</td>
                            <td>{{$transport->duration}}</td>
                            <td>{{$transport->space}}</td>
                            <td style="display:flex">
                                {{Link_to_route('admin.transport_type.edit' , 'تعديل ' , $transport->id)}}&nbsp; |&nbsp;
                                {{Form::open(['route'=>['admin.transport_type.destroy' , $transport->id] , 'method'=>'delete' , 'id'=>'form'])}}
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