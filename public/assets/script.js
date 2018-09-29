$(document).ready(function() {
var $validator = $("#commentForm").validate({
rules: {
name: {
required: true,
        minlength: 5
},
        nationality: {
        required: true,
        },
        country: {
        required: true,
        },
        city: {
        required: true,
        },
        birth_date: {
        required: true,
        },
        photo: {
        required: true,
        },
        passpot_copy: {
        required: true,
        },
        mother_name: {
        required: true,
                minlength: 5
        },
        email: {
        required: true,
                email: true,
                minlength: 3
        },
        mobile: {
        required: true,
                minlength: 9
        },
        phone: {
        required: true,
                minlength: 5
        },
        fax: {
        required: true,
                minlength: 5
        },
        passport_number: {
        required: true,
                minlength: 5
        },
        passport_number: {
        required: true,
                minlength: 5
        },
        issue_date: {
        required: true,
        },
        expire_date: {
        required: true,
        },
        expire_date: {
        required: true,
        },
        civil_registry_number: {
        required: true,
        },
}
});
        $('#rootwizard').bootstrapWizard({
'tabClass': 'nav nav-pills',
        'onNext': function(tab, navigation, index) {
        var $valid = $("#commentForm").valid();
                if (!$valid) {
        $validator.focusInvalid();
                return false;
        }
        }
});
        $('#form_wizard_1 #country').on('change', function(){
var country = this.value;
        var baseurl = document.getElementById('baseurl').value;
        var dataString = 'country=' + country;
        $.ajax({
        url: baseurl + '/clients/getCode',
                type: "get",
                data: dataString,
                success: function (data)
                {
                console.log(data); // this is good
                        if (data)
                {
                $('input[name=code]').val(data);
                }
                }
        });
        });
        $('#form_wizard_1 #country').on('change', function(){
var country = this.value;
        var baseurl = document.getElementById('baseurl').value;
        var dataString = 'country=' + country;
        $.ajax({
        url: baseurl + '/city/getCity',
                type: "get",
                data: dataString,
                success: function(data)
                {
                $('select[name="city"]').attr('class', 'bs-select form-control');
                        $('select[name="city"]').empty();
                        if (data == "")
                {
                var empty = "عفوا لا يوجد مدن لهذه الدولة حاليا !";
                        $("#city").html('<option selected disabled>' + empty + '</option>');
                }
                else
                {
                $.each(data, function(i, val)
                {
                $('select[name="city"]').append("<option value=" + val.id + ">" + val.name + "</option>");
                });
                }
                $('select[name="city"]').selectpicker('refresh');
                }


        });
        });
        $('#issue_date').change(function(){
var issue_date = document.getElementById("issue_date").value;
        var fullDate = new Date()
        //Thu May 19 2011 17:25:38 GMT+1000 {}
        //convert month to 2 digits
        var twoDigitMonth = ((fullDate.getMonth().length + 1) === 1)? (fullDate.getMonth() + 1) : '0' + (fullDate.getMonth() + 1);
        var currentDate = fullDate.getDate() + "/" + twoDigitMonth + "/" + fullDate.getFullYear();
        //19/05/2011

        currentDate = new Date(currentDate.split('/')[2], currentDate.split('/')[1] - 1, currentDate.split('/')[0]);
        issue_date = new Date(issue_date.split('/')[2], issue_date.split('/')[1] - 1, issue_date.split('/')[0]);
        var timeDiff = Math.abs(currentDate.getTime() - issue_date.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
        diffDays = '-' + diffDays + 'd';
        // $("#expire_date").attr("data-date-start-date", diffDays);
        //alert(diffDays);
        $('#expire_date').datepicker({
format: 'dd/mm/yyyy',
        startDate: issue_date,
});
        $("#expire_date").val(document.getElementById("issue_date").value);
        $('#expire_date').datepicker("update");
});
        $('#license_issue_date').change(function(){
var issue_date = document.getElementById("license_issue_date").value;
        var fullDate = new Date()
        //Thu May 19 2011 17:25:38 GMT+1000 {}
        //convert month to 2 digits
        var twoDigitMonth = ((fullDate.getMonth().length + 1) === 1)? (fullDate.getMonth() + 1) : '0' + (fullDate.getMonth() + 1);
        var currentDate = fullDate.getDate() + "/" + twoDigitMonth + "/" + fullDate.getFullYear();
        //19/05/2011

        currentDate = new Date(currentDate.split('/')[2], currentDate.split('/')[1] - 1, currentDate.split('/')[0]);
        issue_date = new Date(issue_date.split('/')[2], issue_date.split('/')[1] - 1, issue_date.split('/')[0]);
        var timeDiff = Math.abs(currentDate.getTime() - issue_date.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
        diffDays = '-' + diffDays + 'd';
        // $("#expire_date").attr("data-date-start-date", diffDays);
        //alert(diffDays);
        $('#license_expire_date').datepicker({
format: 'dd/mm/yyyy',
        startDate: issue_date,
});
        $("#license_expire_date").val(document.getElementById("license_issue_date").value);
        $('#license_expire_date').datepicker("update");
});
        });
        function SendEmailGroup()
        {
        var checkedValue = [];
                var inputElements = document.getElementsByClassName('client_selected');
                for (var i = 0; inputElements[i]; ++i)
        {
        if (inputElements[i].checked)
        {
        checkedValue.push(inputElements[i].value);
        }
        }

        if (checkedValue.length > 0)
        {
        var baseurl = document.getElementById('baseurl').value;
                $.ajax({
                url:  baseurl + '/admin/clients/get/group_email',
                        type: 'GET',
                        data: {checkedValue},
                        success : function(data){
                        console.log(data);
                                window.location.href = baseurl + "/admin/clients/send/group_email?emails=" + data;
                        },
                        error : function(e){
                        console.log(e);
                        }
                });
        }
        else
        {
        alert("يجب اختيار العملاء اولا !");
        }
        }

function SendSmsGroup()
        {
        var checkedValue = [];
                var inputElements = document.getElementsByClassName('client_selected');
                for (var i = 0; inputElements[i]; ++i)
                {
                if (inputElements[i].checked)
                        {
                        checkedValue.push(inputElements[i].value);
                                }
                }

        if (checkedValue.length > 0)
                {

                var baseurl = document.getElementById('baseurl').value;
                        $.ajax({
                        url:  baseurl + '/admin/clients/get/group_sms',
                                type: 'GET',
                                data: {checkedValue},
                                success : function(data){
                                console.log(data);
                                        window.location.href = baseurl + "/admin/clients/send/group_sms?numbers=" + data;
                                },
                                error : function(e){
                                console.log(e);
                                }
                        });
                        }
        else
                {
                alert("يجب اختيار العملاء اولا !");
                        }
        }


// get country Code
$('#country').on('change', function(){

var country = this.value;
        var baseurl = document.getElementById('baseurl').value;
        var dataString = 'country=' + country;
        $.ajax({
        url: baseurl + '/clients/getCode',
                type: "get",
                data: dataString,
                success: function (data)
                {
                console.log(data); // this is good
                        if (data)
                {
                $('input[name=code]').val(data);
                }
                }
        });
        });
        $('#order_type').on('change', function(){
var order_type = this.value;
        var baseurl = document.getElementById('baseurl').value;
        var dataString = 'order_type=' + order_type;
        $.ajax({
        url: baseurl + '/instructions/get_type',
                type: "get",
                data: dataString,
                success: function(data)
                {
                console.log(data);
                        $('#instruction_data').empty();
                        if (data == "")
                {

                }
                else
                {
                $.each(data, function(i, val)
                {
                var inst_data = '<tr class="text-center">' +
                        '<td>' + i + '</td>' +
                        '<td>' + val.title + '</td>' +
                        '<td>' + val.type + '</td>' +
                        '<td>' + val.country + '</td>' +
                        '<td>' + val.city + '</td>' +
                        '<td> <a href=" ' + baseurl + val.file + ' " target="_blank">معاينة الملف</a> </td>' +
                        '<td>' + val.notes + '</td>' +
                        '<td><a href=" ' + baseurl + '/admin/instructions/' + val.id + '/edit "><i class="fa fa-edit"></i></a></td>' +
                        '<td><a href="' + baseurl + '/admin/instructions/delete_instruction/' + val.id + '" onclick="return confirmDelete();" >حذف</a></td>' +
                        '<td><a href=" ' + baseurl + '/admin/instructions/' + val.id + '"><i class = "fa fa-eye"></i></a></td>' +
                        '< /tr>';
                        $('#instruction_data').append(inst_data);
                });
                }
                }
        });
        });
        function getSections()
        {
        var company_id = $('#companyID').val();
                var baseUrl = $('#baseurl').val();
                var dataString = 'company_id=' + company_id;
                $.ajax({
                url  : baseUrl + '/company/getSections',
                        type : "get",
                        data : dataString,
                        success:function(data)
                        {
                        console.log(data);
                                if (data)
                        {
                        $('#sections').empty();
                                $.each(data, function(i, val)
                                {
                                var edit_company = '<a href="' + baseUrl + '/admin/companySection/' + val.id + '/edit">تعديل</a>';
                                        var delete_company = '<a href="' + baseUrl + '/admin/company/delete_section/' + val.id + '" onclick="return confirmDelete();" >حذف</a>';
                                        var result = '<tr class="odd gradeX"><td>' + val.id + '</td><td>' + val.company_name.name + '</td><td>' + val.sectionName + '</td><td>' + edit_company + '|' + delete_company + '</td></td>';
                                        $('#sections').append(result);
                                });
                        }
                        }
                });
        }

function getTravelOffice()
        {
        var officeID = $('#officeID').val();
                var baseUrl = $('#baseurl').val();
                var dataString = 'officeID=' + officeID;
                $.ajax({
                url  : baseUrl + '/getAjax/getTravelOffice',
                        type : "get",
                        data : dataString,
                        success:function(data)
                        {
                        //console.log(data);
                        if (data)
                        {
                        $('#sections').empty();
                                $.each(data, function(i, val)
                                {
                                var edit_company = '<a href="' + baseUrl + '/admin/travel_sections/' + val.id + '/edit">تعديل</a>';
                                        var delete_company = '<a href="' + baseUrl + '/admin/travel_sections/delete_section/' + val.id + '" onclick="return confirmDelete();" >حذف</a>';
                                        var result = '<tr class="odd gradeX"><td>' + val.id + '</td><td>' + val.office_name.name + '</td><td>' + val.sectionName + '</td><td>' + val.mobile + '</td><td>' + val.phone + '</td><td>' + val.email + '</td><td>' + edit_company + '|' + delete_company + '</td></td>';
                                        $('#sections').append(result);
                                        console.log(result);
                                });
                        }
                        }
                });
                }


function confirmDelete()
        {
        return confirm('هل انت متأكد من عملية الحذف ?');
                }

$(document).on('change', 'select[id="partner_employee"]', function (event) {
var employee = $(this);
        $.ajax({
        url: $('#base_url').val() + '/partner/get_employee',
                data: {emp_id: employee.val()},
        })
        .done(function (data) {
        if (data == 0)
        {
        $('#partner_employee_info').hide()
        } else
        {

        $.each(data, function(i, val)
        {
        $('#partner_employee_info').show();
                $('#partner_employee_info').addClass('well');
                $('#partner_employee_info').html(" <br>اسم الموظف:" + val.name + "<br>الجوال: " + val.mobile + "<br>البريد الالكترونى: " + val.email + "<br>الهاتف: " + val.phone);
        });
        }
        })
        });
// date input mask
        $(document).ready(function($){
$('#birth_date').mask("99/99/9999", {placeholder: 'MM/DD/YYYY' });
        $('#issue_date').mask("99/99/9999", {placeholder: 'MM/DD/YYYY' });
        $('#expire_date').mask("99/99/9999", {placeholder: 'MM/DD/YYYY' });
        $('#license_issue_date').mask("99/99/9999", {placeholder: 'MM/DD/YYYY' });
        $('#license_expire_date').mask("99/99/9999", {placeholder: 'MM/DD/YYYY' });
        $('#vacation_start').mask("99/99/9999", {placeholder: 'MM/DD/YYYY' });
        $('#vacation_end').mask("99/99/9999", {placeholder: 'MM/DD/YYYY' });
        });
        // ==========================================  companyOrder ===================================================





        // ==========================================  Busses Handing ===================================================
// get Driver Information
        var driverID = document.getElementById('driverID'),
        driverName = document.getElementById('driverName');
        if (driverID){ // if element is not null
driverID.onchange = function()
{
'use strict';
        $.ajax({
        url: $('#base_url').val() + '/getDriverInformation',
                data: {id: this.value},
        })
        .done(function (data) {
        document.getElementById('driverInfo').style.display = 'block';
                driverName.innerHTML = data.name;
                age.innerHTML = data.age;
                cardNumber.innerHTML = data.card_number;
                driverImage.src = $('#base_url').val() + data.photo;
        })
        .fail(function () {
        console.log("error");
        })
        .always(function () {
        console.log("complete");
        });
};
}
// get Bus Information
var license_number = document.getElementById('license_number'),
        size = document.getElementById('size'),
        color = document.getElementById('color'),
        model = document.getElementById('model');
        busID = document.getElementById('busID');
        if (busID){ // if element is not null
busID.onchange = function()
        {
        'use strict';
                $.ajax({
                url: $('#base_url').val() + '/getBusInformation',
                        data: {id: this.value},
                })
                .done(function (data) {
                document.getElementById('busInfo').style.display = 'block';
                        license_number.innerHTML = data.license_number;
                        model.innerHTML = data.model;
                        size.innerHTML = data.size;
                        color.innerHTML = data.color;
                })
                .fail(function () {
                console.log("error");
                })
                .always(function () {
                console.log("complete");
                });
                };
        }





// ==========================================  Busses Reservations ===================================================
// get Client Information
var clientID = document.getElementById('clientID'),
        clientImage = document.getElementById('clientImage');
        if (clientID){ // if element is not null
clientID.onchange = function(){
'use strict';
        $.ajax({
        url: $('#base_url').val() + '/clients/getClientInfo',
                data: {client_id: this.value},
        })
        .done(function (data) {
        document.getElementById('clientInfo').style.display = 'block';
                mother_name.innerHTML = data.mother_name;
                email_address.innerHTML = data.email_address;
                birth_date.innerHTML = data.birth_date;
                clientImage.src = $('#base_url').val() + data.photo;
        })
        .fail(function () {
        console.log("error");
        })
        .always(function () {
        console.log("complete");
        });
};
}


// ==========================================  Get  City Arrival  ===================================================
$('#countryArrival').on('change', function(){
var country = this.value;
        var baseurl = document.getElementById('baseurl').value;
        var dataString = 'country_code=' + country;
        $.ajax({
        url: baseurl + '/city/getCity',
                type: "get",
                data: dataString,
                success: function(data)
                {
                $('#cityArrival').empty();
                        if (data == "")
                {
                var empty = "لا يوجد مدن فى هذه الدولة";
                        $("#cityArrival").html('<option selected disabled>' + empty + '</option>');
                }
                else
                {
                $.each(data, function(i, val)
                {
                $('#cityArrival').append("<option value=" + val.id + ">" + val.name + "</option>");
                });
                }
                $('#cityArrival').selectpicker('refresh');
                }
        });
        });
// ==========================================  Get  City Departure  ===================================================
        $('#countryDeparture').on('change', function(){
var country = this.value;
        var baseurl = document.getElementById('baseurl').value;
        var dataString = 'country_code=' + country;
        $.ajax({
        url: baseurl + '/city/getCity',
                type: "get",
                data: dataString,
                success: function(data)
                {
                $('#cityDeparture').empty();
                        if (data == "")
                {
                var empty = "لا يوجد مدن فى هذه الدولة";
                        $("#cityDeparture").html('<option selected disabled>' + empty + '</option>');
                }
                else
                {
                $.each(data, function(i, val)
                {
                $('#cityDeparture').append("<option value=" + val.id + ">" + val.name + "</option>");
                });
                }
                $('#cityDeparture').selectpicker('refresh');
                }
        });
        });
        // ==========================================  Get  City Branch  ===================================================
        $('#countryBranch').on('change', function(){
var country = this.value;
        var baseurl = document.getElementById('baseurl').value;
        var dataString = 'country_code=' + country;
        $.ajax({
        url: baseurl + '/city/getCity',
                type: "get",
                data: dataString,
                success: function(data)
                {
                $('#cityBranch').empty();
                        if (data == "")
                {
                var empty = "لا يوجد مدن فى هذه الدولة";
                        $("#cityBranch").html('<option selected disabled>' + empty + '</option>');
                }
                else
                {
                $.each(data, function(i, val)
                {
                $('#cityBranch').append("<option value=" + val.id + ">" + val.name + "</option>");
                });
                }
                $('#cityBranch').selectpicker('refresh');
                }
        });
        });
// ==========================================  Get  City  ===================================================
        $('#country').on('change', function(){

var country = this.value;
        var baseurl = document.getElementById('baseurl').value;
        var dataString = 'country_code=' + country;
        $.ajax({
        url: baseurl + '/city/getCity',
                type: "get",
                data: dataString,
                success: function(data)
                {
                $('#cities').empty();
                        if (data == "")
                {
                var empty = "لا يوجد مدن فى هذه الدولة";
                        $("#cities").html('<option selected disabled>' + empty + '</option>');
                }
                else
                {
                $.each(data, function(i, val)
                {
                $('#cities').append("<option value=" + val.id + ">" + val.name + "</option>");
                });
                }
                $('#cities').selectpicker('refresh');
                }
        });
        });
        // ==========================================  Get  Busses Supplier  ===================================================
        $('#branch_id').on('change', function(){
var baseurl = document.getElementById('baseurl').value;
        var dataString = 'branch_id=' + this.value;
        $.ajax({
        url: baseurl + '/getSupplier',
                type: "get",
                data: dataString,
                success: function(data)
                {
                console.log(data);
                        $('#supplier_id').empty();
                        if (data == "")
                {
                var empty = "لا يوجد مزودين  فى هذا الفرع";
                        $("#supplier_id").html('<option selected disabled>' + empty + '</option>');
                }
                else
                {
                $('#supplier_id').append("<option value=''>اختر المزود ...</option>");
                        $.each(data, function(i, val)
                        {
                        $('#supplier_id').append("<option value=" + val.id + ">" + val.name + "</option>");
                        });
                }
                $('#supplier_id').selectpicker('refresh');
                }
        });
        });
        // ==========================================  Get  Busses By Supplier ID  ===================================================
        $('#supplier_id').on('change', function(){
var baseurl = document.getElementById('baseurl').value;
        var dataString = 'supplier_id=' + this.value;
        $.ajax({
        url: baseurl + '/getBusses',
                type: "get",
                data: dataString,
                success: function(data)
                {
                console.log(data);
                        $('#bus_id').empty();
                        if (data == "")
                {
                var empty = "لا يوجد باصات تابعة لهذا المزود";
                        $("#bus_id").html('<option selected disabled>' + empty + '</option>');
                }
                else
                {
                $('#bus_id').append("<option value=''>اختر رقم الباص ...</option>");
                        $.each(data, function(i, val)
                        {
                        $('#bus_id').append("<option value=" + val.id + ">" + val.number + "</option>");
                        });
                }
                $('#bus_id').selectpicker('refresh');
                }
        });
        });
// ==========================================  Get Date Arrival ===================================================

        function getDateArrival()
        {
        "use strict";
                var date_takeoff = document.getElementById('date_takeoff').value;
                if (date_takeoff){
        var dayNumbers = document.getElementById('dayNumbers').value;
                var new_date = moment(date_takeoff, "DD-MM-YYYY").add('days', dayNumbers);
                var day = new_date.format('DD');
                var month = new_date.format('MM');
                var year = new_date.format('YYYY');
                var $date_arrival = $('#date_arrival');
                $date_arrival.datepicker();
                $date_arrival.datepicker('setDate', day + '/' + month + '/' + year);
        }

        }


// ============ =====================================================

$('#addNewُEmail').click(function(event){ $('#newEmail').append('<div class="form-group"><label class="control-label col-md-3"><span class="required"></span></label><div class="col-md-7"><input type="text" name="emails[]" placeholder="بريد الكتروني اخر" class="form-control"></div></div>'); });

        $('#addNewMobile').click(function(event){$('#newMobile').append('<div class="form-group"><label class="control-label col-md-3"><span class="required"></span></label><div class="col-md-7"><input type="text" name="mobiles[]" placeholder="رقم جوال اخر" class="form-control"></div></div>'); });

        $('#addOtherMobile').click(function(event){$('#newMobile').append('<div class="form-group"><label class="control-label col-md-3"><span class="required"></span></label><div class="col-md-7"><input type="text" name="mobiles[]" placeholder="رقم جوال اخر" class="form-control"></div></div>'); });

        $('#addNewPhone').click(function(event){$('#newPhone').append('<div class="form-group"><label class="control-label col-md-3"><span class="required"></span></label><div class="col-md-7"><input type="text" name="phones[]" placeholder="رقم هاتف اخر" class="form-control"></div></div>'); });

        $('#addNewFax').click(function(event){$('#newFax').append('<div class="form-group"><label class="control-label col-md-3"><span class="required"></span></label><div class="col-md-7"><input type="text" name="faxs[]" placeholder="فاكس اخر" class="form-control"></div></div>'); });