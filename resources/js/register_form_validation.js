$(document).ready(function() {

    $('#regForm').validate({
        rules: {
            FirstName: {
                required: true,
                minlength: 5,
                maxlength: 30,
                litery: true
            },
            LastName: {
                required: true,
                minlength: 5,
                maxlength: 100,
                litery: true
            },
            Email: {
                required: true,
                email: true
            },
            Login: {
                required: true,
                minlength: 5,
                maxlength: 100,
                zakres: true
            },
            Password: {
                required: true,
                minlength: 8,
                maxlength: 200,
                password: true
            },
            PasswordAgain: {
                required: true,
                minlength: 8,
                maxlength: 200,
                password: true,
                equalTo: "#Password"
            }
        },
        messages: {
            FirstName: {
                required: 'Pole wymagane',
                minlength: jQuery.validator.format("Pole musi zawierać minimum {0} znaki!"),
                maxlength: jQuery.validator.format("Pole musi zawierać maksimum {0} znaki!")
            },
            LastName: {
                required: 'Pole wymagane',
                minlength: jQuery.validator.format("Pole musi zawierać minimum {0} znaki!"),
                maxlength: jQuery.validator.format("Pole musi zawierać maksimum {0} znaki!")
            },
            Email: {
                required: 'Pole wymagane',
                minlength: jQuery.validator.format("Pole musi zawierać minimum {0} znaki!"),
                maxlength: jQuery.validator.format("Pole musi zawierać maksimum {0} znaki!"),
                email: "Proszę podać poprawny email!"
            },
            Login: {
                required: 'Pole wymagane',
                minlength: jQuery.validator.format("Pole musi zawierać minimum {0} znaki!"),
                maxlength: jQuery.validator.format("Pole musi zawierać maksimum {0} znaki!")
            },
            Password: {
                required: 'Pole wymagane',
                minlength: jQuery.validator.format("Pole musi zawierać minimum {0} znaki!"),
                maxlength: jQuery.validator.format("Pole musi zawierać maksimum {0} znaki!")
            },
            PasswordAgain: {
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