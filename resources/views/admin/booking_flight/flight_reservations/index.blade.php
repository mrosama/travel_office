@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/flight/reservations">الطلبات</a>
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
                    @if (Session::has('global_s')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('global_s')}}</div>
                    @endif

                    <thead>
                        <tr>
                            <th class="text-center">م</th>
                            <th class="text-center">البرنامج السياحى</th>
                            <th class="text-center">العميل</th>
                            <th class="text-center">الباص</th>
                            <th class="text-center">المقاعد المحجوزة</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                            <th class="text-center">عرض</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $j = 1 ?>
                        @foreach($flight_reservations as $flight_reservation)
                        <tr class="text-center">
                            <td>{{++$i}}</td>
                            <td>
                                @if($flight_reservation->touristProgram != null)
                                <a target="_blank" href="{{URL::to('/admin/tourist/programmes' , $flight_reservation->touristProgram->id)}}">{{$flight_reservation->touristProgram->name}}</a>
                                @else
                                <font color="red"><del>تم حذف البرنامج السياحى</del></font>
                                @endif
                            </td>
                            <td>
                                @if($flight_reservation->client != null)
                                <a target="_blank" href="{{URL::to('/admin/clients' , $flight_reservation->client->id)}}">{{$flight_reservation->client->username}}</a>
                                @else
                                <font color="red"><del>تم حذف العميل</del></font>
                                @endif
                            </td>
                            <td>
                                @if($flight_reservation->bus != null)
                                <a target="_blank" href="{{URL::to('/admin/busses' , $flight_reservation->bus->id)}}">{{$flight_reservation->bus->number}}</a>
                                @else
                                <font color="red"><del>تم حذف الباص</del></font>
                                @endif
                            </td>
                            <td>
                                @if($flight_reservation->resrved_seats != null)
                                @foreach(json_decode($flight_reservation->resrved_seats) as $seat)
                                {{$seat->seat_no}}
                                @if($j < sizeof(json_decode($flight_reservation->resrved_seats)))
                                <?php ++$j ?>
                                |
                                @else
                                <?php $j = 1 ?>
                                @endif
                                @endforeach
                                @else
                                <font color="red">لا يوجد مقاعد محجوزة</font>	
                                @endif
                            </td>

                            <td>
                                <a href="{{URL::to('/admin/flight/reservations' , [$flight_reservation->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                {{Form::open(['route'=>['admin.flight.reservations.destroy' , $flight_reservation->id] , 'method'=>'delete' , 'id'=>'form'])}}	

                                <a href="javascript:;" onclick="if (confirm('هل أنت متأكد من عملية الحذف؟!'))
                                            $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
                                {{Form::close()}}
                            </td>
                            <td><a href="{{URL::to('/admin/flight/reservations' , $flight_reservation->id)}}"><i class="fa fa-eye"></i></a>
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