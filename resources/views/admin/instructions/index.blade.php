@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/instructions">المعلومات الخاصة و العامة</a>
        </li>
    </ul>

</div>

<div class="row">
    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>عرض جميع المعلومات الخاصة و العامة </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <br>
                <div class="form-group">
                    <label class="control-label col-md-2">عرض حسب النوع</label>
                    <div class="col-md-6">
                        {{Form::select('order_type' , ['all'=>'اختر النوع المراد العرض على اساسه  ....'  , 'o' => 'خاص للمكتب	' , 's' => 'خاص للعميل	' , 'g' =>  'عام للعميل	'] , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'id' => 'order_type' , "data-live-search"=>"true"])}}
                    </div>
                    <font color="red">{{$errors->first('type')}}</font><br>
                </div>
                <br>

                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    @if (Session::has('global_s')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('global_s')}}</div>
                    @endif
                    <thead>
                        <tr>
                            <th class="text-center">م</th>
                            <th class="text-center">عنوان المعلومة</th>
                            <th class="text-center">النوع</th>
                            <th class="text-center">الدولة</th>
                            <th class="text-center">المدينة</th>
                            <th class="text-center">ملف</th>
                            <th class="text-center">ملاحظات</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                            <th class="text-center">عرض</th>
                        </tr>
                    </thead>
                    <tbody id="instruction_data">
                        @foreach($instructions as $instruction)
                        <tr class="text-center">
                            <td>{{++$i}}</td>
                            <td>{{$instruction->title}}</td>
                            <td>
                                @if($instruction->type == "s")
                                خاص للعميل
                                @elseif($instruction->type == "g")
                                عام للعميل
                                @else
                                خاص للمكتب
                                @endif
                            </td>
                            <td>{{$instruction->getCountry->name}}</td>
                            <td>{{$instruction->getCity->name}}</td>
                            <td>
                                @if($instruction->file != null)
                                <a href="{{URL::to($instruction->file)}}">{{str_replace("images/", "" , trim($instruction->file , '/')) }}</a>
                                @else
                                <del>لا يوجد</del>
                                @endif
                            </td>
                            <td>{{$instruction->notes}}</td>
                            <td>
                                <a href="{{URL::to('/admin/instructions' , [$instruction->id , 'edit'])}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                {{Form::open(['route'=>['admin.instructions.destroy' , $instruction->id] , 'method'=>'delete' , 'id'=>'form'])}}
                                <a href="javascript:;" onclick="if (confirm('هل أنت متأكد من عملية الحذف؟!'))
                                            $(this).closest('form').submit();"> <i class="fa fa-trash font-red"></i></a>
                                {{Form::close()}}
                            </td>
                            <td><a href="{{URL::to('/admin/instructions' , $instruction->id)}}"><i class="fa fa-eye"></i></a>
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