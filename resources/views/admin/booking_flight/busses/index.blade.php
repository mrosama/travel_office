@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/busses">الباصات</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع الباصات </div>
                <div style="margin-top: 5px;"><a href="{{URL::to('/admin/busses/create')}}" class="btn btn-danger pull-right">اضافة باص جديد</a></div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    @if (Session::has('global_s')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('global_s')}}</div>
                    @endif
                    <thead>
                        <tr>
                            <th class="text-center">م</th>
                            <th class="text-center">صورة الباص</th>
                            <th class="text-center">الفرع</th>
                            <th class="text-center">اسم مزود الباص</th>
                            <th class="text-center">رقم الباص</th>
                            <th class="text-center">موديل الباص</th>
                            <th class="text-center">لون الباص</th>
                            <th class="text-center">حجم الباص</th>
                            <th class="text-center">رقم الرخصة</th>
                            <th class="text-center">رقم كارت التشغيل</th>
                            <th class="text-center">تصريح الحج</th>
                            <th class="text-center">رقم التصريح</th>
                            <th class="text-center">مدة التصريح</th>
                            <th class="text-center">تاريخ التصريح</th>
                            <th class="text-center">تاريخ انتهاء التصريح</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                            <th class="text-center">عرض</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($busses as $bus)
                        <tr class="text-center">
                            <td>{{++$i}}</td>
                            <td>{{HTML::image($bus->photo , '' , ['width'=>70 , 'height'=>70 , 'class'=>'img-circle'])}}</td>
                            <td><a href="{{URL::to('/admin/busses/branches' , [$bus->branch->id , 'edit' ])}}" target="_blank">{{$bus->branch->name}}</a></td>
                            <td><a href="{{URL::to('/admin/busses/suppliers' , $bus->supplier->id)}}">{{$bus->supplier->name}}</a></td>
                            <td>{{$bus->number}}</td>
                            <td>{{$bus->model}}</td>
                            <td>{{$bus->color}}</td>
                            <td>{{$bus->size}}</td>
                            <td>{{$bus->license_number}}</td>
                            <td>{{$bus->run_card_number}}</td>
                            <td>{{$bus->hajj_permit}}</td>
                            <td>{{$bus->permit_number}}</td>
                            <td>{{$bus->permit_duration}}</td>
                            <td>{{$bus->permit_date}}</td>
                            <td>{{$bus->permit_end_date}}</td>
                            <td>
                                <a href="{{URL::to('/admin/busses' , [$bus->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                {{Form::open(['route'=>['admin.busses.destroy' , $bus->id] , 'method'=>'delete' , 'id'=>'form'])}}

                                <a href="javascript:;" onclick="if (confirm('هل أنت متأكد من عملية الحذف؟!'))
                                            $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
                                {{Form::close()}}
                            </td>
                            <td><a href="{{URL::to('/admin/busses' , $bus->id)}}"><i class="fa fa-eye"></i></a>
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