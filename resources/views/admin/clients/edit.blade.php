@extends ('admin.layouts.master')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> العملاء
    <small>تعديل بيانات العضو</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">الرئيسية</a>
            <i class="fa fa-angle-left"></i>
        </li>
        <li>
            <span>العملاء</span>
            <i class="fa fa-angle-left"></i>
        </li>
        <li>
            <span>تعديل بيانات العضو</span>
        </li>
    </ul>

</div>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">

        <div class="portlet light " id="form_wizard_1">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-red"></i>
                    <span class="caption-subject font-red bold uppercase"> Form Wizard -
                        <span class="step-title"> Step 1 of 3 </span>
                    </span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-cloud-upload"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-wrench"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-trash"></i>
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!--<form class="form-horizontal" action="#" id="submit_form" method="POST">-->
                {{Form::open(['url' => 'clients/postClientsAjax' , 'id' => 'submit_form' , 'class' => 'form-horizontal' 
				, 'files'=> true ])}}
                <div class="form-wizard">
                    <div class="form-body">
                        <ul class="nav nav-pills nav-justified steps">
                            <li>
                                <a href="#tab1" data-toggle="tab" class="step">
                                    <span class="number"> 1 </span>
                                    <span class="desc">
                                        <i class="fa fa-check"></i> بيانات العميل </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab2" data-toggle="tab" class="step">
                                    <span class="number"> 2 </span>
                                    <span class="desc">
                                        <i class="fa fa-check"></i> بيانات الرخصة </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab4" data-toggle="tab" class="step">
                                    <span class="number"> 3 </span>
                                    <span class="desc">
                                        <i class="fa fa-check"></i> تأكيد البيانات </span>
                                </a>
                            </li>
                        </ul>
                        <div id="bar" class="progress progress-striped" role="progressbar">
                            <div class="progress-bar progress-bar-success"> </div>
                        </div>
                        <div class="tab-content">
                            <div class="alert alert-danger display-none">
                                <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. 
                            </div>
                            <div class="alert alert-success display-none">
                                <button class="close" data-dismiss="alert"></button> Your form validation is successful! 
                            </div>

                            <input type="hidden" id="form-type" value="update"/>
                            <input type="hidden" id="user_id" value="{{$client->id}}"/>


                            <div class="tab-pane active" id="tab1">
                                <h3 class="block">ادخل بيانات العميل</h3>

                                <div class="form-group">
                                    <label class="control-label col-md-3">اسم المستخدم
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('user_name' , $client->user->user_name , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">كلمة المرور
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$client->user->shown_password}}" name="password" id="generatedPass" maxlength="10" >
                                            <span class="input-group-btn">
                                                <button class="btn btn-inverse btn-md" type="button" id="generatePass" style="padding: 8px 15px;">توليد</button>
                                            </span>
                                        </div>
                                        <font color="red">{{$errors->first('password')}}</font>
                                    </div>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label class="control-label col-md-3">الاسم بالعربية
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('username' , $client->username , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">الاسم بالانجليزية
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('username_en' , $client->username_en , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">الجنسية
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{--Form::text('nationality' , $client->nationality , ['class' => 'form-control' , "autocomplete" =>"on" ])--}}
                                        <select id="country" name="nationality" class="bs-select form-control" data-live-search="true" data-size="8" >
                                            <option disabled="" selected="" value=""> اختر الدولة من فضلك ...</option>
                                            @foreach($countries as $country)
                                            <option value="{{$country->code}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">الدولة
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{--Form::select('country' , $countries , $client->country , 
													['placeholder' => '' , 'class'=>'form-control' , 'id' => 'country'])--}}
                                        <select name="country" class="form-control bs-select"  data-live-search="true" data-size="8" id="country">
                                            <option  value="{{$client->getCountry['code']}}">{{$client->getCountry['name']}} </option>
                                            @foreach($countries as $country)
                                            <option value="{{$country->code}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{URL::route('admin.country.create')}}">
                                            <button type="button" class="btn btn-success btn-xs" style="margin-bottom:10px"><i class="fa fa-plus"></i>  اضف دولة جديدة</button>
                                        </a>
                                    </div>
                                </div>		


                                <div class="form-group">
                                    <label class="control-label col-md-3">المدينة
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{--Form::select('city' , $client->getCountry->cities->lists('name' , 'id') , $client->city , 
													['placeholder' => '' , 'class'=>'form-control' , 'id' => 'city'])--}}

                                        <select name="city" id="city" data-live-search="true" data-size="8" class="form-control bs-select" >
                                            <option value="{{$client->getCityName['id']}}">{{$client->getCityName['name']}}</option>

                                            @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>	
                                    <div class="col-md-3">
                                        <a href="{{URL::route('admin.country.create')}}">
                                            <button type="button" class="btn btn-success btn-xs" style="margin-bottom:10px"> <i class="fa fa-plus"></i> اضف مدينة جديدة</button>
                                        </a>
                                    </div>
                                </div>	

                                <div class="form-group">
                                    <label class="control-label col-md-3">رقم الجوال
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-3">
                                        {{Form::text('mobile' , $client->mobile , ['class' => 'form-control',"autocomplete" =>"on"])}}
                                    </div>
                                    <div class="col-md-1">
                                        {{Form::text('code' , $client->code , ['class' => 'form-control' , 'id' => 'country_code' ,'readonly'])}}
                                    </div>
                                    <button type="button" id="addNewMobile" class="btn btn-danger btn-xs" style="margin-bottom:10px">اضف رقم اخر</button>
                                </div>	

                                @foreach($mobiles as $row)
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                    </label>
                                    <div class="col-md-3">
                                        {{Form::text('mobiles[]' , $row->number, ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                                    </div>
                                </div>
                                @endforeach

                                <div id="newMobile"></div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">تاريخ الميلاد
                                        <span class="required"> * </span>
                                    </label>

                                    <div class="col-md-4">
                                        <input class="form-control form-control-inline  date-picker"
                                               id="birth_date"  name="birth_date" size="16" type="text"
                                               value="{{$client->birth_date}}" data-date-format="dd/mm/yyyy" 
                                               data-date-end-date="-5y -3m +8d">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">صورة
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::file('photo' , ['class' => 'form-control' ,'id' => 'photo' , 'onchange' =>'validate_fileupload(this.value);'])}}

                                    </div>
                                    <div class="col-md-3">
                                        @if(!empty($client->photo))
                                        <img src="{{URL::to('/').$client->photo}}" width="25%" height="25%" />
                                        @endif
                                    </div>
                                </div>														
                                <div class="form-group">
                                    <label class="control-label col-md-3">اسم الام
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('mother_name' , $client->mother_name , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">البريد الالكتروني
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::email('email_address' , $client->email_address , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                                    </div>
                                    <button type="button" id="addNewُEmail" class="btn btn-danger btn-xs" style="margin-bottom:10px">اضف بريد الكتروني اخر</button>

                                </div>
                                @if($emails)
                                @foreach($emails as $row)
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::email('emails[]' , $row->email , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>
                                @endforeach	
                                @endif

                                <div id="newEmail"></div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">التفلون
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('phone' , $client->phone , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>	
                                <div class="form-group">
                                    <label class="control-label col-md-3">الفاكس
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('fax' , $client->fax , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">سكايب
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('skype' , $client->skype , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">تويتر
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('twitter' , $client->twitter , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">انستغرام
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('instgram' , $client->instgram , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">فيس بوك
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('facebook' , $client->facebook , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">كارت العائلة
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::file('family_card' , ['class'=>'form-control','id' => 'photo','onchange' =>'validate_fileupload(this.value);'])}}
                                    </div>
                                    <div class="col-md-3">
                                        @if(!empty($client->family_card))
                                        <img src="{{URL::to('/').$client->family_card}}" width="25%" height="25%" />
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">رقم الجواز
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('passport_number' , $client->passport_number , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">تاريخ الاصدار
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">


                                        <input class="form-control form-control-inline  date-picker" id="issue_date" name="issue_date" size="16" type="text"
                                               data-date-format="dd/mm/yyyy" value="{{$client->issue_date}}" 
                                               data-date-end-date="+0d">
                                    </div>
                                </div>														
                                <div class="form-group">
                                    <label class="control-label col-md-3">تاريخ الانتهاء
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">

                                        <input class="form-control form-control-inline" id="expire_date" 
                                               name="expire_date" data-date-format="dd/mm/yyyy" size="16" type="text" value="{{$client->expire_date}}"  >

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">مكان اصدار الجواز
                                        <span class="required"> * </span>
                                    </label>

                                    <div class="col-md-4" >
                                        <select  name="passport_issue_place" class="bs-select form-control" data-live-search="true" data-size="8" >
                                            <option disabled="" selected="" value=""> اختر الدولة من فضلك ...</option>
                                            @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-md-3">صورة الجواز
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::file('passpot_copy' ,  ['class' => 'form-control' , 'id' => 'passpot_copy' , 'onchange' =>'validate_fileupload(this.value);'])}}
                                    </div>
                                    <div class="col-md-3">
                                        @if(!empty($client->passpot_copy))
                                        <img src="{{URL::to('/').$client->passpot_copy}}" width="25%" height="25%" />
                                        @endif
                                    </div>
                                </div>																
                                <div class="form-group">
                                    <label class="control-label col-md-3">السجل المدني / الاقامة
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('residence_number' , $client->residence_number , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">صورة السجل المدني / الاقامة 
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::file('residence_copy' ,  ['class' => 'form-control' , 'id' =>'residence_copy' ,'onchange' =>'validate_fileupload(this.value);' ])}}
                                    </div>
                                    <div class="col-md-3">
                                        @if(!empty($client->residence_copy))
                                        <img src="{{URL::to('/').$client->residence_copy}}" width="25%" height="25%" />
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">ملاحظات<span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        {{Form::textarea('notes' , $client->notes , ['class' => 'form-control' , 'placeholder' => 'ملاحظات عن العميل' , 'rows' => '5'])}}
                                    </div>
                                </div>



                            </div>

                            <div class="tab-pane" id="tab2">
                                <h3 class="block">بيانات الرخصة</h3>
                                <!-- 		<div class="form-group">
                                        <label class="control-label col-md-3">رقم السجل المدني
                                                <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-4">
                                                {{--Form::text('civil_registry_number' ,
                                                $client->civil_registry_number , ['class' => 'form-control'])--}}
                                        </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="control-label col-md-3">رقم البطاقة
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('id_number' , $client->id_number , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">صورة الرخصة
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::file('license_copy' ,  ['class' => 'form-control' , 'id' =>'license_copy' ,'onchange' =>'validate_fileupload(this.value);' ])}}
                                    </div>
                                    <div class="col-md-3">
                                        @if(!empty($client->license_copy))
                                        <img src="{{URL::to('/').$client->license_copy}}" width="25%" height="25%" />
                                        @endif
                                    </div>
                                </div>		


                                <div class="form-group">
                                    <label class="control-label col-md-3">تاريخ اصدار الرخصة
                                        <span class="required"> * </span>
                                    </label>

                                    <div class="col-md-4">

                                        <input class="form-control form-control-inline  date-picker"
                                               id="license_issue_date" name="license_issue_date" size="16" type="text" data-date-format="dd/mm/yyyy" value="{{$client->license_issue_date}}" data-date-end-date="+0d">

                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">تاريخ انتهاء الرخصة
                                        <span class="required"> * </span>
                                    </label>


                                    <div class="col-md-4">
                                        <input class="form-control form-control-inline" id="license_expire_date" name="license_expire_date" data-date-format="dd/mm/yyyy" size="16" type="text" value="{{$client->license_expire_date}}"  >

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">جهة الاصدار
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('issuer' , $client->issuer , ['class' => 'form-control'])}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">رقم الحفظ
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('conservation_number' ,
											$client->conservation_number , ['class' => 'form-control'])}}
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab4">
                                <h3 class="block">تأكيد البيانات المضافة</h3>
                                <h4 class="form-section">بياانات العميل</h4>


                                <div class="portlet-body">
                                    <div class="table-scrollable">
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <td> # </td>
                                                <td colspan="2" style="text-align:center;">بيانات العميل</td>
                                            </tr>
                                            <tr>
                                                <td> 1 </td>
                                                <td> <label  style="color:red;">الاسم بالكامل</label> </td>
                                                <td> <p class="form-control-static" style="color:green;" data-display="username"> </p> </td>
                                            </tr>
                                            <tr>
                                                <td> 2 </td>
                                                <td> <label  style="color:red;">الجنسية</label> </td>
                                                <td> <p class="form-control-static" style="color:green;" data-display="nationality"> </p> </td>
                                            </tr>
                                            <tr>
                                                <td> 3 </td>
                                                <td> <label  style="color:red;">الدولة</label> </td>
                                                <td> <p class="form-control-static" style="color:green;" data-display="country"> </p> </td>
                                            </tr>
                                            <tr>
                                                <td> 4 </td>
                                                <td> <label  style="color:red;">المدينة</label> </td>
                                                <td> <p class="form-control-static" style="color:green;" data-display="city"> </p> </td>
                                            </tr>
                                            <tr>
                                                <td> 5 </td>
                                                <td> <label  style="color:red;">تاريخ الميلاد</label> </td>
                                                <td> <p class="form-control-static" style="color:green;" data-display="birth_date"> </p> </td>
                                            </tr>
                                            <tr>
                                                <td> 6 </td>
                                                <td> <label  style="color:red;">اسم الام</label> </td>
                                                <td> <p class="form-control-static" style="color:green;" data-display="mother_name"> </p> </td>
                                            </tr>
                                            <tr>
                                                <td> 7 </td>
                                                <td> <label  style="color:red;">التلفون</label> </td>
                                                <td> <p class="form-control-static" style="color:green;" data-display="phone"> </p> </td>
                                            </tr>
                                            <tr>
                                                <td> 8 </td>
                                                <td> <label  style="color:red;">فاكس</label> </td>
                                                <td> <p class="form-control-static" style="color:green;" data-display="fax"> </p> </td>
                                            </tr>
                                            <tr>
                                                <td> 9 </td>
                                                <td> <label  style="color:red;">تاريخ الاصدار</label> </td>
                                                <td> <p class="form-control-static" style="color:green;" data-display="issue_date"> </p> </td>
                                            </tr>
                                            <tr>
                                                <td> 10 </td>
                                                <td> <label  style="color:red;">تاريخ الانتهاء</label> </td>
                                                <td> <p class="form-control-static" style="color:green;" data-display="expire_date"> </p> </td>
                                            </tr>
                                            <tr>
                                                <td> 11 </td>
                                                <td> <label  style="color:red;">رقم الاقامة</label> </td>
                                                <td> <p class="form-control-static" style="color:green;" data-display="residence_number"> </p> </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>




                                <h4 class="form-section">بيانات الرخصة</h4>


                                <div class="portlet-body">
                                    <div class="table-scrollable">
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <td> # </td>
                                                <td colspan="2" style="text-align:center;">بيانات الرخصة</td>
                                            </tr>
                                            <tr>
                                                <td> 1 </td>
                                                <td> <label  style="color:red;">رقم البطاقة</label> </td>
                                                <td> <p class="form-control-static" style="color:green;" data-display="id_number"> </p> </td>
                                            </tr>
                                            <tr>
                                                <td> 2 </td>
                                                <td> <label  style="color:red;">تاريخ الاصدار</label> </td>
                                                <td> <p class="form-control-static" style="color:green;" data-display="license_issue_date"> </p> </td>
                                            </tr>
                                            <tr>
                                                <td> 3 </td>
                                                <td> <label  style="color:red;">تاريخ الانتهاء</label> </td>
                                                <td> <p class="form-control-static" style="color:green;" data-display="license_expire_date"> </p> </td>
                                            </tr>
                                            <tr>
                                                <td> 4 </td>
                                                <td> <label  style="color:red;">رقم الحفظ</label> </td>
                                                <td> <p class="form-control-static" style="color:green;" data-display="conservation_number"> </p> </td>
                                            </tr>
                                            <tr>
                                                <td> 5 </td>
                                                <td> <label  style="color:red;">جهة الاصدار</label> </td>
                                                <td> <p class="form-control-static" style="color:green;" data-display="issuer"> </p> </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <a href="javascript:;" class="btn default button-previous">
                                    <i class="fa fa-angle-right"></i> السابق </a>
                                <a href="javascript:;" class="btn btn-outline green button-next"> استمرار
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a href="{{URL::route('admin.clients.index')}}" class="btn btn-outline red"> عودة لقائمة العملاء</a>
                                <a href="javascript:;" id="saveData" class="btn green button-submit"> حفظ البيانات
                                    <i class="fa fa-check"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('JsScripts')
<script type="text/javascript">
    var request = new XMLHttpRequest();

    $("#saveData").click(function (event) {

        // check type of photo file uploaded
        var filename = $('#photo').val();
        if (filename)
        {
            var allowedExtensions = new Array('jpeg', 'gif', 'jpg', 'png');
            var currentExtension = filename.split('.').pop();
            if ($.inArray(currentExtension, allowedExtensions) > -1) {
                // everything is OK, further instructions take place
            } else {
                // reset the file input element        
                $element.replaceWith($element.clone(true).val(''));
                alert('يجب اختيار صورة عند رفع الصورة الشخصية !');
                location.reload(true);
                exit();
            }
        }

        // check type file uploaded
        var filename2 = $('#passpot_copy').val();
        if (filename2)
        {
            var allowedExtensions = new Array('jpeg', 'gif', 'jpg', 'png');
            var currentExtension = filename2.split('.').pop();
            if ($.inArray(currentExtension, allowedExtensions) > -1) {
                // everything is OK, further instructions take place
            } else {
                // reset the file input element        
                $element.replaceWith($element.clone(true).val(''));
                alert('يجب اختيار صورة عند رفع صورة جواز السفر !');
                location.reload(true);
                exit();
            }
        }


        event.preventDefault();
        var formData = new FormData($('#submit_form')[0]);
        request.open('POST', $('#base_url').val() + '/clients/updateClientsAjax/{{$client->id}}', true);
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4) {
                alert('شكرا لك تم التعديل بنجاح !');
                //if(request.responseText != '')
                //	alert(request.responseText);
                location.reload();
                //console.log(request.responseText);
                //console.log('xhr',request)
            }
        }

    }).hide();


    function validate_fileupload(fileName)
    {
        var allowedExtensions = new Array('jpeg', 'gif', 'jpg', 'png');
        var currentExtension = fileName.split('.').pop();
        if ($.inArray(currentExtension, allowedExtensions) > -1) {
            // everything is OK, further instructions take place
        } else {
            // reset the file input element        
            //$element.replaceWith($element.clone(true).val(''));
            alert('يجب ان يكون نوع الملف المرفوع صورة فقط !');
        }
    }
    $('#generatePass').click(function (event) {
        $('#generatedPass').val(Math.random().toString(36).slice(-10));
    });
</script>
@stop


@stop