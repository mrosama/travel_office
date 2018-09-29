@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/meetings">الاجتماعات</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع الاجتماعات </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="{{URL::to('/admin/meetings/send/emails')}}" class="btn sbold green"> ارسال بريد الكترونى
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    @if (Session::has('global_s')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('global_s')}}</div>
                    @endif

                    <thead>
                        <tr>
                            <th class="text-center">م</th>
                            <th class="text-center">العنوان</th>
                            <th class="text-center">التاريخ</th>
                            <th class="text-center">نوع الاجتماع</th>
                            <th class="text-center">مكان الاجتماع</th>
                            <th class="text-center">تسجيل ما حدث</th>
                            <th class="text-center">الغياب</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                            <th class="text-center">عرض</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($meetings as $meeting)
                        <tr class="text-center">
                            <td>{{++$i}}</td>
                            <td>{{$meeting->address}}</td>
                            <td>{{$meeting->date}}</td>
                            <td>{{$meeting->getType->type}}</td>
                            <td>{{$meeting->getPlace->place}}</td>
                            <td>
                                @if($meeting->meetingEvent != null)
                                <a href="{{URL::to('/admin/meetings' , [$meeting->id  , 'create' , 'event'])}}"> تعديل</a>
                                @else
                                <a href="{{URL::to('/admin/meetings' , [$meeting->id  , 'create' , 'event'])}}">انشاء</a>
                                @endif
                            </td>	
                            <td>
                                @if($meeting->meetingEvent != null)
                                <a href="{{URL::to('admin/meetings' , [$meeting->meetingEvent->id , 'event' , 'absences'])}}">تعديل</a>
                                @else
                                قم بتسجيل الاحداث اولا
                                @endif
                            </td>				
                            <td>
                                <a href="{{URL::to('/admin/meetings' , [$meeting->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                {{Form::open(['route'=>['admin.meetings.destroy' , $meeting->id] , 'method'=>'delete' , 'id'=>'form'])}}

                                <a href="javascript:;" onclick="if (confirm('هل أنت متأكد من عملية الحذف؟!'))
                                                                                    $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
                                {{Form::close()}}
                            </td>
                            <td><a href="{{URL::to('/admin/meetings' , $meeting->id)}}"><i class="fa fa-eye"></i></a>
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