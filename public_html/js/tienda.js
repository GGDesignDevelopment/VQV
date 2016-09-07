var usuario = (function(){

	// Cache DOM 
	var $boton = $('#login');
	var $carrito = $('#carrito');
	var $contenedor = $('.contenedor');
	// Contenido html boton principal
	var islog = 'Mi Carrito <span>&#xe015;</span>';
	var notlog = 'Iniciar / Registrarse';
	// Templates MUSTACHE para render 
	var loginValue = $carrito.find('#loginForm').html();
	var carritoTemplate = $carrito.find('#carritoTemplate').html();
	// Mensajes
	var succesMsg = '<span clas="succesMsg">Su compra ha sido realizada con exito. Le hemos enviado un mensaje a su correo electronico con los detalles de la misma. </span>'


	// Bind Events
	$carrito.on('submit', '#ingresar', _login);
	$carrito.on('submit', '#registrarse', _register);
	$carrito.on('click', '#logout', _logout);
	$carrito.on('submit', '#confirmar', _confirmar);
	$boton.on('click', showCart);
	$carrito.on('click', '#ocultar', _hideCart);


	function render() {
		if ( _isLogged() == true ) {
			$boton.html(islog);
			$.ajax({
				type: 'GET',
				url: 'cart/get',
				dataType: 'json',
				success: function(json){
					$.each(json.items, function(i, obj) {
						obj.amount = Math.round(obj.amount * 100) / 100;
					})
					$carrito.html(Mustache.render(carritoTemplate, json));
				}
			})
		} else {
			$boton.html(notlog);
			$carrito.html(loginValue);
		}
	};

	render();

	// Checkear si hay un usuario loggeado
	function _isLogged() {
		var control = null;
		$.ajax({
			async: false,
			type: 'GET',
			url: 'cart/islogged',
			dataType: 'json',
			success: function(json) {
				control = json.msg;
			}
		});
		return control;
	};

	function _login(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'cart/login',
			data: $(this).serialize(),
			dataType: 'json',
			success: function(json){
				render();
			},
		});
	};
	

	function _register(e) {
		$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: $(this).serialize(),
				dataType: 'json',
				success: function(){
					render();
				}
		});
		e.preventDefault();
	};

	function _logout() {
		$.ajax({
			type: 'GET',
			url: 'cart/logout',
			success: function(){
				render();
			}
		})
	}

	function _confirmar(e) {
		e.preventDefault()
		$.ajax({
			type: 'POST',
			url: 'cart/confirm',
			success: function() {
				render();
				$carrito.append(succesMsg);
			}
		})
	}
	function showCart() {
		var estado = $carrito.css('display');
		if($(window).width() <= 768) {
			if (estado=='none') {
				$contenedor.css('display', 'none');
				$carrito.animate({width: '100%;'});
				$carrito.css('display', 'flex');
			}
		} else {
			if ( estado == 'none') {
				$contenedor.animate({width: '80%'}, function() {
				$carrito.css('display', 'flex');
				})
			} else {
				$carrito.css('display', 'none');
				$contenedor.animate({width: '100%'});
			}
		}
	}
	function _hideCart() {
		$carrito.css('display', 'none');
		$contenedor.css('display', 'flex');
		$contenedor.animate({width: '100%'});
	}

	return {
		islogged: _isLogged,
		render: render,
		carrito: $carrito,
		showCart: showCart
	}
})();

var productos = function() {

	// Cache DOM
	var $productos = $('.productos');
	var $carrito = usuario.carrito;
	var $botonera = $('#filtro'); 
	var $producto = $('.productos');
	var prodTemplate = $('#prodTemplate').html();
	var prodTemplateMovil = $('#prodTemplateMovil').html();
	var itemTemplate = $('#carritoItem').html();
	var errorLogMsg = '<span class="errorMsg">Debes iniciar sesion o registrarte para poder realizar tu compra exitosamente. </span>'

	// Bind Events 
	$productos.on('click', '#leftCon', _expandirItemMovil);
	$productos.on('submit', '.addItem', _addItem);
	$productos.on('change', '.cant', _calcPrice);
	$botonera.on('click', '.filter', _render);
	$producto.on('click', '.expandir', _expandirItem);
	$carrito.on('change', '#dir', _modifyAddress);
	$carrito.on('change', '.quantity', _modifyItem);
	$carrito.on('click', '.remove', _deleteItem);



	_render(0);

	function _clearVal(id) {
		$('#form '+id+'input[type=number]').val('');
	};

	function _addItem(e) {
		var logged = usuario.islogged();
		if ( logged == true ) {
			$.ajax({
				type: 'POST',
				url: 'cart/addItem',
				data: $(this).serialize(),
				dataType: 'json',
				success: function(){
					usuario.render();
					_clearVal($(this).attr('id'));
				},
			});
		} else {
			e.preventDefault();
			$carrito.append(errorLogMsg);
			usuario.showCart();
		}
	}

	function _render() {
		$productos.empty();
		var categoria = $(this).attr('data-categoria');
		$.ajax({
			type: 'GET',
			url: 'tienda/getProducts?catid='+categoria,
			dataType: 'json',
			success: function(json) {
				$.each(json, function(indice, obj) {
					switch(obj.produnidad) {
						case 'm': 
							obj.produnidad = 'ml.';
							break;
						case 'l':
							obj.produnidad = 'lt.';
							break;
						case 'g': 
							obj.produnidad = 'gr.';
							break;
						case 'k':
							obj.produnidad = 'kg.';
							break;
						case 'u':
							obj.produnidad = 'uni.';
							break;
						default: 
							obj.produnidad = 'uni.';
							break;
					}
					if($(window).width() <= 768) {
						$productos.append(Mustache.render(prodTemplateMovil, obj));
					} else {
						$productos.append(Mustache.render(prodTemplate, obj));
					}
				});

			}
		})  
	}
	
	function _expandirItem(e) {

		e.preventDefault()
		var $padre = $(this).parent();
		var id = $(this).attr('data-producto');


		$('#'+id).toggleClass("oculto");
		$(this).parent().toggleClass("active");
	}

	function _expandirItemMovil() {
		var id = $(this).attr('data-id');
		var $span = $(this).find('.'+id);
		$span.slideToggle();
	}

	function _modifyAddress() {
		$.ajax({
			type: 'POST',
			url: 'cart/updateAddress',
			data: $(this).serialize(),
			dataType: 'json',
			success: function(){
				// Funcion tooltip
			}
		})
	}

	function _modifyItem() {
		var prodId = $(this).attr('id');
		var quantity = $(this).attr('value');
		$.ajax({
			type: 'GET',
			url: 'cart/modifyitem/'+prodId+'/'+quantity,
			success: function() {
			}
		})
	}

	function _deleteItem(e) {
		e.preventDefault();
		var id = $(this).attr('id');
		$.ajax({
			type: 'POST',
			url: 'cart/removeItem/'+id,
			success: function() {
				usuario.render();
			}
		})
	}

	function _calcPrice() {
		var presentacion = $(this).attr('data-presentacion');
		var precio = $(this).attr('data-precio');
		var cantidad = $(this).val();
		var id = $(this).attr('data-id');
		var sub = ( cantidad / presentacion ) * precio;
		var cadena = '$u. ' + sub + '- Agregar al carrito';
		$('.'+id).val(cadena); 
		// alert(cadena);
	}

}();
