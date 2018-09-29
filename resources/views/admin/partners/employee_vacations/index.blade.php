@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{URL::to('/')}}/admin/employee_vacations ">طلبات الاجازة</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع طلبات الاجازة</div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">

                    @if (Session::has('success')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
                    @endif

                    <thead>
                        <tr>
                            <th class="text-center">م</th>
                            <th class="text-center">اسم الموظف</th>
                            <th class="text-center">نوع الاجازة</th>
                            <th class="text-center">عدد الايام المطلوبة</th>
                            <th class="text-center">تاريخ بداية الاجازة</th>
                            <th class="text-center">تاريخ نهاية الاجازة</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0;?>
                        @foreach($employee_vacations as $row)
                        <tr class="text-center">
                            <td>{{++$i}}</td>
                            <td>{{$row->Employee->name}}</td>
                            <td>{{$row->Vacation_type->name}}</td>
                            <td>{{$row->day_number}}</td>
                            <td>{{$row->vacation_start}}</td>
                            <td>{{$row->vacation_end}}</td>
                            <td>
                                <a href="{{URL::to('/admin/employee_vacations' , [$row->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                {{Form::open(['route'=>['admin.employee_vacations.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}
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