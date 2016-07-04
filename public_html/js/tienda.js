$(function () {
    $('.expandir').on('click', function () {
        var producto = $(this).attr('data-producto');
        $('#' + producto).slideToggle();
        $(this).parent().toggleClass("fondo");
    });
    $('.button').click(function () {
        if ($('.button').hasClass('checked')) {
            $('.button').removeClass('checked');
        }
        ;
        $(this).toggleClass("checked");
        var categoria = $(this).attr('data-categoria');
        
        // en lugar de lo que sigue, llamar al getProducts por ajax y cargar todos los productos en columnas
        $('div.prod').hide(0);
        if ($(this).attr('data-categoria') == "todos") {
            $('div.prod').show(800);
        } else {
            $('div[data-categoria="' + categoria + '"').show(800);
        }
    });
});