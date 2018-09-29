@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/clients_orders">طلبات العملاء</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع الطلبات </div>
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
                            <th>اسم العميل</th>
                            <th>رقم الهاتف</th>
                            <th>البريد الالكتروني</th>
                            <th>تاريخ الطلب</th>
                            <th>عرض التفاصيل </th>
                            <th>تعديل</th>
                            <th>تنفيذ الطلب</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($client_orders as $order)
                        <tr class="odd gradeX">
                            <td>{{$order->id}}</td>
                            <td>{{$order->get_client_name->username}}</td>
                            <td>{{$order->get_client_name->phone}}</td>
                            <td>{{$order->get_client_name->email_address}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>{{Link_to_route('admin.clients_orders.show' , 'عرض التفاصيل ' , $order->id)}}</td>
                            <td>{{Link_to_route('admin.clients_orders.edit' , 'تعديل ' , $order->id)}}</td>
                            <td><a href="{{URL::to('admin/executing/orders' , $order->id)}}">تنفيذ الطلب</a></td>
                            <td> {{Form::open(['route'=>['admin.clients_orders.destroy' , $order->id] , 'method'=>'delete' , 'id'=>'form'])}}
                                <a href="javascript:;" onclick="if (confirm('هل أنت متأكد من عملية الحذف؟!'))
                                            $(this).closest('form').submit();"> حذف</a>
                                {{Form::close()}}</td>
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