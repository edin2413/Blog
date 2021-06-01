$(document).ready(function () {
    APP.validacionGeneral('form-general');
    $('#icono').on('change', function () {
        $('#mostrar-icono').removeClass().addClass($(this).val())
    });
});
