$(function () {
    $('a[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1100);
                return false;
            }
        }
        ;
    });

});

$(function () {
    $('.responsive').click(function (event) {
        event.preventDefault();
        var posicion = $(this).attr('data-posicion');
        $('nav[data-posicion="' + posicion + '"').slideToggle();
        $('nav[data-posicion="' + posicion + '"').css('display', 'flex');

    });
    ;
    $('#formContacto').submit(function () {
        $('#overlay').show();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function (json) {
                $('#overlay h2').append(json.msg);
                $('#overlay select').append(json.options);
                $('#formContacto').get(0).setAttribute('action', 'home/guardar');
            }
        });
        return false;
    });
    
    $(".hexIn").click(function () {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("textoTecnica").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "home/texto_tecnica?id=" + $(this).data("tecnica"), true);
        xmlhttp.send();
    });
});


	