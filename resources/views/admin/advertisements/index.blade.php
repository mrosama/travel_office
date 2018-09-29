@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/advertisements">الاعلانات و البنرات</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع الاعلانات و البنرات </div>
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
                            <th class="text-center"> عنوان الاعلان</th>
                            <th class="text-center">اسم مصمم الاعلان</th>
                            <th class="text-center">الدولة</th>
                            <th class="text-center">المدينة</th>
                            <th class="text-center">الاعلان</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">ارسال</th>
                            <th class="text-center">حذف</th>
                            <th class="text-center">عرض</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($advertisements as $advertisement)
                        <tr class="text-center">
                            <td>{{++$i}}</td>
                            <td>{{$advertisement->title}}</td>
                            <td>{{$advertisement->getDesigner->name}}</td>
                            <td>{{$advertisement->getCountry->name}}</td>
                            <td>{{$advertisement->getCity->name}}</td>
                            <td>
                                @if($advertisement->file != null)
                                <a href="{{URL::to($advertisement->file)}}">تحميل</a>
                                @else
                                <del>لا يوجد</del>
                                @endif
                            </td>
                            <td>
                                <a href="{{URL::to('/admin/advertisements' , [$advertisement->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                <a href="{{URL::to('/admin/advertisements/send/advertise' , [$advertisement->id])}}"><i class="fa fa-envelope-o"></i></a>
                            </td>
                            <td>
                                {{Form::open(['route'=>['admin.advertisements.destroy' , $advertisement->id] , 'method'=>'delete' , 'id'=>'form'])}}

                                <a href="javascript:;" onclick="if (confirm('هل أنت متأكد من عملية الحذف؟!'))
                                            $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
                                {{Form::close()}}
                            </td>
                            <td><a href="{{URL::to('/admin/advertisements' , $advertisement->id)}}"><i class="fa fa-eye"></i></a>
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