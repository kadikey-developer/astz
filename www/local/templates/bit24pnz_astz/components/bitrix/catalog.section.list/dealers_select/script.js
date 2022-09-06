$(document).ready(function () {
    $("#city").chained("#country");

    /**
     * Перезагружаем страницу при выборе
     */
    /*$check = false;
    $('#country').change(function () {
        $check = true;
    });*/
    $('#city').change(function () {
        if ($(this).val() != null) {         
            window.location.href = $(this).val();
        }
    });
});