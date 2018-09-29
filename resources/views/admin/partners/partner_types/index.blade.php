@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{URL::to('/')}}/admin/partner_types">انواع  الشركاء</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع انواع  الشركاء </div>
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
                            <th class="text-center">نوع الشريك </th>
                            <th class="text-center">تاريخ الاضافة</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0;?>
                        @foreach($partner_types as $row)
                        <tr class="text-center">
                            <td>{{++$i}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>
                                <a href="{{URL::to('/admin/partner_types' , [$row->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                {{Form::open(['route'=>['admin.partner_types.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}
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