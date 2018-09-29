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
                    <span class="caption-subject font-green bold uppercase">اضافة عميل جديد</span>
                </div>

            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                {!!Form::open(array('url' => 'admin/clients/check/first','method'=>'post','class'=>'form-horizontal' , 'files' => true))!!}
                <div class="form-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align : right;">
                        <strong>شكرا لك ! </strong> {{Session::get('success')}}
                    </div>
                    @endif
                    <h3>بيانات العميل</h3><br>
                    <div class="form-group  ">
                        <label class="control-label col-md-3">اسم المستخدم 
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {{Form::text('user_name' , Session::has('userInfo.user_name') ? Session::get('userInfo.user_name') : "" , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
                                <font color="red">{{$errors->first('user_name')}}</font>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-md-3">كلمة المرور
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{Session::has('userInfo.password') ? Session::get('userInfo.password') : '' }}"  name="password" id="generatedPass" maxlength="10" >
                                <span class="input-group-btn">
                                    <button class="btn btn-inverse btn-md" type="button" id="generatePass" style="padding: 8px 15px;">توليد</button>
                                </span>
                            </div>
                            <font color="red">{{$errors->first('password')}}</font>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-md-3">نوع المستخدم
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {!!Form::radio('userType' , 'arab' , true)!!}عربي
                            {!!Form::radio('userType' , 'foreign')!!}اجنبي
                            <font color="red">{{$errors->first('userType')}}</font>
                        </div>
                    </div>                              
                    <hr>

                    <div class="form-group  ">
                        <label class="control-label col-md-3">الاسم بالعربية
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {{Form::text('username' , Session::has('userInfo.username') ? Session::get('userInfo.username')  : '' , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
                                <font color="red">{{$errors->first('username')}}</font>
                            </div>
                        </div>
                    </div>
                    {{Form::hidden('parent_id' , $parent_id)}}
                    {{Form::hidden('type' , $type)}}

                    <div class="form-group  ">
                        <label class="control-label col-md-3">الاسم بالانجليزية
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                {{Form::text('username_en' , Session::has('userInfo.username_en') ?  Session::get('userInfo')['username_en'] : ''  , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
                                <font color="red">{{$errors->first('username_en')}}</font>
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
                                <select name="nationality"  class ='bs-select form-control'    data-live-search = 'true'  data-size = '12'>
                                    @if(Session::has('userInfo.nationality') && !empty(Session::get('userInfo.nationality')))
                                    <option value="{{Session::get('userInfo.nationality')}}"  selected="">{{\App\Http\Models\Country::where('code',Session::get('userInfo.nationality'))->first()->name}} - {{Session::get('userInfo.nationality')}}</option>
                                    @else
                                    <option value="" selected="" disabled="">اختر الجنسية من فضلك .....</option>
                                    @endif
                                    @foreach($countrs as $cr)
                                    <option value="{{$cr->code}}">{{$cr->name}} ({{$cr->code}})</option>
                                    @endforeach
                                </select>
                                <!-- Old Country -->
                                {{--Form::select('nationality' , $countries , Session::has('userInfo.nationality') ? Session::get('userInfo')['nationality'] : '' , ['class' => 'bs-select form-control' ,  'data-live-search' => 'true' , 'data-size' => '12' , 'placeholder' => 'اختر الجنسية من فضلك ...'])--}}
                                <font color="red">{{$errors->first('nationality')}}</font>
                            </div>
                        </div>
                    </div>
                    <div class="form-group  ">
                        <label class="control-label col-md-3">الدولة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                <select name="country"  class ='bs-select form-control'  id= 'country'  data-live-search = 'true'  data-size = '12'>
                                    @if(Session::has('userInfo.country') && !empty(Session::get('userInfo.country')))
                                    <option value="{{Session::get('userInfo.country')}}"  selected="">{{\App\Http\Models\Country::where('code',Session::get('userInfo.country'))->first()->name}} - {{Session::get('userInfo.country')}}</option>
                                    @else
                                    <option value="" selected="" disabled="">اختر الدولة من فضلك .....</option>
                                    @endif
                                    @foreach($countrs as $cr)
                                    <option value="{{$cr->code}}">{{$cr->name}} ({{$cr->code}})</option>
                                    @endforeach
                                </select>
                                <!-- Old Country -->
                                {{--Form::select('country' , $countries ,Session::has('userInfo.country') ?  Session::get('userInfo')['country'] : ''  , ['class' => 'bs-select form-control' , 'id'=> 'country' , 'data-live-search' => 'true' , 'data-size' => '12' , 'placeholder' => 'اختر الدولة من فضلك ...'])--}}
                                <font color="red">{{$errors->first('country')}}</font>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a target="_blank" href="{{URL::route('admin.country.create')}}">
                                <button type="button" class="btn btn-success" style="margin-bottom:10px"><i class="fa fa-plus"></i>  اضف دولة جديدة</button>
                            </a>
                        </div>
                    </div>
                    <div class="form-group  ">
                        <label class="control-label col-md-3">المدينة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <div class="input-icon right">
                                <i class="fa"></i>
                                @if(Session::has('userInfo.city') && isset($cities))
                                <?php
                                $city = \App\Http\Models\City::find(Session::get('userInfo.city'));
                                $cities = \App\Http\Models\City::where('country_code', $city->country_code)->lists('name', 'id');
                                ?>
                                {{Form::select('city' , $cities , $city->id , ['placeholder' => '' , 'class' => 'bs-select form-control' , 'id'=> 'cities' , 'data-live-search' => 'true' , 'data-size' => '12'])}}
                                @else
                                {{Form::select('city' ,  ['' => 'اختر الدولة اولا من فضلك ...'] ,  '' , ['placeholder' => '' , 'class' => 'bs-select form-control' , 'id'=> 'cities' , 'data-live-search' => 'true' , 'data-size' => '12'])}}
                                @endif
                                <font color="red">{{$errors->first('city')}}</font>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a target="_blank" href="{{URL::route('admin.city.create')}}">
                                <button type="button" class="btn btn-success" style="margin-bottom:10px"> <i class="fa fa-plus"></i> اضف مدينة جديدة</button>
                            </a>
                        </div>
                    </div>
                    <div class="form-group  ">
                        <label class="control-label col-md-3">رقم الجوال
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-4">
                            {{Form::text('mobile' ,   Session::has('userInfo.mobile') ?  Session::get('userInfo.mobile') : ''  , ['class' => 'form-control',"autocomplete" =>"on"])}}
                            <font color="red">{{$errors->first('mobile')}}</font>
                        </div>
                        <div class="col-md-2">
                            {{Form::text('code' , Session::has('userInfo.code') ? Session::get('userInfo.code') : '' , ['class' => 'form-control' , 'id' => 'country_code' ,'readonly'])}}
                            {!! $errors->first('code' . '<div class="alert alert-danger">:message</div>')!!}
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="addNewMobile" class="btn btn-success "><i class="fa fa-plus"></i> اضف رقم اخر</button>
                        </div>
                    </div>
                    @if(Session::has('userInfo.mobiles'))
                    <?php $mobiles = Session::get('userInfo.mobiles'); ?>
                    @foreach($mobiles as $key => $val)
                    <div class="form-group">
                        <label class="control-label col-md-3">
                            <span class="required"></span>
                        </label>
                        <div class="col-md-3"><input type="text" name="mobiles[]" value="{{$val}}" placeholder="رقم جوال اخر" class="form-control"></div>
                    </div>
                    @endforeach
                    @endif
                    <div id="newMobile"></div>

                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ الميلاد</label>
                        <div class="col-md-8">
                            <input class="form-control form-control-inline date-picker" placeholder="dd/mm/yyyy" name="birth_date"  value="{{Session::has('userInfo.birth_date') ? Session::get('userInfo.birth_date') : ''}}" id="birth_date"  type="text" data-date-format="dd/mm/yyyy" />
                            <span class="help-block"> d/m/y </span>
                            <font color="red">{{$errors->first('birth_date')}}</font>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">صورة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::file('photo' , ['class'=>'form-control','id' => 'photo','onchange' =>'validate_fileupload(this.value);'])}}
                            @if(Session::has('userInfo.photo'))
                            <image src="{{URL::to('/').'/'.Session::get('userInfo.photo')}}" width="100px;" />
                            @endif
                            <font color="red">{{$errors->first('photo')}}</font>
                        </div>
                    </div>	
                    <div class="form-group">
                        <label class="control-label col-md-3">اسم الام
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('mother_name' ,Session::has('userInfo.mother_name') ? Session::get('userInfo.mother_name') : '' , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('mother_name')}}</font>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">البريد الالكتروني
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            {{Form::email('email_address' , Session::has('userInfo.email_address') ? Session::get('userInfo.email_address') : '', ['class' => 'form-control' ,"autocomplete" =>"on" , 'placeholder' => 'البريد الالكتروني' ])}}
                            <font color="red">{{$errors->first('email_address')}}</font>
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="addNewُEmail" class="btn btn-success">اضف بريد الكتروني اخر</button>
                        </div>
                    </div>
                    @if(Session::has('userInfo.emails'))
                    <?php $emails = Session::get('userInfo.emails'); ?>
                    @foreach($emails as $key => $val)
                    <div class="form-group">
                        <label class="control-label col-md-3">
                            <span class="required"></span>
                        </label>
                        <div class="col-md-4"><input type="text" name="emails[]" value="{{$val}}" placeholder="بريد الكتروني  اخر" class="form-control"></div>
                    </div>
                    @endforeach
                    @endif
                    <div id="newEmail"></div>

                    <div class="form-group">
                        <label class="control-label col-md-3">التليفون
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('phone' , Session::has('userInfo.phone') ? Session::get('userInfo.phone') : '' , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('phone')}}</font>
                        </div>
                    </div>	
                    <div class="form-group">
                        <label class="control-label col-md-3">الفاكس
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('fax' , Session::has('userInfo.fax') ? Session::get('userInfo.fax') : '' , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('fax')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">تويتر
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('twitter' , Session::has('userInfo.twitter') ? Session::get('userInfo.twitter') : '' , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('twitter')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">انستغرام
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('instgram' , Session::has('userInfo.instgram') ? Session::get('userInfo.instgram') : '' , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('instgram')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">سكايب
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('skype' , Session::has('userInfo.skype') ? Session::get('userInfo.skype') : ''  , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('skype')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">فيس بوك
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('facebook' , Session::has('userInfo.facebook') ? Session::get('userInfo.facebook') : ''   , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('facebook')}}</font>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">كارت العائلة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::file('family_card' , ['class'=>'form-control','id' => 'photo','onchange' =>'validate_fileupload(this.value);'])}}
                            @if(Session::has('userInfo.family_card'))
                            <image src="{{URL::to('/').'/'.Session::get('userInfo.family_card')}}" width="100px;" />
                            @endif
                            <font color="red">{{$errors->first('family_card')}}</font>
                        </div>
                    </div>		

                    <div class="form-group">
                        <label class="control-label col-md-3">رقم الجواز
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('passport_number' , Session::get('userInfo')['passport_number'] , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('passport_number')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ اصدار الجواز
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <input class="form-control form-control-inline date-picker" required  placeholder="dd/mm/yyyy" name="issue_date"  value="{{Session::get('userInfo')['issue_date']}}" id="issue_date"  type="text" data-date-format="dd/mm/yyyy" data-date-end-date="+0d" />
                            <span class="help-block"> d/m/y </span>
                            <font color="red">{{$errors->first('issue_date')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">تاريخ انتهاء الجواز
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            <input class="form-control form-control-inline date-picker" required  placeholder="dd/mm/yyyy" name="expire_date"  value="{{Session::get('userInfo')['expire_date']}}" id="expire_date"  type="text" data-date-format="dd/mm/yyyy"/>
                            <span class="help-block"> d/m/y </span>
                            <font color="red">{{$errors->first('expire_date')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">مكان اصدار الجواز
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8" >
                            {{Form::select('passport_issue_place' , $countries , Session::get('userInfo')['passport_issue_place'] , ['class' => 'bs-select form-control'  , 'data-live-search' => 'true' , 'data-size' => '12' , 'placeholder' => 'اختر الدولة من فضلك ...'])}}
                            <font color="red">{{$errors->first('passport_issue_place')}}</font>
                        </div>
                    </div>		
                    <div class="form-group">
                        <label class="control-label col-md-3">صورة الجواز
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::file('passpot_copy' ,  ['class' => 'form-control' , 'id' =>'passpot_copy' ,'onchange' =>'validate_fileupload(this.value);' ])}}
                            @if(Session::has('userInfo.passpot_copy'))
                            <image src="{{URL::to('/').'/'.Session::get('userInfo.passpot_copy')}}" width="100px;" />
                            @endif
                            <font color="red">{{$errors->first('passpot_copy')}}</font>
                        </div>
                    </div>																
                    <div class="form-group">
                        <label class="control-label col-md-3">السجل المدني / الاقامة
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::text('residence_number' , Session::get('userInfo')['residence_number'] , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                            <font color="red">{{$errors->first('residence_number')}}</font>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">صورة السجل المدني / الاقامة 
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8">
                            {{Form::file('residence_copy' ,  ['class' => 'form-control' , 'id' =>'residence_copy' ,'onchange' =>'validate_fileupload(this.value);' ])}}
                            @if(Session::has('userInfo.residence_copy'))
                            <image src="{{URL::to('/').'/'.Session::get('userInfo.residence_copy')}}" width="100px;" />
                            @endif
                            <font color="red">{{$errors->first('residence_copy')}}</font>
                        </div>
                    </div>		
                    <div class="form-group">
                        <label class="control-label col-md-3">ملاحظات<span class="required"> * </span></label>
                        <div class="col-md-8">
                            {{Form::textarea('notes' , Session::get('userInfo')['notes'] , ['class' => 'form-control' , 'placeholder' => 'ملاحظات عن العميل' , 'rows' => '5'])}}
                            <font color="red">{{$errors->first('notes')}}</font>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">التالي</button>
                        </div>
                    </div>
                </div>
                </form>
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