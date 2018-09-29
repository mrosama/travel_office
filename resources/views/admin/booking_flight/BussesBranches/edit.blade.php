@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
@section('CssLinks')
<link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@stop
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form ">
            <div class="portlet-title">
                <div class="caption" style="float:right">
                    <span class="caption-subject font-green bold uppercase">  الرحلات السياحية</span> | <span class="caption-subject font-green  uppercase">  اضافة فرع لمزودين الباصات   </span>
                </div>
                <a href="{{URL::to('/admin/busses/branches')}}" class="btn btn-success pull-right">عرض الكل</a>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {{Form::open(array('route' => ['admin.busses.branches.update' , $branch->id], 'method'=>'put' , 'files'=>'true' , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
                <div class="form-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('error')}}
                    </div>
                    @endif
                    <h3>بيانات الفرع</h3><br>
                    <div class="form-group">
                        <label class="control-label col-md-3">اسم الفرع</label>
                        <div class="col-md-8">
                            {{Form::text('name' , $branch->name , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('name')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"> الدولة</label>
                        <div class="col-md-8">
                            {{Form::select('country' , $countries , $branch->country , [ "class"=>"bs-select form-control", "id" => "countryBranch" , "data-live-search"=>"true" , "autocomplete" =>"on" , 'placeholder'=>'اختر الدولة ' , 'required'])}}
                            <font color="red">{{$errors->first('country')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">المدينة</label>
                        <div class="col-md-8">                            
                            <select id="cityBranch" name="city" class="form-control" data-live-search="true" data-size="8">
                                <option  selected="" value="{{$branch->city}}"> {{\App\Http\Models\City::find($branch->city)->name}}</option>
                                @foreach($cities as $city)
                                <option  value="{{$city->id}}"> {{$city->name}}</option>
                                @endforeach
                            </select>
                            <font color="red">{{$errors->first('city')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">اسم المدير</label>
                        <div class="col-md-8">
                            {{Form::text('mangerName' , $branch->mangerName , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('mangerName')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">الهاتف</label>
                        <div class="col-md-8">
                            {{Form::text('phone' , $branch->phone , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('phone')}}</font><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">البريد الالكتروني</label>
                        <div class="col-md-8">
                            {{Form::text('email' , $branch->email , ['class'=>'form-control' , 'required'])}}
                            <font color="red">{{$errors->first('email')}}</font><br>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="text-center">
                                <button type="submit" class="btn green">حفظ</button>
                                <button type="reset" class="btn default">الغاء </button>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
    @section('JsScripts')
    <script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    @stop
    @stop