@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/supervisors">المشرفين على الرحلات</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع المشرفين </div>
                <div style="margin-top: 5px;"><a href="{{URL::to('/admin/supervisors/create')}}" class="btn btn-danger pull-right">اضافة مشرف</a></div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    @if (Session::has('global_s')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('global_s')}}</div>
                    @endif

                    <thead>
                        <tr>
                            <th class="text-center">م</th>
                            <th class="text-center"> اسم المشرف</th>
                            <th class="text-center"> الجنسية</th>
                            <th class="text-center"> الدولة</th>
                            <th class="text-center"> المدينة</th>
                            <th class="text-center"> رقم الجوال</th>
                            <th class="text-center"> تاريخ الميلاد</th>
                            <th class="text-center">الصورة</th>
                            <th class="text-center">اسم الام</th>
                            <th class="text-center">البريد الالكتروني</th>
                            <th class="text-center">التلفون</th>
                            <th class="text-center">الفاكس</th>
                            <th class="text-center">تويتر</th>
                            <th class="text-center">انستغرام</th>
                            <th class="text-center">سكايب</th>
                            <th class="text-center">فيس بوك</th>
                            <th class="text-center"> عرض وتعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        @foreach($supervisors as $row)
                        <tr class="text-center">
                            <td>{{++$i}}</td>
                            <td><a href="{{URL::to('/admin/supervisors' , [$row->id , 'edit'])}}">{{$row->name}}</a></td>
                            <td>@if($row->country){{$row->Country->name}}@endif</td>
                            <td>@if($row->country){{$row->Country->name}}@endif</td>
                            <td>@if($row->city){{$row->City->name}}@endif</td>
                            <td>{{$row->mobile}}</td>
                            <td>{{$row->birthDate}}</td>
                            <td><img src="{{URL::to('/').$row->photo}}" width="100px;" height="100px;"/></td>
                            <td>{{$row->motherName}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->phone}}</td>
                            <td>{{$row->fax}}</td>
                            <td>{{$row->twitter}}</td>
                            <td>{{$row->instgram}}</td>
                            <td>{{$row->skype}}</td>
                            <td>{{$row->face}}</td>
                            <td>
                                <a href="{{URL::to('/admin/supervisors' , [$row->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                {{Form::open(['route'=>['admin.supervisors.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}	
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