@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/busses/branches">فروع مزودين الباصات</a>
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
                <div style="margin-top: 5px;"><a href="{{URL::to('/admin/busses/branches/create')}}" class="btn btn-danger pull-right"> اضافة فرع  جديد</a></div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    @if (Session::has('global_s')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('global_s')}}</div>
                    @endif
                    <thead>
                        <tr>
                            <th class="text-center">م</th>
                            <th class="text-center">اسم الفرع</th>
                            <th class="text-center">الدولة</th>
                            <th class="text-center">المدينة</th>
                            <th class="text-center">اسم المدير</th>
                            <th class="text-center">الهاتف</th>
                            <th class="text-center">البريد الالكتروني</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach($branches as $row)
                        <tr class="text-center">
                            <td>{{++$i}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->Country->name}}</td>
                            <td>{{$row->City->name}}</td>
                            <td>{{$row->mangerName}}</td>
                            <td>{{$row->phone}}</td>
                            <td>{{$row->email}}</td>
                            <td>
                                <a href="{{URL::to('/admin/busses/branches' , [$row->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                {{Form::open(['route'=>['admin.busses.branches.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}
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