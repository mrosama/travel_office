@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/visas">الفيزا و التأشيرات</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع التأشيرات </div>
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
                            <th class="text-center">جنسية العميل</th>
                            <th class="text-center">الى دولة</th>
                            <th class="text-center">حجز طيران</th>
                            <th class="text-center">حجز فندق</th>
                            <th class="text-center">تعريف عمل</th>
                            <th class="text-center">تأمين صحى</th>
                            <th class="text-center">كشف حساب</th>
                            <th class="text-center">امكانية عمل الفيزا فى المطار</th>
                            <th class="text-center">الجواز الاصلي مع صورة </th>
                            <th class="text-center">كرت العائلة مع صورة </th>
                            <th class="text-center">الاقامة مع صورة</th>
                            <th class="text-center">كشف حساب بنكي بالراتب مختوم من قبل البنك 3-6 أشهر </th>
                            <th class="text-center">تعبئة نموذج اون لاين</th>
                            <th class="text-center">تعبئة نموذج خارجي</th>
                            <th class="text-center">صورة الجواز</th>
                            <th class="text-center">تعبئة نموذج</th>
                            <th class="text-center">عدد الصور</th>
                            <th class="text-center">دفع رسوم</th>
                            <th class="text-center">مدة التأشيرة</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                            <th class="text-center">عرض</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($visas as $visa)
                        <tr class="text-center">
                            <td>{{++$i}}</td>
                            <td>{{$visa->fromCountry->name}}</td>
                            <td>{{$visa->toCountry->name}}</td>
                            <td>{{($visa->booking_flight)? "نعم":"لا"}}</td>
                            <td>{{($visa->hotel_booking)? "نعم":"لا"}}</td>
                            <td>{{($visa->action_definition)? "نعم":"لا"}}</td>
                            <td>{{($visa->health_insurance)? "نعم":"لا"}}</td>
                            <td>{{($visa->account_statement)? "نعم":"لا"}}</td>
                            <td>{{($visa->visa_in_airport)? "نعم":"لا"}}</td>
                            <td>{{($visa->passport_with_picture)? "نعم":"لا"}}</td>
                            <td>{{($visa->family_card_with_picture)? "نعم":"لا"}}</td>
                            <td>{{($visa->residence_with_picture)? "نعم":"لا"}}</td>
                            <td>{{($visa->bank_account)? "نعم":"لا"}}</td>
                            <td>{{($visa->fill_form_online)? "نعم":"لا"}}</td>
                            <td>{{($visa->fill_form_external)? "نعم":"لا"}}</td>
                            <td>{{($visa->passport_photocopy)? "نعم":"لا"}}</td>
                            <td>{{($visa->fill_out_form)? "نعم":"لا"}}</td>
                            <td>{{$visa->total_photos}}</td>
                            <td>{{$visa->payment_of_fees}}</td>
                            <td>{{$visa->visa_duration}}</td>
                            <td>
                                <a href="{{URL::to('/admin/visas' , [$visa->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                {{Form::open(['route'=>['admin.visas.destroy' , $visa->id] , 'method'=>'delete' , 'id'=>'form'])}}

                                <a href="javascript:;" onclick="if (confirm('هل أنت متأكد من عملية الحذف؟!'))
                                                                                    $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
                                {{Form::close()}}
                            </td>
                            <td><a href="{{URL::to('/admin/visas' , $visa->id)}}"><i class="fa fa-eye"></i></a>
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