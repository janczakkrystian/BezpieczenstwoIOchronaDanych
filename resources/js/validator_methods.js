$(document).ready(function() {

    $.validator.addMethod(
        'cyfry',
        function (value, element) {
            return /^\d+$/.test(value);
        },
        'Dozwolone są tylko cyfry.'
    );

    $.validator.addMethod(
        'password',
        function (value, element) {
            return /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&.\*\?])(?=.{8,})/.test(value);
        },
        'Wymagane jest przynajmniej 8 znaków, mała, wielka litera, cyfra oraz znak specjalny.'
    );

  

});