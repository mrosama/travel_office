@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/busses/suppliers">مزودى الباصات</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع المزودين </div>
                <div style="margin-top: 5px;"><a href="{{URL::to('admin/busses/suppliers/create')}}" class="btn btn-danger pull-right">اضافة مزود جديد</a></div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="{{URL::to('/admin/busses/suppliers/send/emails')}}" class="btn sbold green"> ارسال بريد الكترونى
                                    <i class="fa fa-plus"></i>
                                </a> 
                                
                                <a href="{{URL::to('/admin/busses/suppliers/send/sms')}}" style="margin-right: 5px;" class="btn sbold green"> ارسال  رسالة نصية
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
                            <th class="text-center">لوجو المزود</th>
                            <th class="text-center">اسم الجهة</th>
                            <th class="text-center">الفرع</th>
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
                            <th class="text-center">صورة السجل التجارى</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                            <th class="text-center">عرض</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($busses_suppliers as $busses_supplier)
                        <tr class="text-center">
                            <td>{{++$i}}</td>
                            <td>{{HTML::image($busses_supplier->logo , '' , ['width'=>70 , 'height'=>70 , 'class'=>'img-circle'])}}</td>
                            <td><a href="{{URL::to('/admin/busses/suppliers' , [$busses_supplier->id , 'edit'])}}">{{$busses_supplier->name}}</a></td>
                            <td><a href="{{URL::to('/admin/busses/branches' , [$busses_supplier->branch_id , 'edit'])}}" target="_blank">{{$busses_supplier->bussesBranch->name}}</a></td>
                            <td>{{$busses_supplier->tel}}</td>
                            <td>{{$busses_supplier->mobile}}</td>
                            <td>{{$busses_supplier->email}}</td>
                            <td>{{$busses_supplier->twitter}}</td>
                            <td>{{$busses_supplier->face}}</td>
                            <td>{{$busses_supplier->skype}}</td>
                            <td>{{$busses_supplier->Commercial_record_no}}</td>
                            <td>{{$busses_supplier->country}}</td>
                            <td>{{$busses_supplier->city}}</td>
                            <td>{{$busses_supplier->street}}</td>
                            <td>{{$busses_supplier->mailbox}}</td>
                            <td>{{$busses_supplier->postal_code}}</td>
                            <td>{{$busses_supplier->fax}}</td>
                            <td>{{$busses_supplier->website}}</td>
                            <td>{{HTML::image($busses_supplier->commercial_reg_img , '' , ['width'=>70 , 'height'=>70 , 'class'=>'img-circle'])}}</td>
                            <td>
                                <a href="{{URL::to('/admin/busses/suppliers' , [$busses_supplier->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                {{Form::open(['route'=>['admin.busses.suppliers.destroy' , $busses_supplier->id] , 'method'=>'delete' , 'id'=>'form'])}}

                                <a href="javascript:;" onclick="if (confirm('هل أنت متأكد من عملية الحذف؟!'))
                                            $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
                                {{Form::close()}}
                            </td>
                            <td><a href="{{URL::to('/admin/busses/suppliers' , $busses_supplier->id)}}"><i class="fa fa-eye"></i></a>
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