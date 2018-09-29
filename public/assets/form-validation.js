;(function(){

    var form     = $('#form');
    var error1   = $('.alert-danger', form);
    var success1 = $('.alert-success', form);

    form.validate({
       errorElement: 'span', 
       errorClass: 'help-block help-block-error', 
       focusInvalid: false,
       ignore: "", 
       messages: {
        select_multi: {
            maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
            minlength: jQuery.validator.format("At least {0} items must be selected")
        }
    },
    invalidHandler: function (event, validator) { 
        error1.show();
        App.scrollTo(error1, -200);
    },
    highlight: function (element) { 
        $(element)
        .closest('.form-group').addClass('has-error'); 
    },

    unhighlight: function (element) { 
        $(element)
        .closest('.form-group').removeClass('has-error'); 
    },
    success: function (label) {
        label.closest('.form-group').addClass('has-success'); 
        label.closest('.form-group').removeClass('has-error'); 
    },

    submitHandler: function (form) {
        error1.hide();
        form.submit();
    }
});
})();