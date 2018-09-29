@extends('admin.layouts.master')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">الرئيسية</a>
            <i class="fa fa-angle-left"></i>
        </li>
        <li>
            <a href="{{URL::to('admin/transport_type')}}">وسائل المواصلات</a>
            <i class="fa fa-angle-left"></i>
        </li>
        <li>
            <span>تعديل وسيلة المواصلات</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>تعديل بيانات وسلة المواصلات </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                    <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                {{Form::open(['route'=>['admin.transport_type.update' , $transports->id] , 'method'=>'put' , 'class'=>'form-horizontal'])}}

                <div class="form-body">

                    @if (Session::has('success')) 
                    <div class="alert alert-success"  style="text-align: right;"><strong>شكرا لك! </strong>{{Session::get('success')}}</div>
                    @endif

                    <div class="form-group">
                        <label class="control-label col-md-3">الدولة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::select('country_id' , $countries , $transports->country_id , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار الدولة' , "class"=>"bs-select form-control" , "data-live-search"=>"true"])}}
                            <font color="red">{{$errors->first('country_id')}}</font><br>
                        </div>
                        <a href="{{URL::to('admin/country/create')}}" class="btn btn-icon-only green img-circle" target="_blank">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">من مدينة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::select('city_from' , $cities , $transports->city_from , ["class"=>"bs-select form-control" , "autocomplete" =>"on" , "data-live-search"=>"true" , 'placeholder'=>"من فضلك اختر المدينة"])}}
                            <font color="red">{{$errors->first('city_from')}}</font><br>
                        </div>
                        <a href="{{URL::to('admin/city/create')}}" class="btn btn-icon-only green img-circle" target="_blank">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">الى مدينة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::select('city_to' , $cities , $transports->city_to , ["class"=>"bs-select form-control", "autocomplete" =>"on" , "data-live-search"=>"true" , 'placeholder'=>"من فضلك اختر المدينة"])}}
                            <font color="red">{{$errors->first('city_to')}}</font><br>
                        </div>
                        <a href="{{URL::to('admin/city/create')}}" class="btn btn-icon-only green img-circle" target="_blank">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>



                    <div class="form-group">
                        <label class="control-label col-md-3">وسيلة النقل
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::select('transport_type'   , $transportations , $transports->transport_type , ["autocomplete" =>"on" , 'placeholder'=>'من فضلك قم باختيار وسيلة النقل' , "class"=>"bs-select form-control" , "data-live-search"=>"true"])}}
                            <font color="red">{{$errors->first('transport_type')}}</font><br>
                        </div>
                        <a href="{{URL::to('admin/transportations/create')}}" class="btn btn-icon-only green img-circle" target="_blank">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>




                    <div class="form-group">
                        <label class="control-label col-md-3">المدة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('duration',$transports->duration,array('placeholder'=>'المدة المستغرقة','class'=>'form-control'))!!}
                                {!! $errors->first('duration','<div class="alert alert-danger">:message</div>')!!}                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">المسافة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::text('space',$transports->space,array('class'=>'form-control' ))!!}
                                {!! $errors->first('space','<div class="alert alert-danger">:message</div>')!!}                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">ملاحظات
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {!!Form::textarea('notes',$transports->notes,array('class'=>'form-control' ))!!}
                                {!! $errors->first('notes','<div class="alert alert-danger">:message</div>')!!}                            </div>
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


@section('JsScripts')
<script type="text/javascript">
    $('select[name="country_id"]').change(function (event) {

        var city_to = document.getElementsByName('city_to')[0];
        var city_from = document.getElementsByName('city_from')[0];

        var country_code = this.value;
        $.ajax({
            url: $('#base_url').val() + '/city/getCity',
            data: {country_code: country_code},
        })
                .done(function (data) {

                    if (data.length == 0)
                    {
                        city_to.options.length = 0;
                        city_to.options[0] = new Option("عفوا لا يوجد مدن بهذه الدولة");

                        city_from.options.length = 0;
                        city_from.options[0] = new Option("عفوا لا يوجد مدن بهذه الدولة");
                    } else
                    {
                        city_to.className = "bs-select form-control";
                        city_to.options.length = 0;
                        city_to.options[0] = new Option("من فضلك اختر مدينة");
                        data.forEach(function (val, index) {
                            city_to.options[city_to.length] = new Option(val.name, val.id);
                        });

                        city_from.className = "bs-select form-control";
                        city_from.options.length = 0;
                        city_from.options[0] = new Option("من فضلك اختر مدينة");
                        data.forEach(function (val, index) {
                            city_from.options[city_from.length] = new Option(val.name, val.id);
                        });
                    }
                    $('select[name="city_to"]').selectpicker('refresh');
                    $('select[name="city_from"]').selectpicker('refresh');
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });
    });

</script>
@stop

@stop