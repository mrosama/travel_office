@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/transportations">وسائل النقل</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع وسائل النقل 
                </div>
                <a href="{{URL::to('/admin/transportations/create')}}" class="btn btn-danger" style="float: left; margin-top: 5px;"><i class="fa fa-plus"></i> اضافة وسيلة نقل</a>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    @if (Session::has('success')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
                    @endif
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>وسيلة النقل</th>
                            <th>خيارات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($transporations as $row)
                        <tr class="odd gradeX">
                            <td>{{$i++}}</td>
                            <td>{{$row->transName}}</td>
                            <td style="display:flex">
                                {{Link_to_route('admin.transportations.edit' , 'تعديل ' , $row->id)}}&nbsp; |&nbsp;
                                {{Form::open(['route'=>['admin.transportations.destroy' , $row->id] , 'method'=>'delete' , 'id'=>'form'])}}
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