
$(window).load(function(event) {
	var thisDriver = $('select[name="driver_id[]"]');

	$.ajax({
		url: $('#base_url').val() + '/getDriverInformation',
		data: {id: thisDriver.val()},
	})
	.done(function(data) {
		if(data == 0)
			thisDriver.parent().parent().find('#DriverInfo').hide();
		else
		{
			thisDriver.parent().parent().find('#DriverInfo').show();
			thisDriver.parent().parent().find('#DriverInfo').addClass('well');
			thisDriver.parent().parent().find('#DriverInfo').html("صورة السائق: <img class='img-circle' width='50' height='50' src='"+ $('#base_url').val()+ "/" + data.photo +"'>"+"<br>اسم السائق: "+data.name+"<br>عمر السائق "+data.age+"<br>جنسية السائق: "+data.nationality+"<br>رقم الرخصة: "+data.card_number+"<br>الدولة: "+data.country+"<br>المدينة: "+data.city);
		}
	})
});


$(window).load(function(event) {
	var bus = $('select[name="bus_id[]"]');
	$.ajax({
		url: $('#base_url').val() + '/getBusInformation',
		data: {id: bus.val()},
	})
	.done(function(data) {
		if(data == 0)
		{
			bus.parent().parent().find('#BusInfo').hide()
		}
		else
		{
			bus.parent().parent().find('#BusInfo').show();
			bus.parent().parent().find('#BusInfo').addClass('well');
			bus.parent().parent().find('#BusInfo').html("صورة الباص: <img class='img-circle' width='50' height='50' src='"+ $('#base_url').val()+ "/" + data.photo +"'>"+"<br>رقم الباص: "+data.number+"<br>موديل الباص: "+data.model+"<br>لون الباص: "+data.color+"<br>حجم الباص: "+data.size);
		}
	})
});




