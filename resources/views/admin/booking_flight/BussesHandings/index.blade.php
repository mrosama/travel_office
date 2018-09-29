@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/busses/Handings">تسليم الباصات</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض الكل  </div>
                <div style="margin-top: 5px;"><a href="{{URL::to('/admin/busses/Handings/create')}}" class="btn btn-danger pull-right"> اضافة تسليم باص جديد</a></div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    @if (Session::has('global_s')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('global_s')}}</div>
                    @endif
                    <thead>
                        <tr>
                            <th class="text-center">م</th>
                            <th class="text-center">اسم السائق</th>
                            <th class="text-center">رقم الباص</th>
                            <th class="text-center">كوبون البنزين</th>
                            <th class="text-center">مبلغ كوبون البنزين</th>
                            <th class="text-center">عدد الكيلومترات عند التسليم</th>
                            <th class="text-center">ملاحظات</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach($bussesHandings as $row)
                        <tr class="text-center">
                            <td>{{++$i}}</td>
                            <td>{{$row->Driver->name}}</td>
                            <td>{{$row->Bus->number}}</td>
                            <td>{{$row->benzeneCoupon}}</td>
                            <td>{{$row->amountCoupon}}</td>
                            <td>{{$row->kiloMeter}}</td>
                            <td>{{$row->notes}}</td>
                            <td>
                                <a href="{{URL::to('/admin/busses/Handings' , [$row->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                {{Form::open(['route'=>['admin.busses.Handings.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}

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