@extends('admin.layouts.master')
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}/admin/city">المدن</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span><a href="{{URL::to('/')}}/admin/city/{{$city->id}}/edit">تعديل بيانات المدينة</a></span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>تعديل بيانات مدينة <b>{{$city->name}}</b> </div>
                <a href="{{URL::to('/admin/city')}}" class="btn btn-danger" style="float: left; margin-top: 5px;">عرض جميع المدن</a>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                {{Form::open(['route'=>['admin.city.update' , $city->id] , 'method'=>'put' , 'class'=>'form-horizontal'])}}
                <div class="form-body">
                    @if (Session::has('success')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-2">اسم الدولة</label>
                        <div class="col-md-8">
                            {{Form::select('country_id' , $countries ,  $city->country_id, ['class'=>'form-control bs-select' , 'data-live-search' => 'true' ,  "autofocus"=>"autofocus"])}}
                            <font color="red">{{$errors->first('country_id')}}</font><br>
                        </div>
                        <div class="form-group">
                            <a href="{{URL::to('/admin/country/create')}}" target="_blank" class="btn btn-primary"><i class="fa fa-plus"></i>اضافة دولة </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">اسم المدينة</label>
                        <div class="col-md-8">
                            {{Form::text('name' , $city->name , ['class'=>'form-control' ,"autocomplete" =>"on"  ])}}
                            <font color="red">{{$errors->first('name')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">فتح الخط</label>
                        <div class="col-md-8">
                            {{Form::text('lineOpen' , $city->lineOpen , ['class'=>'form-control' ,"autocomplete" =>"on"  ])}}
                            <font color="red">{{$errors->first('lineOpen')}}</font><br>
                        </div>
                    </div>
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
@stop