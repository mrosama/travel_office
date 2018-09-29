var FormValidation = function () {

    var handleValidation1 = function() {
        // http://docs.jquery.com/Plugins/Validation
        var form_partners = $('#form_partners');
        var error1 = $('.alert-danger', form_partners);
        var success1 = $('.alert-success', form_partners);

        form_partners.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }
                },
                rules: {
                    name: {
                        minlength: 2,
                        required: true
                    },
                    'email[]': {
                        required: true,
                    },
                    site_url: {
                        required: true,
                        url: true
                    },
                    mobile: {
                        required: true,
                        number: true
                    },
                    occupation: {
                        minlength: 5,
                    },
                    country: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    street: {
                        required: true
                    },
                    mail_box: {
                        required: true
                    },
                    fax: {
                        required: true,
                        number: true
                    },
                    skype: {
                        required: true,
                    },
                    twitter: {
                        required: true,
                    },
                    facebook: {
                        required: true,
                    },
                    other: {
                        required: true,
                    },
                    notes: {
                        required: true,
                    },
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                    },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                    },

                    success: function (label) {
                        label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                    },

                    submitHandler: function (form) {
                        success1.show();
                        error1.hide();
                        form.submit();
                    }
                });
    }


    return {
        //main function to initiate the module
        init: function () {
            handleValidation1();
        }

    };

}();

jQuery(document).ready(function() {
    FormValidation.init();
});