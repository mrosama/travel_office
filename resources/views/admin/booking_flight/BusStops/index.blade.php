@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/busStops">مواقف الباصات</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع مواقف  الباصات </div>
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
                            <th class="text-center">لوجو الموقف</th>
                            <th class="text-center">الاسم </th>
                            <th class="text-center">الهاتف</th>
                            <th class="text-center">الجوال</th>
                            <th class="text-center">البريد الالكترونى</th>
                            <th class="text-center">تويتر</th>
                            <th class="text-center">فيس بوك</th>
                            <th class="text-center">سكايب</th>
                            <th class="text-center">رقم السجل التجارى</th>
                            <th class="text-center">الدولة</th>
                            <th class="text-center">المدينة</th>
                            <th class="text-center">الشارع</th>
                            <th class="text-center">صندوق البريد</th>
                            <th class="text-center">الرمز البريدى</th>
                            <th class="text-center">فاكس</th>
                            <th class="text-center">الموقع الالكترونى</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        
                        @foreach($BusStops as $bus)
                        <tr class="text-center">
                            <td>{{++$i}}</td>
                            <td>{{HTML::image($bus->logo , '' , ['width'=>70 , 'height'=>70])}}</td>
                            <td><a href="{{URL::to('admin/busStops' , [$bus->id , 'edit'])}}">{{$bus->name}}</a></td>
                            <td>{{$bus->tel}}</td>
                            <td>{{$bus->mobile}}</td>
                            <td>{{$bus->email}}</td>
                            <td>{{$bus->twitter}}</td>
                            <td>{{$bus->face}}</td>
                            <td>{{$bus->skype}}</td>
                            <td>{{$bus->commercial_record_no}}</td>
                            <td>{{$bus->getCountry->name}}</td>
                            <td>{{$bus->getCity->name}}</td>
                            <td>{{$bus->street}}</td>
                            <td>{{$bus->mailbox}}</td>
                            <td>{{$bus->postal_code}}</td>
                            <td>{{$bus->fax}}</td>
                            <td>{{$bus->website}}</td>
                            <td><a href="{{URL::to('/admin/busStops' , [$bus->id , 'edit'])}}"><i class="fa fa-edit"></i></a></td>
                            <td>
                                {{Form::open(['route'=>['admin.busStops.destroy' , $bus->id] , 'method'=>'delete' , 'id'=>'form'])}}
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