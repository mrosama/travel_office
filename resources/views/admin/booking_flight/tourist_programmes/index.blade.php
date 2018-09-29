<?php

use App\Http\Models\Employee; ?>

@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/tourist/programmes">البرامج السياحية</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع البرامج السياحية </div>
                <div style="margin-top: 5px;"><a href="{{URL::to('/admin/tourist/programmes/create')}}" class="btn btn-danger pull-right">اضافة برنامج جديد</a></div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    @if (Session::has('global_s')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('global_s')}}</div>
                    @endif
                    <?php $j = 1 ?>

                    <thead>
                        <tr>
                            <th class="text-center">م</th>
                            <th class="text-center">اسم البرنامج السياحى</th>
                            <th class="text-center">نوع الرحلة</th>
                            <th class="text-center">المشرفين</th>
                            <th class="text-center">تاريخ الذهاب</th>
                            <th class="text-center">عدد ايام الرحلة</th>
                            <th class="text-center">عدد ساعات الرحلة</th>
                            <th class="text-center">الوجبات</th>

                            <th class="text-center">من دولة</th>
                            <th class="text-center">من مدينة</th>
                            <th class="text-center">من مكان</th>
                            <th class="text-center">ساعة الانطلاق</th>
                            <th class="text-center">الى دولة</th>
                            <th class="text-center">الى مدينة</th>
                            <th class="text-center">الى مكان</th>

                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                            <th class="text-center">عرض</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($tourist_programmes as $tourist_program)
                        <tr class="text-center">
                            <td>{{++$i}}</td>
                            <td>  <a href="{{URL::to('/admin/tourist/programmes' , [$tourist_program->id , 'edit'])}}">{{$tourist_program->name}}</a></td>
                            <td>{{$tourist_program->getTrip->name}}</td>
                            <td>
                                @foreach(json_decode($tourist_program->supervisors)  as $supervisor )
                                <?php $supervisorName = \App\Supervisor::select('name')->where('id', $supervisor)->first(); ?>
                                @if($supervisorName)
                                {{$supervisorName->name}}
                                @endif
                                @if($j < sizeof(json_decode($tourist_program->supervisors)))
                                <?php ++$j ?>
                                <br>  / <br>
                                @else
                                <?php $j = 1 ?>
                                @endif
                                @endforeach
                            </td>

                            <td>{{$tourist_program->going_date}}</td>
                            <td>{{$tourist_program->flight_days_no}}</td>
                            <td>{{$tourist_program->flight_hours_no}}</td>
                            <td>
                                @if($tourist_program->meals == "null")
                                <del><font color="red">لا يوجد وجبات</font></del>
                                @else
                                {{$tourist_program->meals}}
                                @endif
                            </td>
                            <td>{{$tourist_program->fromCountry->name}}</td>
                            <td>{{$tourist_program->fromCity->name}}</td>
                            <td>{{$tourist_program->from_place}}</td>
                            <td>{{$tourist_program->launch_hour}}</td>
                            <td>{{$tourist_program->toCountry->name}}</td>
                            <td>{{$tourist_program->toCity->name}}</td>
                            <td>{{$tourist_program->to_place}}</td>
                            <td>
                                <a href="{{URL::to('/admin/tourist/programmes' , [$tourist_program->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                {{Form::open(['route'=>['admin.tourist.programmes.destroy' , $tourist_program->id] , 'method'=>'delete' , 'id'=>'form'])}}

                                <a href="javascript:;" onclick="if (confirm('هل أنت متأكد من عملية الحذف؟!'))
                                            $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
                                {{Form::close()}}
                            </td>
                            <td><a href="{{URL::to('/admin/tourist/programmes' , $tourist_program->id)}}"><i class="fa fa-eye"></i></a>
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