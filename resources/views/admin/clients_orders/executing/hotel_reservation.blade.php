<div class="tab-pane" id="tab_2">

	<div class="portlet light portlet-fit portlet-form ">
		<div class="portlet-title">
			<div class="caption" style="float:right">
				<i class="fa fa-user font-green"></i>
				<span class="caption-subject font-green bold uppercase">حجز فندق</span>
			</div>
		</div>

		<div class="portlet-body">

			<!-- BEGIN FORM-->
			{{Form::open(array('route' => 'admin.employees.store', 'method'=>'post'  , 'class'=>'form-horizontal' , "novalidate"=>"novalidate" , "id"=>"form"))}}
			<div class="form-body">

				@if(Session::has('global_s'))
				<div class="alert alert-success" style="text-align : right;">
					<strong>شكرا لك ! </strong> {{Session::get('global_s')}}
				</div>
				@endif

				<table class="table dola">
					<?php $adult    = 1 ?>
					<?php $children = 0 ?>

					<tr>
						<td>اسم العميل</td>
						<td>{{$order->get_client_name->username}}</td>
					</tr>
					@if($order->id_wife != 0)
					<?php ++$adult ?>
					<tr>
						<td>اسم الزوجة</td>
						<td>{{$order->get_wife_name->client->username}}</td>
					</tr>
					@endif
					@if($order->id_child != "[null]")
					<tr>
						<td>الابناء</td>
						<td>
							<?php $children_ages=[] ?>
							@foreach(json_decode($order->id_child) as $id)
							<?php ++$children ?>
							{{ App\Client::find($id)->username}}
							
							<?php 
							$from = new DateTime(App\Client::find($id)->birth_date);
							$to   = new DateTime('today');
							array_push($children_ages , $from->diff($to)->y);
							?>
							@endforeach
						</td>
					</tr>
					@endif
					<tr>
						<td>عدد اﻷسرة</td>
						<td>{{$adult}} بالغ | {{$children}} طفل</td>
					</tr>
				</table>

				<div>
					<div class="btn-set text-center" style="margin-bottom:20px">
						<button type="button" class="btn yellow screen" id="screen">بحث بالموقع</button>
						<button type="button" class="btn red" id="apiH">بحث بالشاشة</button>
					</div>

					<div class="showScreen">

						<div class="form-group">
							<label class="control-label col-md-3">ملف</label>
							<div class="col-md-8">
								{{Form::file("file" , ["class"=>"form-control" , "autocomplete" =>"on" , "required"])}}<br>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">ملاحظات</label>
							<div class="col-md-8">{{Form::textarea("notes" ,"", ["class"=>"form-control" , "autocomplete" =>"on" , "required"])}}<br>
							</div>
						</div>

						<div>
							<div class="form-group">
								<label class="control-label col-md-1">السعر</label>
								<div class="col-md-2">
									{{Form::number('price' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
									<font color="red">{{$errors->first('price')}}</font>
								</div>

								<label class="control-label col-md-1">الربح</label>
								<div class="col-md-2">
									{{Form::number('profit' , '' , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
									<font color="red">{{$errors->first('profit')}}</font>
								</div>

								<label class="control-label col-md-1">النسبة</label>
								<div class="col-md-2">
									{{Form::text('percentage' , '' , ['class'=>'form-control' , "autocomplete" =>"on" ])}}
									<font color="red">{{$errors->first('percentage')}}</font>
								</div>

								<label class="control-label col-md-1">الاجمالى</label>
								<div class="col-md-2">
									{{Form::number('total' , '' , ['class'=>'form-control' , "autocomplete" =>"on" , 'required'])}}
									<font color="red">{{$errors->first('total')}}</font>
								</div>
							</div>
						</div>

						<div class="form-actions text-center">
							<div class="row">
								<div class="col-md-offset-2 col-md-9">
									<button  class="btn green">حفظ</button>
									<button type="reset" class="btn default">الغاء </button>
								</div>
							</div>
						</div>

					</div>

					<div id="HotelApi" style="display:none">

						<div class="form-group">
							<div class="text-center">
								البحث بالدولة/المدينة{{Form::radio('choose' , 1)}}
								البحث بالمدينة{{Form::radio('choose' , 2)}}
							</div>
						</div>

						<div class="form-group" style="display:none" id="countryCity">
							<label class="control-label col-md-2">الدولة</label>
							<div class="col-md-4">{{Form::select("country" , $countries , '' ,  ["class"=>"bs-select form-control" , 'placeholder'=>'من فضلك قم باختيار الدولة' , 'data-live-search' =>'true' , "required"])}}<br>
							</div>
							<label class="control-label col-md-2" id="loadCity">المدينة</label>
							<div class="col-md-4">{{Form::select("city" , [""=>"من فضلك قم باختيار الدولة اولا"] , '' , ["class"=>"bs-select form-control" , 'data-live-search' =>'true', "required"])}}<br>
							</div>
						</div>

						<div id="cityOnly"></div>

						<div class="form-group">
							<label class="control-label col-md-2">اسم الفندق</label>
							<div class="col-md-4">
								{{Form::text("hotelName" , '' ,  ["class"=>"form-control" , 'placeholder'=>'اسم الفندق . اختيارى'])}}
								<font color="cadetblue" size="1">مثال. Burj Al Arab</font>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">الجنسية</label>
							<div class="col-md-4">{{Form::select("nationality" , $countries , '' ,  ["class"=>"bs-select form-control" , 'data-live-search' =>'true' , "required"])}}<br>
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-md-2">تاريخ الذهاب</label>
							<div class="col-md-3">
								<input type="text" id="from" name="from" class="form-control" date required>
							</div>

							<label class="control-label col-md-1">ليلة</label>
							<div class="col-md-1">
								<input type="number" id="nights" name="nights" class="form-control" style="text-align: center;">
							</div>

							<label class="control-label col-md-2">تاريخ الانتهاء</label>
							<div class="col-md-3">
								<input type="text" id="to" name="to" class="form-control" date required>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">عدد النجوم</label>
							<div class="col-md-3">{{Form::select("stars"  , ['All' =>'اظهار الكل' , 'OneStarOrLess'=>'1 نجمة او اقل' , 'TwoStarOrLess'=>'2 نجمة او اقل' , 'ThreeStarOrLess'=>'3 نجمة او اقل' , 'FourStarOrLess'=>'4 نجمة او اقل' , 'FiveStarOrLess'=>'5 نجمة او اقل' ,'OneStarOrMore'=>'1 نجمة او اكثر' ,'TwoStarOrMore'=>'2 نجمة او اكثر' ,'ThreeStarOrMore'=>'3 نجمة او اكثر' ,'FourStarOrMore'=>'4 نجمة او اكثر' ,'FiveStarOrMore'=>'5 نجمة او اكثر' ] , '' ,  ["class"=>"bs-select form-control" , 'data-live-search' =>'true' , "required"])}}
							</div>
						</div>


						<div class="form-group">
							<div class="text-center">
								اختيار غرفة واحدة{{Form::radio('rooms' , 1 , 1)}}
								اختيار اكثر من غرفة{{Form::radio('rooms' , 2)}}
							</div>
						</div>

						<div class="form-group" style="display:none" id="rooms">
							<label class="control-label col-md-2">عدد الغرف</label>
							<div class="col-md-3">
								{{Form::select("roomsCount" , ["1"=>"1 غرفة" , "2"=>"2 غرفة" , "3"=>"3 غرف" , "4"=>"4 غرف" , "5"=>"5 غرف" , "6"=>"6 غرف" , ] , '' , ["class"=>"bs-select form-control" , 'data-live-search' =>'true', "required"])}}
							</div>

							<label class="control-label col-md-3">غرفة 1</label>
							<div class="col-md-2">
								{{Form::select("rooms[]" , ["1"=>"1 بالغ" , "2"=>"2 بالغ" , "3"=>"3 بالغ" , "4"=>"4 بالغ" , "5"=>"5 بالغ" , "6"=>"6 بالغ"] , '' , ["class"=>"bs-select form-control" , 'data-live-search' =>'true', "required"])}}
							</div>
							<div class="col-md-2">
								{{Form::select("rooms[]" , ["0"=>"اﻷطفال" ,  "1"=>"1" , "2"=>"2" , "3"=>"3" , "4"=>"4"] , '' , ["class"=>"bs-select form-control children" , 'data-live-search' =>'true'])}}
							</div>
						</div>

						<div class="childrenAges"></div>

						<div id="RoomCount"></div>

						<div class="form-actions text-center">
							<div class="row">
								<div class="col-md-offset-2 col-md-9 text-center">
									<button  class="btn green" id="searchHotelsBtn">بحث</button>
									<button  class="btn default" type="reset">الغاء</button>
								</div>
							</div>
						</div>

					</div>

				</div>

				<div class="text-center">
					{{HTML::image('ripple.gif' ,'' , ['style'=>'display:none' , 'id'=>"loadImg"])}}
				</div>

				<div id="HotelSearch"></div>
				<div id="roomToBook"></div>

			</div>

			{{Form::close()}}
			<!-- END FORM-->
		</div>
	</div>
	<!-- END VALIDATION STATES-->
</div>
<!-- END FORM-->
@section('hotelJs')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">

	$(function() {

		$('#from').change(function () {
			var sDate = $('#from').val().split("-");
			var endMinDate = new Date(sDate[0], sDate[1] - 1, sDate[2]);
			$('#to').datepicker('option', 'minDate', endMinDate);
		});

		$('#nights').attr('disabled', 'true');
		$( "#from" ).datepicker({
			minDate: 0,
			changeMonth: true,
			numberOfMonths: 2,
			dateFormat:"yy-mm-dd",
			onSelect: function (date) {
				var startDate = $(this).datepicker('getDate');
				var minDate   = $(this).datepicker('getDate');
				var maxDate = startDate.setDate(startDate.getDate() + 40);
                $( "#to" ).datepicker('option', 'maxDate', maxDate);
                $( "#to" ).datepicker('option', 'minDate', minDate);
            },
            onClose: function( selectedDate ) {				
            	if ($("#from").val() != "")
            		$('#nights').removeAttr('disabled');
            	else
            	{
            		$('#nights').attr('disabled', 'true');
            		$('#nights').val("");
            		$("#to").val("");
            	}
            }
        });
		$( "#to" ).datepicker({
			defaultDate: 0,	
			changeMonth: true,
			numberOfMonths: 2,
			dateFormat:"yy-mm-dd",
			onSelect: function( selectedDate ) {
				var start   = $("#from").datepicker("getDate");
				if ($("#from").val() != "" && $("#to").val() != "")
				{
					var end     = $("#to").datepicker("getDate");
					var nights  = (end - start) / (1000 * 60 * 60 * 24);
					$("#nights").val(nights);
				}
				else
				{
					$('#nights').val("");
					$("#to").val("");
					alert('يجب اختيار تاريخ الذهاب اولا');
				}
			}
		});
	});

	$("#nights").change(function(event) {
		var start   = $("#from").datepicker("getDate" , "+1w");
		var nights  = parseInt($(this).val());
		start.setDate(start.getDate()+nights); 

		$( "#to" ).datepicker("setDate" , start );
	});

	$('#apiH').click(function(event) {
		$(this).parent().parent().find('.showScreen').children().remove();
		$('#HotelApi').show();
	});

	$('.screen').each(function(event) {
		$(this).click(function(event) {
			$(this).parent().parent().find('#HotelApi').hide();
			$("#HotelSearch").children().remove();
		});
	});

	$("#searchHotelsBtn").click(function(event) {
		if($('input[name="rooms"]:checked').val() == 1 )
		{
			var roomsCount = 1;
			var rooms      = ["{{$adult}}" , "{{$children}}"];

			var ages  	   = [];
			@if(isset($children_ages))
			var arr        = {{str_replace('"' , "" , json_encode($children_ages))}};
			$.each(arr, function(index, val) {
				ages.push(String(val));
			});
			@endif
		}

		else
		{
			var roomsCount = $('select[name="roomsCount"]').val()

			var rooms 	   = [];
			$('select[name="rooms[]"]').each(function () {
				rooms.push($(this).val());
			});

			var ages  = [];
			$('select[name="ages[]"]').each(function (index , val) {
				ages.push($(this).val());
			});
		}

		if($( "#to" ).val() == "" || $( "#from" ).val() == "")
		{
			alert('من فضلك اختر التاريخ');
			return false;
		}

		$('#screen').attr('disabled', 'true');
		$('#HotelApi').hide();
		$('#loadImg').show();
		event.preventDefault();

		if($('select[name="topCity"]').val() != undefined)
		{
			var country  = '""';
			var cityId   = $('select[name="topCity"]').val();
			var cityName = $('select[name="topCity"] option:selected').text();
		}
		else
		{
			var country  = $('select[name="country"]').val();
			var cityId   = $('select[name="city"]').val();
			var cityName = $('select[name="city"] option:selected').text();
		}

		var data = {
			hotelName    :$('input[name="hotelName"]').val(),
			checkInDate  :$('input[name="from"]').val(),
			checkOutDate :$('input[name="to"]').val(),
			nights       :$('#nights').val(),
			country      :country,
			nationality  :$('select[name="nationality"]').val(),
			stars        :$('select[name="stars"]').val(),
			roomsCount   :roomsCount,
			cityId       :cityId,
			cityName     :cityName,
			rooms 		 :rooms,
			ages 		 :ages,
			order_id     :{{$order->id}}
		};
		$('#HotelSearch').load($('#base_url').val() +"/api/hotel/search" , data);
	});

	$('select[name="roomsCount"]').change(function(event) {
		$('#RoomCount').children().remove();
		for (var i = 2; i <= $(this).val() ; i++) 
			$('#RoomCount').append('<div class="form-group"><div class="col-md-5"></div><label class="control-label col-md-3">غرفة '+ i +'</label><div class="col-md-2">{{Form::select("rooms[]" , ["1"=>"1 بالغ" , "2"=>"2 بالغ" , "3"=>"3 بالغ" , "4"=>"4 بالغ" , "5"=>"5 بالغ" , "6"=>"6 بالغ"] , "" , ["class"=>"bs-select form-control" , 'data-live-search' =>'true', "required"])}}</div><div class="col-md-2">{{Form::select("rooms[]" , ["0"=>"اﻷطفال" ,  "1"=>"1" , "2"=>"2" , "3"=>"3" , "4"=>"4"] , '' , ["class"=>"bs-select form-control children" , 'data-live-search' =>'true'])}}</div></div><div class="childrenAges"></div>');
	});

	$(document).on('change', ('.children') , function(event) {
		var childrenAges = $(this).parent().parent().next('.childrenAges');
		childrenAges.children().remove();
		for (var i = 1; i <= $(event.target).val() ; i++) 
			childrenAges.append('<div class="form-group"><div class="col-md-10"></div><div class="col-md-2">{{Form::select("ages[]" , [""=>"العمر" ,  "1"=>"1" , "2"=>"2" , "3"=>"3" , "4"=>"4"] , '' , ["class"=>"bs-select form-control" , 'data-live-search' =>'true'])}}</div></div>');
	});

	$('select[name="country"]').change(function(event) {
		$.ajax({
			url: $('#base_url').val() + '/api/city/list/' + this.value,
			beforeSend: function(){
				$('#loadCity').append('<img src="'+$("#base_url").val()+'/smLoad.gif" class="smLoadCity">');
			},
		})
		.done(function(data) {
			$('select[name="city"]').empty();
			if(data == "")
				$('select[name="city"]').append("<option vlaue=''>لا يوجد مدن بهذه الدولة</option>");
			else
			{
				$('select[name="city"]').append("<option vlaue=''>من فضلك قم باختيار مدينة</option>");
				$.each(data, function(index, val) {
					$('select[name="city"]').append($('<option>', {
						value: val.CityCode,
						text:  val.CityName
					}));
				});
			}
			$('select[name="city"]').selectpicker('refresh');
			$('.smLoadCity').remove();
		})

		.fail(function(data) {
			$('select[name="city"]').empty();
			$('select[name="city"]').append("<option vlaue=''>من فضلك اختر الدولة اولا</option>");
			$('select[name="city"]').selectpicker('refresh');
			$('.smLoadCity').remove();
		})
	});

	$('input[name="choose"]').click(function(event) {
		if(this.value == 1)
		{
			$('#countryCity').show();
			$('#cityOnly').children().remove();
			$('#RoomCount').children().remove();
		}
		if(this.value == 2)
		{
			$('#cityOnly').children().remove();
			$('#countryCity').hide();
			$('#cityOnly').append('<div class="form-group" ><label class="control-label col-md-2">مدينة مشهورة </label><div class="col-md-4">{{Form::select("topCity" , $Hotelcities , "" , ["class"=>"bs-select form-control" , 'placeholder'=>'من فضلك قم باختيار مدينة مشهورة','data-live-search' =>'true', "required"])}}<br></div></div>');
			$('select[name="topCity"]').selectpicker('refresh');
		}
	});

	$('input[name="rooms"]').click(function(event) {
		var childrenAges = $('.children').parent().parent().next('.childrenAges');
		if(this.value == 1)
		{
			$('#rooms').hide();
			$('#RoomCount').children().remove();
			$('select[name="roomsCount"]').val(1).change();
			$('select[name="rooms[]"]').val(1).change();
			$('select.children').val(0).change();
			$('.childrenAges').children().remove();
		}
		if(this.value == 2)
			$('#rooms').show();
	});


</script>

@stop