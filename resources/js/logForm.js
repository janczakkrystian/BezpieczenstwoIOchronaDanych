$(document).ready(function() {

    var ip;
    $.getJSON("http://jsonip.com", function (data) {
        ip = data.ip;
    });

    jQuery(function ($) {
        $('#logForm').on('click', function (e) {
            $('#IP').val(ip);
        });

        $('#accountAdd').on('click', function (e) {
            $('#IP').val(ip);
        });

        $('#accountEdit').on('click', function (e) {
            $('#IP').val(ip);
        });
    });
});