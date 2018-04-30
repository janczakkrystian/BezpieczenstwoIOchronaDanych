$(document).ready(function() {

    jQuery.validator.addMethod("notEqual", function(value, element, param) {
        return this.optional(element) || value != $(param).val();
    }, "Nowe hasło musi się różnić od starego!");

    $('#changePasswordForm').validate({
        rules: {
            OldPassword: {
                required: true,
                minlength: 8,
                maxlength: 200,
                password: true
            },
            NewPassword: {
                required: true,
                minlength: 8,
                maxlength: 200,
                password: true,
                notEqual: "#OldPassword"
            },
            NewPasswordAgain: {
                required: true,
                minlength: 8,
                maxlength: 200,
                password: true,
                equalTo: "#NewPassword"
            }
        },
        messages: {
            OldPassword: {
                required: 'Pole wymagane',
                minlength: jQuery.validator.format("Pole musi zawierać minimum {0} znaki!"),
                maxlength: jQuery.validator.format("Pole musi zawierać maksimum {0} znaki!")
            },
            NewPassword: {
                required: 'Pole wymagane',
                minlength: jQuery.validator.format("Pole musi zawierać minimum {0} znaki!"),
                maxlength: jQuery.validator.format("Pole musi zawierać maksimum {0} znaki!")
            },
            NewPasswordAgain: {
                required: 'Pole wymagane',
                minlength: jQuery.validator.format("Pole musi zawierać minimum {0} znaki!"),
                maxlength: jQuery.validator.format("Pole musi zawierać maksimum {0} znaki!"),
                equalTo: jQuery.validator.format("Wartości muszą być takie same!")
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass(errorClass).addClass(validClass);
        },
        errorClass: 'has-error',
        validClass: 'has-success',
        invalidHandler: function(event, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                var message = errors == 1
                    ? 'Nie wypełniono poprawnie 1 pola. Zostało podświetlone'
                    : 'Nie wypełniono poprawnie ' + errors + ' pól. Zostały podświetlone';
                $("div.alert-danger").html(message);
                $("div.alert-danger").show();
            } else {
                $("div.alert-danger").hide();
            }
        },
        submitHandler: function(form) {
            $("div.alert-danger").text('');
            $("div.alert-danger").hide();
            event.submit();
        }
    });

});