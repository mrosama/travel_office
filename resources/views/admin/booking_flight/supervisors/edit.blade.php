@extends ('admin.layouts.master')
@section('content')
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bubble font-green"></i>
                    <span class="caption-subject font-green bold uppercase">تعديل بيانات المشرف</span>
                </div>
                <a href="{{URL::to('/admin/supervisors')}}" class="btn btn-success pull-right">عرض المشرفين</a>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {!!Form::open(array('route' => ['admin.supervisors.update' , $supervisor->id],'method'=>'put','class'=>'form-horizontal' , 'files' => true))!!}
                <div class="form-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif
                    <h3>بيانات المشرف</h3><br>
                    <div class="form-group  ">
                        <label class="control-label col-md-3">اسم المشرف 
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {{Form::text('name' ,  $supervisor->name , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
                                <font color="red">{{$errors->first('name')}}</font>
                            </div>
                        </div>
                    </div>

                    <div class="form-group  ">
                        <label class="control-label col-md-3">الجنسية
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {{Form::select('nationality' , $countries  ,  $supervisor->nationality , ['class' => 'bs-select form-control' ,  'data-live-search' => 'true' , 'data-size' => '12' , 'placeholder' => 'اختر الجنسية من فضلك ...'])}}
                                <font color="red">{{$errors->first('nationality')}}</font>
                            </div>
                        </div>
                    </div>
                    <div class="form-group  ">
                        <label class="control-label col-md-3">الدولة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {{Form::select('country' , $countries ,  $supervisor->country  , ['class' => 'bs-select form-control' , 'id'=> 'country' , 'data-live-search' => 'true' , 'data-size' => '12' , 'placeholder' => 'اختر الدولة من فضلك ...'])}}
                                <font color="red">{{$errors->first('country')}}</font>
                            </div>
                        </div>
                    </div>
                    <div class="form-group  ">
                        <label class="control-label col-md-3">المدينة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {{Form::select('city' , $cities ,  $supervisor->city , ['placeholder' => '' , 'class' => 'bs-select form-control' , 'id'=> 'cities' , 'data-live-search' => 'true' , 'data-size' => '12'])}}
                                <font color="red">{{$errors->first('city')}}</font>
                            </div>
                        </div>
                    </div>
                    <div class="form-group  ">
                        <label class="control-label col-md-3">رقم الجوال
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            {{Form::text('mobile' ,    $supervisor->mobile  , ['class' => 'form-control',"autocomplete" =>"on"])}}
                            <font color="red">{{$errors->first('mobile')}}</font>
                        </div>
                        <div class="col-md-2">
                            {{Form::text('code' ,  $supervisor->code , ['class' => 'form-control' , 'id' => 'country_code' ,'readonly'])}}
                            {!! $errors->first('code' . '<div class="alert alert-danger">:message</div>')!!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ الميلاد</label>
                        <div class="col-md-8">
                            <input class="form-control form-control-inline date-picker" placeholder="dd/mm/yyyy" name="birthDate"  value="{{$supervisor->birthDate}}" id="birthDate"  data-date-start-date=""  type="text" data-date-format="dd/mm/yyyy" />
                            <span class="help-block"> d/m/y </span>
                            <font color="red">{{$errors->first('birth_date')}}</font>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">صورة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::file('photo' , ['class'=>'form-control'])}}
                            <font color="red">{{$errors->first('photo')}}</font>
                        </div>
                    </div>	

                    <div class="form-group">
                        <label class="control-label col-md-3">الصورة المحملة مسبقا
                        </label>
                        <div class="col-md-8">
                            <img src="{{URL::to($supervisor->photo)}}" width="100px;" height="100px;"/>
                        </div>
                    </div>	

                    <div class="form-group">
                        <label class="control-label col-md-3">اسم الام
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('motherName' , $supervisor->motherName , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('motherName')}}</font>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">البريد الالكتروني
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::email('email' ,  $supervisor->email , ['class' => 'form-control' ,"autocomplete" =>"on" , 'placeholder' => 'البريد الالكتروني' ])}}
                            <font color="red">{{$errors->first('email')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">التليفون
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('phone' ,  $supervisor->phone , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('phone')}}</font>
                        </div>
                    </div>	
                    <div class="form-group">
                        <label class="control-label col-md-3">الفاكس
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('fax' ,  $supervisor->fax , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('fax')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">تويتر
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('twitter' , $supervisor->twitter , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('twitter')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">انستغرام
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('instgram' ,  $supervisor->instgram , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('instgram')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">سكايب
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('skype' , $supervisor->skype  , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('skype')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">فيس بوك
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('face' ,  $supervisor->face   , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('facebook')}}</font>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">كارت العائلة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::file('family_card' , ['class'=>'form-control'])}}
                            <font color="red">{{$errors->first('family_card')}}</font>
                        </div>
                    </div>	
                    <div class="form-group">
                        <label class="control-label col-md-3">الصورة المحملة مسبقا
                        </label>
                        <div class="col-md-8">
                            <img src="{{URL::to($supervisor->family_card)}}" width="100px;" height="100px;"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">رقم الجواز
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('passportNumber' , $supervisor->passportNumber , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('passportNumber')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ اصدار الجواز
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <input class="form-control form-control-inline date-picker" required  placeholder="dd/mm/yyyy" name="passportIssue"  value="{{$supervisor->passportIssue}}"   type="text" data-date-format="dd/mm/yyyy" data-date-end-date="+0d" />
                            <span class="help-block"> d/m/y </span>
                            <font color="red">{{$errors->first('passportIssue')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ انتهاء الجواز
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <input class="form-control form-control-inline date-picker" required  placeholder="dd/mm/yyyy" name="passportExpire"  value="{{$supervisor->passportExpire}}"   type="text" data-date-format="dd/mm/yyyy"/>
                            <span class="help-block"> d/m/y </span>
                            <font color="red">{{$errors->first('passportExpire')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">مكان اصدار الجواز
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8" >
                            {{Form::select('passportPlace' , $countries , $supervisor->passportPlace , ['class' => 'bs-select form-control'  , 'data-live-search' => 'true' , 'data-size' => '12' , 'placeholder' => 'اختر الدولة من فضلك ...'])}}
                            <font color="red">{{$errors->first('passportPlace')}}</font>
                        </div>
                    </div>		
                    <div class="form-group">
                        <label class="control-label col-md-3">صورة الجواز
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::file('passportPhoto' ,  ['class' => 'form-control' ])}}
                            <font color="red">{{$errors->first('passportPhoto')}}</font>
                        </div>
                    </div>	
                    <div class="form-group">
                        <label class="control-label col-md-3">الصورة المحملة مسبقا
                        </label>
                        <div class="col-md-8">
                            <img src="{{URL::to($supervisor->passportPhoto)}}" width="100px;" height="100px;"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">السجل المدني / الاقامة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('civilRegistry' , $supervisor->civilRegistry , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('civilRegistry')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">صورة السجل المدني / الاقامة 
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::file('civilRegistryPhoto' ,  ['class' => 'form-control' ])}}
                            <font color="red">{{$errors->first('civilRegistryPhoto')}}</font>
                        </div>
                    </div>	
                    <div class="form-group">
                        <label class="control-label col-md-3">الصورة المحملة مسبقا
                        </label>
                        <div class="col-md-8">
                            <img src="{{URL::to($supervisor->civilRegistryPhoto)}}" width="100px;" height="100px;"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">ملاحظات<span class="required"> * </span></label>
                        <div class="col-md-8">
                            {{Form::textarea('notes' , $supervisor->notes , ['class' => 'form-control' , 'placeholder' => 'ملاحظات عن العميل' , 'rows' => '5'])}}
                            <font color="red">{{$errors->first('notes')}}</font>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">حفظ البيانات</button>
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
<script type="text/javascript">
    $('#generatePass').click(function (event) {
        $('#generatedPass').val(Math.random().toString(36).slice(-10));
    });
</script>
@stop

@stop