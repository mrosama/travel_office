@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/useful_link">المواقع المفيدة</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span><a href="{{URL::to('/')}}/admin/useful_link/{{$link->id}}/edit">تعديل بيانات الرابط \ الموقع</a></span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>تعديل بيانات الرابط \ الموقع </div>
                <a href="{{URL::to('/admin/useful_link')}}" target="_blank" class="btn btn-danger" style="float: left; margin-top:5px; "> عرض الكل</a>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                {{Form::open(['route'=>['admin.useful_link.update' , $link->id] , 'method'=>'put' , 'class'=>'form-horizontal' , 'files' => true])}}
                <div class="form-body">
                    @if (Session::has('success')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
                    @endif
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">العنوان
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('title', $link->title ,array('placeholder'=>'مثلا "معرفة حالة الطقس"', "autofocus"=>"autofocus",'class'=>'form-control'))!!}
                                {!! $errors->first('title','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">الرابط
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('link',$link->link ,array('placeholder'=>'http://www.google.com','class'=>'form-control'))!!}
                                {!! $errors->first('link','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">نبذة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-7">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::textarea('notes',$link->notes ,array('placeholder'=>'نبذة عن الرابط او الموقع','class'=>'form-control'))!!}
                                {!! $errors->first('notes','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">اللوجو
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {{Form::file('logo')}}
                                {!! $errors->first('logo','<div class="alert alert-danger">:message</div>')!!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group  margin-top-20">
                        <label class="control-label col-md-3">المرفقات الحالية

                        </label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                @if(isset($link_attachment))
                                @foreach($link_attachment as $row)
                                <a target="_blank" href="{{URL::to($row->attachment_file)}}"> الرابط</a>  
                                {{Link_to_route('admin.useful_link.deleteAttachment' , 'حذف' , $row->id ,array('onclick' => 'confirmDelete()' ))}}
                                <br><br>
                                @endforeach
                                @endif	
                            </div>
                        </div>
                    </div>

                    <div class="form-group margin-top-20">
                        <label class="control-label col-md-3">
                            مرفقات اضافة المزيد من 
                        </label>
                        <div class="col-md-4">
                            <button type="button" onclick="addAttachment()" class="btn red btn-sm">اضف ملفات</button>
                        </div>
                    </div>
                    <div id="newAttachment"></div>




                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="text-center">
                            <button type="submit" class="btn green">
                                <i class="fa fa-pencil"></i> تعديل البيانات</button>
                            <button type="reset" class="btn default">مسح</button>
                        </div>
                    </div>
                </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>


@section('JsScripts')
<script type="text/javascript">
    function addAttachment()
    {
        var newAttachment = '<div class="form-group  margin-top-20">' +
                '<label class="control-label col-md-3"></label>' +
                '<div class="col-md-4">' +
                '<div class="input-icon right">' +
                '<i class="fa"></i>' +
                '<input type="file" name="attachment[]">' +
                '</div>' +
                '</div>' +
                '</div>';
        $('#newAttachment').append(newAttachment);
    }


    function confirmDelete()
    {
        if (confirm('هل انت متأكد من عملية الحذف ؟'))
            return true;
        else
            return false;
    }
</script>
@stop



@stop