@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/partners">الشركاء</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع الشركاء </div>
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
                            <th class="text-center">نوع الشريك</th>
                            <th class="text-center">اسم الشريك</th>
                            <th class="text-center">الموقع الالكترونى</th>
                            <th class="text-center">الجوال</th>
                            <th class="text-center">الهاتف</th>
                            <th class="text-center">الدولة</th>
                            <th class="text-center">المدينة</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                            <th class="text-center">عرض</th>
                            <th class="text-center">بيانات تسجيل الدخول</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($partners as $partner)
                        <tr class="text-center">
                            <td>{{++$i}}</td>
                            <td>{{$partner->Partner_type->name}}</td>
                            <td>{{$partner->name}}</td>
                            <td>{{$partner->site_url}}</td>
                            <td>{{$partner->mobile}}</td>
                            <td>{{$partner->phone}}</td>
                            <td>{{$partner->getCountry->name}}</td>
                            <td>{{$partner->getCity->name}}</td>
                            <td>
                                <a href="{{URL::to('/admin/partners' , [$partner->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                {{Form::open(['route'=>['admin.partners.destroy' , $partner->id] , 'method'=>'delete' , 'id'=>'form'])}}

                                <a href="javascript:;" onclick="if (confirm('هل أنت متأكد من عملية الحذف؟!'))
                                                                                    $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
                                {{Form::close()}}
                            </td>
                            <td><a href="{{URL::to('/admin/partners' , $partner->id)}}"><i class="fa fa-eye"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="#openModal">بيانات تسجيل الدخول</a>
                                <div id="openModal" class="modalDialog">
                                    <div>	
                                        <a href="#close" title="Close" class="close-M">X</a>

                                        <h2 style="margin-top:5px">
                                            بيانات التسجيل 
                                        </h2>
                                        <div class="log-info"> 
                                            <div >اسم المستخدم: {{$partner->user->user_name}}</div>
                                            <div>كلمة المررو: {{$partner->user->shown_password}}</div>
                                        </div>
                                    </div>
                                </div>
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