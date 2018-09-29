@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/busses/reservations">حجوزات الباصات</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع الحجوزات </div>
                <div style="margin-top: 5px;"><a href="{{URL::to('/admin/busses/reservations/create')}}" class="btn btn-danger pull-right">اضافة باص جديد</a></div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    @if (Session::has('success')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
                    @endif
                    <thead>
                        <tr>
                            <th class="text-center">م</th>
                            <th class="text-center">اسم العميل</th>
                            <th class="text-center">الفرع</th>
                            <th class="text-center">اسم مزود الباص</th>
                            <th class="text-center">رقم الباص</th>
                            <th class="text-center">تاريخ بداية الحجز</th>
                            <th class="text-center">عدد ايام الحجز</th>
                            <th class="text-center">تاريخ نهاية الحجز</th>
                            <th class="text-center">دولة الانطلاق</th>
                            <th class="text-center">مدينة الانطلاق</th>
                            <th class="text-center">دولة الوصول</th>
                            <th class="text-center">مدينة الوصول</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach($bussesReservations as $row)
                        <tr class="text-center">
                            <td>{{++$i}}</td>
                            <td><a href="{{URL::to('/admin/clients/edit/first/' .$row->clientID)}}" target="_blank">{{$row->Client->username}}</a></td>
                            <td>{{$row->Branch->name}}</td>
                            <td>{{$row->Supplier->name}}</td>
                            <td>{{$row->Bus->number}}</td>
                            <td>{{$row->startDate}}</td>
                            <td>{{$row->dayNumber}}</td>
                            <td>{{$row->endDate}}</td>
                            <td>{{$row->CountryDeparture->name}}</td>
                            <td>{{$row->CityDeparture->name}}</td>
                            <td>{{$row->CountryArrival->name}}</td>
                            <td>{{$row->CityArrival->name}}</td>
                            <td>
                                <a href="{{URL::to('/admin/busses/reservations' , [$row->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                {{Form::open(['route'=>['admin.busses.reservations.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}
                                <a href="javascript:;" onclick="if (confirm('هل أنت متأكد من عملية الحذف؟!'))
                                            $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
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