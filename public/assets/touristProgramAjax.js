var from_city = $('select[name="from_city"]');
var to_city = $('select[name="to_city"]');

$('#addActivity').click(function (event) {
    $('#addMoreActivity').append('<div class="form-group"><label class="control-label col-md-2"></label><div class="col-md-4"><textarea name="event[]" class="form-control" placeholder="الحدث" style="margin: 0px 0px 0px -101.344px; width: 439px; height: 187px;"></textarea></div><div class="col-md-2 col-md-push-1"><input name="time[]" class="form-control" placeholder="الساعة"></div><div class="col-md-2 col-md-push-1">	<input name="duration[]" class="form-control" placeholder="المدة"></div><div class="col-md-1 col-md-push-1"><a href="javascript:;" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white  tooltips removeParent"><i class="fa fa-times"></i></a></div></div>');
});


$(document).on('click', '.removeParentBus', function () {
    $(this).parent().parent().parent().remove();
});
$(document).on('click', '.removeParent', function () {
    $(this).parent().parent().remove();
});

$(document).on('change', 'select[name="supplier_id[]"]', function (event) {
    var bus = $(this).parent().parent().parent().parent().find('select[name="bus_id[]"]');
    var driver = $(this).parent().parent().parent().parent().find('select[name="driver_id[]"]');

    $.ajax({
        url: $('#base_url').val() + '/getBusesAndDrivers',
        data: {id: this.value},
    })
            .done(function (data) {
                $('#BusInfo').hide();
                $('#DriverInfo').hide();
                if (data[0] == 0)
                {
                    bus.empty();
                    bus.append("<option>لا يوجد اى باصات لهذا المزود</option>");
                } else
                {
                    bus.empty();
                    bus.addClass('bs-select form-control');
                    bus.append("<option>من فضلك اختر باص</option>");
                    $.each(data[0], function (index, val) {
                        bus.append("<option value='" + val.id + "'>" + val.number + "</option>");
                    });

                }
                if (data[1] == 0)
                {
                    driver.empty();
                    driver.append("<option>لا يوجد اى سائقين لهذا المزود</option>");
                } else
                {
                    driver.empty();
                    driver.addClass('bs-select form-control');
                    driver.append("<option>من فضلك اختر سائق</option>");
                    $.each(data[1], function (index, val) {
                        driver.append("<option value='" + val.id + "'>" + val.name + "</option>");
                    });
                }
                driver.selectpicker('refresh');
                bus.selectpicker('refresh');
            })
});

$(document).on('change', 'select[name="driver_id[]"]', function (event) {
    var thisDriver = $(this);

    $.ajax({
        url: $('#base_url').val() + '/getDriverInformation',
        data: {id: this.value},
    })
            .done(function (data) {
                if (data == 0)
                    thisDriver.parent().parent().find('#DriverInfo').hide();
                else
                {
                    thisDriver.parent().parent().find('#DriverInfo').show();
                    thisDriver.parent().parent().find('#DriverInfo').addClass('well');
                    thisDriver.parent().parent().find('#DriverInfo').html("صورة السائق: <img class='img-circle' width='50' height='50' src='" + $('#base_url').val() + "/" + data.photo + "'>" + "<br>اسم السائق: " + data.name + "<br>عمر السائق " + data.age + "<br>جنسية السائق: " + data.nationality + "<br>رقم الرخصة: " + data.card_number + "<br>الدولة: " + data.country + "<br>المدينة: " + data.city);
                }
            })
});


$(document).on('change', 'select[name="bus_id[]"]', function (event) {
    var bus = $(this);
    $.ajax({
        url: $('#base_url').val() + '/getBusInformation',
        data: {id: bus.val()},
    })
            .done(function (data) {
                if (data == 0)
                {
                    bus.parent().parent().find('#BusInfo').hide()
                } else
                {
                    bus.parent().parent().find('#BusInfo').show();
                    bus.parent().parent().find('#BusInfo').addClass('well');
                    bus.parent().parent().find('#BusInfo').html("صورة الباص: <img class='img-circle' width='50' height='50' src='" + $('#base_url').val() + "/" + data.photo + "'>" + "<br>رقم الباص: " + data.number + "<br>موديل الباص: " + data.model + "<br>لون الباص: " + data.color + "<br>حجم الباص: " + data.size);
                }
            })
});

$('select[name="from_country"]').change(function (event) {
    $.ajax({
        url: $('#base_url').val() + '/city/getCity',
        data: {country_code: this.value},
    })
            .done(function (data) {
                if (data == 0)
                {
                    from_city.empty();
                    from_city.append("<option>لا يوجد اى مدن فى هذه البلد</option>");
                } else
                {
                    from_city.empty();
                    from_city.addClass('bs-select form-control');
                    from_city.append("<option>من فضلك اختر مدينة</option>");
                    $.each(data, function (index, val) {
                        from_city.append("<option value='" + val.id + "'>" + val.name + "</option>");
                    });
                }
                from_city.selectpicker('refresh');
            })
});

$('select[name="to_country"]').change(function (event) {
    $.ajax({
        url: $('#base_url').val() + '/city/getCity',
        data: {country_code: this.value},
    })
            .done(function (data) {
                if (data == 0)
                {
                    to_city.empty();
                    to_city.append("<option>لا يوجد اى مدن فى هذه البلد</option>");
                } else
                {
                    to_city.empty();
                    to_city.addClass('bs-select form-control');
                    to_city.append("<option>من فضلك اختر مدينة</option>");
                    $.each(data, function (index, val) {
                        to_city.append("<option value='" + val.id + "'>" + val.name + "</option>");
                    });
                }
                to_city.selectpicker('refresh');
            })
});

$(document).on('change', 'select[name="client_id"]', function (event) {
    var client = $(this);
    $.ajax({
        url: $('#base_url').val() + '/clients/getClientInfo',
        data: {client_id: client.val()},
    })
            .done(function (data) {
                if (data == 0)
                {
                    client.parent().parent().find('#ClientProgramInfo').hide()
                } else
                {
                    console.log(data);
                    client.parent().parent().find('#ClientProgramInfo').show();
                    client.parent().parent().find('#ClientProgramInfo').addClass('well');
                    client.parent().parent().find('#ClientProgramInfo').html("صورة العميل: <img class='img-circle' width='50' height='50' src='" + $('#base_url').val() + "/" + data.photo + "'>" + "<br>اسم العميل: " + data.username + "<br>الجنسية: " + data.nationality + "<br>البريد الالكترونى: " + data.email_address + "<br>الهاتف: " + data.phone);
                }
            })
});
