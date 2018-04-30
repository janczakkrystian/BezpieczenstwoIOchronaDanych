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
            return /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*\?])(?=.{8,})/.test(value);
        },
        'Wymagane jest przynajmniej 8 znaków, mała, wielka litera, cyfra oraz znak specjalny.'
    );

    $.validator.addMethod(
        'zakres',
        function (value, element) {
            return /^\w+$/.test(value);
        },
        'Dozwolone są małe i wielkie litery oraz cyfry.'
    );

    $.validator.addMethod(
        'litery',
        function (value, element) {
            return /^[A-Za-z]+$/.test(value);
        },
        'Dozwolone są małe i wielkie litery.'
    );

});