
$('select[name="tourist_program_id"]').change(function(event) {
	var bus = $('select[name="bus_id"]');
	var tourist_program = $(this);

             //get buses depends on tourist program
             $.ajax({
             	url: $('#base_url').val() + '/getTouristProgramIBus',
             	data: {id: tourist_program.val()},
             })

             .done(function(data) {

             	if(data == 0)
             	{
             		bus.empty();
             		bus.append("<option value=''>لا يوجد اى باصات تم اختيارها لهذا البرنامج</option>");
             		$("#reserveSeat").empty();
             		$("#reserveSeat").append('<div class="form-group"><label class="control-label col-md-3">المقعد</label><div class="col-md-8" style="margin-top: 6px;"><font color="red">من فضلك قم باختيار برنامج سياحى اخر لتتمكن من حجز المقاعد</font></div></div>');
             	}

             	else
             	{
             		bus.empty();
             		bus.addClass('bs-select form-control');
             		bus.append("<option value=''>من فضلك اختر باص</option>");
             		$.each(data, function(index, val) {
             			bus.append("<option value='"+val.id+"'>"+val.number+"</option>");
             		});
             	}
                     //get tourist program information
                     $.ajax({
                     	url: $('#base_url').val() + '/getTouristProgramIformation',
                     	data: {id: tourist_program.val()},
                     })
                     .done(function(data) {
                     	if(data == 0)
                     	{
                     		$('#TouristProgramInfo').hide();
                     		$("#reserveSeat").empty();
                     		$("#reserveSeat").append('<div class="form-group"><label class="control-label col-md-3">المقعد</label><div class="col-md-8" style="margin-top: 6px;"><font color="red">من فضلك قم باختيار الباص لتتمكن من حجز المقاعد</font></div></div>');
                     	}
                     	else
                     	{
                     		$("#reserveSeat").empty();
                     		$('#TouristProgramInfo').show();
                     		$('#TouristProgramInfo').addClass('well');
                     		$('#TouristProgramInfo').html("تاريخ الذهاب: "+data.going_date+"<br>عدد ايام الرحلة: "+data.flight_days_no+"<br>عدد ساعات الرحلة: "+data.flight_hours_no+"<br>الوجبات: "+data.meals+"<br>من دولة: "+data.fromCountry+"<br>من مدينة: "+data.fromCity+"<br>من مكان: "+data.fromPlace+"<br>الى دولة: "+data.toCountry+"<br>الى مدينة: "+data.toCountry+"<br>الى مكان: "+data.toCountry);
                  //check if the admin has been choosen the bus 
                  if(bus.val() == "")
                  {
                  	$("#reserveSeat").append('<div class="form-group"><label class="control-label col-md-3">المقعد</label><div class="col-md-8" style="margin-top: 6px;"><font color="red">من فضلك قم باختيار الباص لتتمكن من حجز المقاعد</font></div></div>');
                  	return;
                  }

            //get the bus seats numbers
            $.ajax({
            	url: $('#base_url').val() + '/getBusInformation',
            	data: {id: bus.val()},
            })
            .done(function(data) {
            	var busSize = data.size.match(/\d+/) , buttons = "";

            	if(busSize == 0)
            		$("#reserveSeat").append('<div class="form-group"><label class="control-label col-md-3">المقعد</label><div class="col-md-8" style="margin-top: 6px;"><font color="red">لا يوجد مقاعد فى هذا الباص</font></div></div>');
            	else
            	{
            //check if seat is reserved or not
            $.ajax({
            	url: $('#base_url').val() + '/checkIfSeatIsReserved',
            	data: {bus_id: bus_id , tourist_program_id : $('select[name="tourist_program_id').val()},
            })
            .done(function(data) {

            	var reserved_seats_no = [];
                var clients_inf       = [];

                $.each(data, function(index, val) {
                  $.each($.parseJSON(val[0]), function(index, seat) {
                     reserved_seats_no.push(parseInt(seat));
                     clients_inf[parseInt(seat)] =  ["Name:"+val[1].username , " Email:"+val[1].email_address , " Phone:"+val[1].phone];
                 });
              });

                for(var i = 1; i<= busSize; i++)
                {
                    if ($.inArray(i, reserved_seats_no) > -1)
                    {
                        var btnCo = "btn-reverse disabled";
                        var title =  clients_inf[i];
                    }
                    else
                    {
                     var btnCo = "btn-default";
                     var title =  "";
                 }
                 buttons += '<div class="btn-group margin-bottom-10"><button type="button" title="'+title+'" class="btn '+btnCo+' btn-w-seat">'+i+'</button></div>';
             }
             $("#reserveSeat").append('<div class="form-group"><label class="control-label col-md-3">المقعد</label><div class="btn-toolbar col-md-8">'+buttons+'</div></div>');
         })
        }
    })
        }
    })
                     bus.selectpicker('refresh');
                 })
});

$('select[name="bus_id"]').change(function(event) {
	var bus_id = this.value;
	$.ajax({
		url: $('#base_url').val() + '/getBusInformation',
		data: {id: bus_id},
	})
	.done(function(data) {
		if(data == 0)
		{
			$('#BusInfo').hide();
			$("#reserveSeat").empty();
			$("#reserveSeat").append('<div class="form-group"><label class="control-label col-md-3">المقعد</label><div class="col-md-8" style="margin-top: 6px;"><font color="red">من فضلك قم باختيار الباص لتتمكن من حجز المقاعد</font></div></div>');
		}
		else
		{
			$("#reserveSeat").empty();
			$('#BusInfo').show();
			$('#BusInfo').addClass('well');
			$('#BusInfo').html("رقم الباص: "+data.number+"<br>موديل الباص: "+data.model+"<br>لون الباص: "+data.color+"<br>حجم الباص: "+data.size);

			var busSize = data.size.match(/\d+/) , buttons = "";
			if(busSize == 0 )
				$("#reserveSeat").append('<div class="form-group"><label class="control-label col-md-3">المقعد</label><div class="col-md-8" style="margin-top: 6px;"><font color="red">لا يوجد مقاعد فى هذا الباص</font></div></div>');
			else
			{
				//check if the admin choose the tourist program
				if($('select[name="tourist_program_id').val() == "")
				{
					$("#reserveSeat").append('<div class="form-group"><label class="control-label col-md-3">المقعد</label><div class="col-md-8" style="margin-top: 6px;"><font color="red">من فضلك قم باختيار البرنامج السياحى لتتمكن من حجز المقاعد</font></div></div>');
					return;
				}

				//check if seat is reserved or not
				$.ajax({
					url: $('#base_url').val() + '/checkIfSeatIsReserved',
					data: {bus_id: bus_id , tourist_program_id : $('select[name="tourist_program_id').val()},
				})
				.done(function(data) {

					var reserved_seats_no = [];
                    var clients_inf       = [];

                    $.each(data, function(index, val) {
                      $.each($.parseJSON(val[0]), function(index, seat) {
                         reserved_seats_no.push(parseInt(seat));
                         clients_inf[parseInt(seat)] =  ["Name:"+val[1].username , " Email:"+val[1].email_address , " Phone:"+val[1].phone];
                     });
                  });

                    for(var i = 1; i<= busSize; i++)
                    {
                        if ($.inArray(i, reserved_seats_no) > -1)
                        {
                            var btnCo = "btn-reverse disabled";
                            var title =  clients_inf[i];
                        }
                        else
                        {
                         var btnCo = "btn-default";
                         var title =  "";
                     }
                     buttons += '<div class="btn-group margin-bottom-10"><button type="button" title="'+title+'" class="btn '+btnCo+' btn-w-seat">'+i+'</button></div>';
                 }
                 $("#reserveSeat").append('<div class="form-group"><label class="control-label col-md-3">المقعد</label><div class="btn-toolbar col-md-8">'+buttons+'</div></div>');
             })
				
				
			}
		}
	})
});

//select the seat button
$(document).on('click' , '.btn-w-seat' , function(index, el) {

	//if the seat is reserved
	if($(this).hasClass("disabled"))
		return false;

     //if the button is selected then deselect it and remove hidden input
     if($(this).css('background-color') == "rgb(50, 197, 210)")
     {
     	var seatBtn = $(this);

		seatBtn.css({ //deselect the button
			"background-color": 'white',
		});
         //remove the hidden input
         $('.theSeat').each(function() {
         	if($(this).val() == seatBtn.text())
         		$(this).remove();
         });

     }

     //if the button is not selected then select it and add hidden input
     else
     {
		$(this).css({ //select the button
			"background-color": '#32C5D2',
		});
         //add hidden input
         $('#theForm').append("<input class='theSeat' type='hidden' name='seat_no[]' value='"+$(this).text()+"'>")
     }
 });