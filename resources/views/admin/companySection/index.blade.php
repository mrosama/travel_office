@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/companySection">اقسام المؤسسات والشركات</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع اقسام المؤسسات والشركات </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <div>

                    <div class="col-md-2">اسم الشركة </div>
                    <div class="col-md-4">
                        <select class="form-control" id="companyID" onchange="getSections()">
                            <option selected="" disabled="">اختر اسم الشركة المطلوبة ...</option>
                            @foreach($all_company as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        @if (Session::has('success')) 
                        <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
                        @endif
                    </div>
                </div>
                <br>
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم المؤسسة / الشركة</th>
                            <th>اسم القسم</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody  id="sections">
                        @foreach($all_sections as $row)
                        <tr class="odd gradeX">
                            <td>{{$row->id}}</td>
                            <td>{{$row->companyName->name}}</td>
                            <td>{{$row->sectionName }}</td>
                            <td style="display:flex">
                                {{Link_to_route('admin.companySection.edit' , 'تعديل ' , $row->id)}}
                                &nbsp; |&nbsp; 
                                {{Form::open(['route'=>['admin.companySection.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}
                                <a href="javascript:;" onclick="if (confirm('هل أنت متأكد من عملية الحذف؟!'))
                                                                                    $('form').submit();"> حذف</a>
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