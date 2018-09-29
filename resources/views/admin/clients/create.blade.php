@extends ('admin.layouts.master')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> العملاء
    <small>اضافة عميل جديد</small>
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
            <span>اضافة عميل جديد</span>
        </li>
    </ul>

</div>
<!-- END PAGE HEADER-->
<div class="row">
<<<<<<< HEAD
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
				{{Form::open(['url' => 'clients/getClientsAjax' , 'id' => 'submit_form' , 'class' => 'form-horizontal' , 'method'=>'post' , 'files'=> true   ])}}
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
											<button class="close" data-dismiss="alert"></button> 
											عفوا ! يوجد خطأ في البيانات المدخلة اداناه يرجى التأكد منها
										</div>
										<div class="alert alert-success display-none">
											<button class="close" data-dismiss="alert"></button> Your form 
											تمت عملية التحقق من البيانات بنجاح
										</div>
										<input type="hidden" id="form-type" value="insert"/>
										<div class="tab-pane active" id="tab1">
											<h3 class="block">ادخل بيانات العميل</h3>


											<div class="form-group">
												<label class="control-label col-md-3">اسم المستخدم
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													{{Form::text('user_name' , '' , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label">كلمة المرور
													<span class="required"> * </span>
												</label>
												<div class="col-sm-4">
													<div class="input-group">
														<input type="text" class="form-control" name="password" id="generatedPass" maxlength="10" >
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
													{{Form::text('username' , '' , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
												</div>
											</div>

											{{Form::hidden('parent_id' , $parent_id)}}
											{{Form::hidden('type' , $type)}}

											<div class="form-group">
												<label class="control-label col-md-3">الاسم بالانجليزية
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													{{Form::text('username_en' , '' , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}

												</div>
											</div>

											
											<div class="form-group">
												<label class="control-label col-md-3">الجنسية
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													{{--Form::text('nationality' , '' , ['class' => 'form-control' ,"autocomplete" =>"on" ])--}}
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
												<div class="col-md-4" >
													<select id="country" name="country" class="bs-select form-control" data-live-search="true" data-size="8" >
														<option disabled="" selected="" value=""> اختر الدولة من فضلك ...</option>
														@foreach($countries as $country)
														<option value="{{$country->code}}">{{$country->name}}</option>
														@endforeach
													</select>
												</div>
												<div class="col-md-3">
													<a target="_blank" href="{{URL::route('admin.country.create')}}">
														<button type="button" class="btn btn-success btn-xs" style="margin-bottom:10px"><i class="fa fa-plus"></i>  اضف دولة جديدة</button>
													</a>
												</div>
											</div>															
											<div class="form-group">
												<label class="control-label col-md-3">المدينة
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">

													<select id="city" name="city" class="form-control" data-live-search="true" data-size="8">
														<option disabled="" selected="" value=""> اختر الدولة اولا ...</option>
													</select>
												</div>
												<div class="col-md-3">
													<a target="_blank" href="{{URL::route('admin.country.create')}}">
														<button type="button" class="btn btn-success btn-xs" style="margin-bottom:10px"> <i class="fa fa-plus"></i> اضف مدينة جديدة</button>
													</a>
												</div>
											</div>					
											<div class="form-group">
												<label class="control-label col-md-3">رقم الجوال
													<span class="required"> * </span>
												</label>
												<div class="col-md-3">
													{{Form::text('mobile' , '' , ['class' => 'form-control',"autocomplete" =>"on"])}}
												</div>
												<div class="col-md-1">
													{{Form::text('code' , '' , ['class' => 'form-control' , 'id' => 'country_code' ,'readonly'])}}
												</div>
												<button type="button" id="addNewMobile" class="btn btn-danger btn-xs" style="margin-bottom:10px">اضف رقم اخر</button>
											</div>	

											<div id="newMobile"></div>


											<div class="form-group">
												<label class="control-label col-md-3">تاريخ الميلاد
													<span class="required"> * </span>
												</label>
												<div class="col-md-4"> 
													<input class="form-control form-control-inline  date-picker" placeholder="dd/mm/yyyy" id="birth_date"  name="birth_date" size="16" type="text" value="" data-date-format="dd/mm/yyyy" >
												</div>
											</div>


											<div class="form-group">
												<label class="control-label col-md-3">صورة
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													{{Form::file('photo' , ['class'=>'form-control','id' => 'photo','onchange' =>'validate_fileupload(this.value);'])}}
												</div>
											</div>														
											<div class="form-group">
												<label class="control-label col-md-3">اسم الام
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													{{Form::text('mother_name' , '' , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">البريد الالكتروني
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													{{Form::email('email_address' , '' , ['class' => 'form-control' ,"autocomplete" =>"on" , 'placeholder' => 'البريد الالكتروني' ])}}
												</div>
												<button type="button" id="addNewُEmail" class="btn btn-danger btn-xs" style="margin-bottom:10px">اضف بريد الكتروني اخر</button>
											</div>

											<div id="newEmail"></div>

											<div class="form-group">
												<label class="control-label col-md-3">التليفون
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													{{Form::text('phone' , '' , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
												</div>
											</div>	
											<div class="form-group">
												<label class="control-label col-md-3">الفاكس
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													{{Form::text('fax' , '' , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">كارت العائلة
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													{{Form::file('family_card' , ['class'=>'form-control','id' => 'photo','onchange' =>'validate_fileupload(this.value);'])}}
												</div>
											</div>		

											<div class="form-group">
												<label class="control-label col-md-3">رقم الجواز
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													{{Form::text('passport_number' , '' , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">تاريخ اصدار الجواز
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input class="form-control form-control-inline  date-picker" required id="issue_date" placeholder="dd/mm/yyyy" name="issue_date" size="16" type="text" data-date-format="dd/mm/yyyy" value="" data-date-end-date="+0d">
												</div>
											</div>														
											<div class="form-group">
												<label class="control-label col-md-3">تاريخ انتهاء الجواز
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input class="form-control form-control-inline" id="expire_date" required name="expire_date" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" size="16" type="text" value=""  >
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
													{{Form::file('passpot_copy' ,  ['class' => 'form-control' , 'id' =>'passpot_copy' ,'onchange' =>'validate_fileupload(this.value);' ])}}

												</div>
											</div>																
											<div class="form-group">
												<label class="control-label col-md-3">السجل المدني / الاقامة
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													{{Form::text('residence_number' , '' , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">صورة السجل المدني / الاقامة 
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													{{Form::file('residence_copy' ,  ['class' => 'form-control' , 'id' =>'residence_copy' ,'onchange' =>'validate_fileupload(this.value);' ])}}
												</div>
											</div>		
											<div class="form-group">
												<label class="control-label col-md-3">ملاحظات<span class="required"> * </span></label>
												<div class="col-md-4">
													{{Form::textarea('notes' , '' , ['class' => 'form-control' , 'placeholder' => 'ملاحظات عن العميل' , 'rows' => '5'])}}
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab2">
											<h3 class="block">بيانات الرخصة</h3>
											<div class="form-group">
												<label class="control-label col-md-3">رقم البطاقة
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													{{Form::text('id_number' , '' , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">صورة الرخصة
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													{{Form::file('license_copy' ,  ['class' => 'form-control' , 'id' =>'license_copy' ,'onchange' =>'validate_fileupload(this.value);' ])}}
												</div>
											</div>		
											<div class="form-group">
												<label class="control-label col-md-3">تاريخ اصدار الرخصة
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input class="form-control form-control-inline  date-picker" id="license_issue_date" placeholder="dd/mm/yyyy" name="license_issue_date" size="16" type="text" data-date-format="dd/mm/yyyy" value="" data-date-end-date="+0d">
												</div>
											</div>														
											<div class="form-group">
												<label class="control-label col-md-3">تاريخ انتهاء الرخصة
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input class="form-control form-control-inline" id="license_expire_date" name="license_expire_date" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" size="16" type="text" value=""  >
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">جهة اصدار الرخصة
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													{{Form::text('issuer' , '' , ['class' => 'form-control' , 'id' => 'chackAlpha' , "autocomplete" =>"on" ])}}
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">رقم الحفظ
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													{{Form::text('conservation_number' , '' , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
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
												<i class="fa fa-angle-right"></i> العودة </a>
												<a href="javascript:;" class="btn btn-outline green button-next"> استمرار
													<i class="fa fa-angle-left"></i>
												</a>
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
				$('#generatedPass').val(Math.random().toString(36).slice(-10));
				var request = new  XMLHttpRequest();
				$("#saveData").click(function(event) {
				// check type of photo file uploaded
				var filename = $('#photo').val();
				if(filename)
				{
					var allowedExtensions = new Array ('jpeg','gif','jpg','png');
					var currentExtension = filename.split('.').pop();
					if ($.inArray (currentExtension, allowedExtensions) > -1) {
						// everything is OK, further instructions take place
					}   else {
						// reset the file input element        
						$element.replaceWith($element.clone(true).val(''));
						alert('يجب اختيار صورة عند رفع الصورة الشخصية !');  
						// location.reload(true);
						exit();
					}
				}
				// check type of passpot copy file uploaded
				var filename2 = $('#passpot_copy').val();
				if(filename2)
				{					
					var allowedExtensions = new Array ('jpeg','gif','jpg','png');
					var currentExtension = filename.split('.').pop();
					if ($.inArray (currentExtension, allowedExtensions) > -1) {
						// everything is OK, further instructions take place
					}   else {
						// reset the file input element        
						$element.replaceWith($element.clone(true).val(''));
						alert('يجب اختيار صورة عند رفع صورة جواز السفر !');  
						location.reload(true);
						exit();
					}
				}
				// check type of Residence copy file uploaded
				var filename3 = $('#residence_copy').val();
				if(filename3)
				{					
					var allowedExtensions = new Array ('jpeg','gif','jpg','png');
					var currentExtension = filename.split('.').pop();
					if ($.inArray (currentExtension, allowedExtensions) > -1) {
						// everything is OK, further instructions take place
					}   else {
						// reset the file input element        
						$element.replaceWith($element.clone(true).val(''));
						alert('يجب اختيار صورة عند رفع صورة الاقامة !');  
						location.reload(true);
						exit();
					}
				}
				// check type of license copy file uploaded
				var filename4 = $('#license_copy').val();
				if(filename4)
				{
					var allowedExtensions = new Array('jpeg' , 'gif' , 'jpg' , 'png');
					var currentExtension  = filename4.split('.').pop();
					if($.inArray (currentExtension , allowedExtensions) > -1)
					{
						// evreything is ok , futher instruction take place
					}
					else
					{
						// reset the file input element
						$element.replaceWith($element.clone(true).val(''));
						alert('يجب اختيار صورة عند رفع صورة الرخصة ! ');
						location.reload(true);
						exit();
					}
				}
				// send data to controller to save it
				event.preventDefault();
				var formData = new FormData($('#submit_form')[0]);
				request.open('POST' , $('#base_url').val() + '/clients/getClientsAjax' , true);
				request.send(formData);
				request.onreadystatechange=function() {
					if (request.readyState==4) {
						alert('شكرا لك تم التسجيل بنجاح !');
						if(request.responseText != '')
							alert(request.responseText);
						console.log(request.responseText);
						/*console.log('xhr',request)*/
						// location.reload(true);
					}
				}
			}).hide();

				function validate_fileupload(fileName)
				{
					var allowedExtensions = new Array ('jpeg','gif','jpg','png');
					var currentExtension = fileName.split('.').pop();
					if ($.inArray (currentExtension, allowedExtensions) > -1) {
					// everything is OK, further instructions take place
				}   else {
					// reset the file input element        
					//$element.replaceWith($element.clone(true).val(''));
					alert('يجب ان يكون نوع الملف المرفوع صورة فقط !');  
				}
			}

/*			$('#generatePass').click(function(event) {
				$('#generatedPass').val(Math.random().toString(36).slice(-10));
			});*/

		</script>
		@stop

		@stop
=======
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
                {{Form::open(['url' => 'clients/getClientsAjax' , 'id' => 'submit_form' , 'class' => 'form-horizontal' , 'method'=>'post' , 'files'=> true   ])}}
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
                                <button class="close" data-dismiss="alert"></button> 
                                عفوا ! يوجد خطأ في البيانات المدخلة اداناه يرجى التأكد منها
                            </div>
                            <div class="alert alert-success display-none">
                                <button class="close" data-dismiss="alert"></button> Your form 
                                تمت عملية التحقق من البيانات بنجاح
                            </div>
                            <input type="hidden" id="form-type" value="insert"/>
                            <div class="tab-pane active" id="tab1">
                                <h3 class="block">ادخل بيانات العميل</h3>


                                <div class="form-group">
                                    <label class="control-label col-md-3">اسم المستخدم
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('user_name' , '' , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">كلمة المرور
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="password" id="generatedPass" maxlength="10" >
                                            <span class="input-group-btn">
                                                <button class="btn btn-inverse btn-md" type="button" id="generatePass" style="padding: 8px 15px;">توليد</button>
                                            </span>
                                        </div>
                                        <font color="red">{{$errors->first('password')}}</font>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"> نوع المستخدم
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-sm-4">
                                            
                                            {{Form::select('type' , array('arab'=>'عربي' , 'foreign' => 'اجنبي') , '', ['class' => 'form-control' ])}}
                                        <font color="red">{{$errors->first('password')}}</font>
                                    </div>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label class="control-label col-md-3">الاسم بالعربية
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('username' , '' , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>

                                {{Form::hidden('parent_id' , $parent_id)}}
                                {{Form::hidden('type' , $type)}}

                                <div class="form-group">
                                    <label class="control-label col-md-3">الاسم بالانجليزية
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('username_en' , '' , ['class' => 'form-control' , "autofocus"=>"autofocus" ,"autocomplete" =>"on" ])}}

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">الجنسية
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{--Form::text('nationality' , '' , ['class' => 'form-control' ,"autocomplete" =>"on" ])--}}
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
                                    <div class="col-md-4" >
                                        <select id="country" name="country" class="bs-select form-control" data-live-search="true" data-size="8" >
                                            <option disabled="" selected="" value=""> اختر الدولة من فضلك ...</option>
                                            @foreach($countries as $country)
                                            <option value="{{$country->code}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <a target="_blank" href="{{URL::route('admin.country.create')}}">
                                            <button type="button" class="btn btn-success btn-xs" style="margin-bottom:10px"><i class="fa fa-plus"></i>  اضف دولة جديدة</button>
                                        </a>
                                    </div>
                                </div>															
                                <div class="form-group">
                                    <label class="control-label col-md-3">المدينة
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">

                                        <select id="city" name="city" class="form-control" data-live-search="true" data-size="8">
                                            <option disabled="" selected="" value=""> اختر الدولة اولا ...</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <a target="_blank" href="{{URL::route('admin.country.create')}}">
                                            <button type="button" class="btn btn-success btn-xs" style="margin-bottom:10px"> <i class="fa fa-plus"></i> اضف مدينة جديدة</button>
                                        </a>
                                    </div>
                                </div>					
                                <div class="form-group">
                                    <label class="control-label col-md-3">رقم الجوال
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-3">
                                        {{Form::text('mobile' , '' , ['class' => 'form-control',"autocomplete" =>"on"])}}
                                    </div>
                                    <div class="col-md-1">
                                        {{Form::text('code' , '' , ['class' => 'form-control' , 'id' => 'country_code' ,'readonly'])}}
                                    </div>
                                    <button type="button" id="addNewMobile" class="btn btn-danger btn-xs" style="margin-bottom:10px">اضف رقم اخر</button>
                                </div>	

                                <div id="newMobile"></div>


                                <!--                                <div class="form-group">
                                                                    <label class="control-label col-md-3">تاريخ الميلاد
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4"> 
                                                                        <input class="form-control form-control-inline  date-picker" placeholder="dd/mm/yyyy" id="birth_date"  name="birth_date" size="16" type="text" value="" data-date-format="dd/mm/yyyy" >
                                                                    </div>
                                                                </div>-->

                                <div class="form-group">
                                    <label class="control-label col-md-3">تاريخ الميلاد</label>
                                    <div class="col-md-4">
                                        <input class="form-control form-control-inline date-picker" placeholder="dd/mm/yyyy" name="birth_date"  value="" id="birth_date"  type="text" data-date-format="dd/mm/yyyy" />
                                        <span class="help-block"> d/m/y </span>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">صورة
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::file('photo' , ['class'=>'form-control','id' => 'photo','onchange' =>'validate_fileupload(this.value);'])}}
                                    </div>
                                </div>														
                                <div class="form-group">
                                    <label class="control-label col-md-3">اسم الام
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('mother_name' , '' , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">البريد الالكتروني
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::email('email_address' , '' , ['class' => 'form-control' ,"autocomplete" =>"on" , 'placeholder' => 'البريد الالكتروني' ])}}
                                    </div>
                                    <button type="button" id="addNewُEmail" class="btn btn-danger btn-xs" style="margin-bottom:10px">اضف بريد الكتروني اخر</button>
                                </div>

                                <div id="newEmail"></div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">التليفون
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('phone' , '' , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>	
                                <div class="form-group">
                                    <label class="control-label col-md-3">الفاكس
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('fax' , '' , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">سكايب
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('skype' , '' , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">تويتر
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('twitter' , '' , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">انستغرام
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('instgram' , '' , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">فيس بوك
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('facebook' , '' , ['class' => 'form-control' ,"autocomplete" =>"on" ])}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">كارت العائلة
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::file('family_card' , ['class'=>'form-control','id' => 'photo','onchange' =>'validate_fileupload(this.value);'])}}
                                    </div>
                                </div>		

                                <div class="form-group">
                                    <label class="control-label col-md-3">رقم الجواز
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('passport_number' , '' , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">تاريخ اصدار الجواز
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input class="form-control form-control-inline date-picker" required  placeholder="dd/mm/yyyy" name="issue_date"  value="" id="issue_date"  type="text" data-date-format="dd/mm/yyyy" data-date-end-date="+0d" />
                                        <span class="help-block"> d/m/y </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">تاريخ انتهاء الجواز
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input class="form-control form-control-inline date-picker" required  placeholder="dd/mm/yyyy" name="expire_date"  value="" id="expire_date"  type="text" data-date-format="dd/mm/yyyy"/>
                                        <span class="help-block"> d/m/y </span>
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
                                        {{Form::file('passpot_copy' ,  ['class' => 'form-control' , 'id' =>'passpot_copy' ,'onchange' =>'validate_fileupload(this.value);' ])}}

                                    </div>
                                </div>																
                                <div class="form-group">
                                    <label class="control-label col-md-3">السجل المدني / الاقامة
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('residence_number' , '' , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">صورة السجل المدني / الاقامة 
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::file('residence_copy' ,  ['class' => 'form-control' , 'id' =>'residence_copy' ,'onchange' =>'validate_fileupload(this.value);' ])}}
                                    </div>
                                </div>		
                                <div class="form-group">
                                    <label class="control-label col-md-3">ملاحظات<span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        {{Form::textarea('notes' , '' , ['class' => 'form-control' , 'placeholder' => 'ملاحظات عن العميل' , 'rows' => '5'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                <h3 class="block">بيانات الرخصة</h3>
                                <div class="form-group">
                                    <label class="control-label col-md-3">رقم البطاقة
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('id_number' , '' , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">صورة الرخصة
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::file('license_copy' ,  ['class' => 'form-control' , 'id' =>'license_copy' ,'onchange' =>'validate_fileupload(this.value);' ])}}
                                    </div>
                                </div>		
                                <div class="form-group">
                                    <label class="control-label col-md-3">تاريخ اصدار الرخصة
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <!--<input class="form-control form-control-inline  date-picker" id="license_issue_date" placeholder="dd/mm/yyyy" name="license_issue_date" size="16" type="text" data-date-format="dd/mm/yyyy" value="" data-date-end-date="+0d">-->
                                        <input class="form-control form-control-inline date-picker"   placeholder="dd/mm/yyyy" name="license_issue_date"  value="" id="license_issue_date"  type="text" data-date-format="dd/mm/yyyy" data-date-end-date="+0d" />
                                        <span class="help-block"> d/m/y </span>
                                    </div>
                                </div>														
                                <div class="form-group">
                                    <label class="control-label col-md-3">تاريخ انتهاء الرخصة
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <!--<input class="form-control form-control-inline" id="license_expire_date" name="license_expire_date" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" size="16" type="text" value=""  >-->
                                        <input class="form-control form-control-inline date-picker"   placeholder="dd/mm/yyyy" name="license_expire_date"  value="" id="license_expire_date"  type="text" data-date-format="dd/mm/yyyy" />
                                        <span class="help-block"> d/m/y </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">جهة اصدار الرخصة
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('issuer' , '' , ['class' => 'form-control' , 'id' => 'chackAlpha' , "autocomplete" =>"on" ])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">رقم الحفظ
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        {{Form::text('conservation_number' , '' , ['class' => 'form-control' , "autocomplete" =>"on" ])}}
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
                                    <i class="fa fa-angle-right"></i> العودة </a>
                                <a href="javascript:;" class="btn btn-outline green button-next"> استمرار
                                    <i class="fa fa-angle-left"></i>
                                </a>
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
    $('#generatedPass').val(Math.random().toString(36).slice(-10));
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
                // location.reload(true);
                exit();
            }
        }
        // check type of passpot copy file uploaded
        var filename2 = $('#passpot_copy').val();
        if (filename2)
        {
            var allowedExtensions = new Array('jpeg', 'gif', 'jpg', 'png');
            var currentExtension = filename.split('.').pop();
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
        // check type of Residence copy file uploaded
        var filename3 = $('#residence_copy').val();
        if (filename3)
        {
            var allowedExtensions = new Array('jpeg', 'gif', 'jpg', 'png');
            var currentExtension = filename.split('.').pop();
            if ($.inArray(currentExtension, allowedExtensions) > -1) {
                // everything is OK, further instructions take place
            } else {
                // reset the file input element        
                $element.replaceWith($element.clone(true).val(''));
                alert('يجب اختيار صورة عند رفع صورة الاقامة !');
                location.reload(true);
                exit();
            }
        }
        // check type of license copy file uploaded
        var filename4 = $('#license_copy').val();
        if (filename4)
        {
            var allowedExtensions = new Array('jpeg', 'gif', 'jpg', 'png');
            var currentExtension = filename4.split('.').pop();
            if ($.inArray(currentExtension, allowedExtensions) > -1)
            {
                // evreything is ok , futher instruction take place
            } else
            {
                // reset the file input element
                $element.replaceWith($element.clone(true).val(''));
                alert('يجب اختيار صورة عند رفع صورة الرخصة ! ');
                location.reload(true);
                exit();
            }
        }
        // send data to controller to save it
        event.preventDefault();
        var formData = new FormData($('#submit_form')[0]);
        request.open('POST', $('#base_url').val() + '/clients/getClientsAjax', true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState == 4) {
                alert('شكرا لك تم التسجيل بنجاح !');
                if (request.responseText != '')
                    alert(request.responseText);
                console.log(request.responseText);
                /*console.log('xhr',request)*/
                // location.reload(true);
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
>>>>>>> 212e535fbe2c2ac4bca4ab72336d49a8465c7ea3
