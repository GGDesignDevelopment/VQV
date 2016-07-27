$(function () {
    // Funcion para expandir el item producto.
    $('.productos').delegate('.expandir', 'click', function(e) {
        e.preventDefault();
        var producto = $(this).attr('data-producto');
        alert(producto);
        $('#'+producto).slideToggle();
        $(this).toggleClass("fondo");
    });

    // Funcion para mostrar el carrito de compras
    var $boton_carrito = $('#carrito_show');
    var $contenedor = $('.contenedor');
    var $carrito = $('#carrito');
    

    $boton_carrito.on('click', function() {
        var estado = $carrito.css('display');
        if ( estado == 'none') {
            $contenedor.animate({width: '80%'}, function() {
                $carrito.css('display', 'flex');
            })
        } else {
            $carrito.css('display', 'none');
            $contenedor.animate({width: '100%'});
        }
    });



    // Funcion dibujado y filtro de productos en AJAX

    var producto = $('#prodTemplate').html();

    function dibujar(categoria) {
        $.ajax({
            type: 'GET',
            url: 'tienda/getProducts?catid='+categoria,
            dataType: 'json',
            success: function(json) {
                var i = 1;
                $.each(json, function(indice, obj) {
                    $('#col'+i).append(Mustache.render(producto, obj));
                    i = (i == 3 ? 1 : i + 1);
                });
            }
        })  
    };
    
    // inicializa con todos los productos
    dibujar(0);
    
    var $boton = $('#filtro a');

    $boton.on('click', function(e){
        var categoria = $(this).attr('data-categoria');
        $('#col1').empty();
        $('#col2').empty();
        $('#col3').empty();
        dibujar(categoria);
    });

});