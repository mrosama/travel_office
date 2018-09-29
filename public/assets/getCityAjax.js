var country = document.getElementsByName("country")[0];
var bank_country = document.getElementsByName("bank_country")[0];

if (country != undefined)
    country.addEventListener('change', getCity);
if (bank_country != undefined)
    bank_country.addEventListener('change', getCity);

function getCity(element)
{
    if (this.name == "country")
        var city = document.getElementsByName('city')[0];
    else if (this.name == "bank_country")
        var city = document.getElementsByName('bank_city')[0];

    var country = this.value;
    $.ajax({
        url: $('#base_url').val() + '/city/getCity',
        data: {country: country},
    })
            .done(function (data) {

                //if country has no cities
                if (data.length == 0)
                {
                    city.options.length = 0;
                    city.options[0] = new Option("عفوا لا يوجد مدن بهذه الدولة");
                } else
                {
                    city.className = "bs-select form-control";
                    city.options.length = 0;
                    city.options[0] = new Option("من فضلك اختر مدينة");
                    data.forEach(function (val, index) {
                        city.options[city.length] = new Option(val.name, val.id);
                    });
                }
                $('select[name="city"]').selectpicker('refresh');
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });
}


