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
	var succesMsg = '<span classs="succesMsg">Su compra ha sido realizada con exito. Le hemos enviado un mensaje a su correo electronico con los detalles de la misma. </span>'
	var errorMsg = '<span class="errorMsg">Debe tener items seleccionados para realizar su compra</span>'

	// Bind Events
	$carrito.on('submit', '#ingresar', _login);
	$carrito.on('submit', '#registrarse', _register);
	$carrito.on('click', '#logout', _logout);
	$carrito.on('submit', '#confirmar', _confirmar);
	$boton.on('click', showCart);
	$carrito.on('click', '#ocultar', _hideCart);
	$carrito.on('change', '.valorCompra', _updatePrice);


	function render() {
		if ( _isLogged() == true ) {
			$boton.html(islog);
			$.ajax({
				type: 'GET',
				url: 'cart/get',
				dataType: 'json',
				success: function(json){
					$.each(json.items, function(i, obj) {
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
						if ( obj.prodgranel == 1 ) {
							obj.cuenta = obj.prodprecio / obj.prodpresentacion;
							obj.proddisplay = '';
						} else {
							obj.quantity /= obj.prodpresentacion;
							obj.proddisplay = 'x '+obj.prodpresentacion;
							obj.cuenta = obj.prodprecio;
							obj.prodpresentacion = 1;
						}
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
			dataType: 'json',
			success: function(json) {
				if ( json.msg ) {
					render();
					$carrito.append(succesMsg);
				} else {
					$carrito.append(errorMsg);
				}
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
	function _updatePrice() {
		var precio = $(this).attr('data-precio');
		var cantidad = $(this).val();
		var id = $(this).attr('id');
		var sub = precio * cantidad;
		$('.'+id).html('$u.'+sub);
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
	var $tabs = $('#tabs');
	var $producto = $('.productos');
	var prodTemplate = $('#prodTemplate').html();
	var prodTemplateMovil = $('#prodTemplateMovil').html();
	var itemTemplate = $('#carritoItem').html();
	var errorLogMsg = '<span class="errorMsg">Debes iniciar sesion o registrarte para poder realizar tu compra exitosamente. </span>'

	var errorCountLog = false;
	// Bind Events
	$productos.on('click', '#leftCon', _expandirItemMovil);
	$productos.on('submit', '.addItem', _addItem);
	$productos.on('change', '.cant', _calcPrice);
	$botonera.on('click', '.filter', _render);
	$tabs.on('click', '.tab', _renderTabs);
	$producto.on('click', '.top', _expandirItem);
	$carrito.on('change', '#dir', _modifyAddress);
	$carrito.on('change', '.quantity', _modifyItem);
	$carrito.on('click', '.remove', _deleteItem);



	_render(0,0,1);

	function _clearVal(id) {
		$('#form '+id+'input[type=number]').val('');
	};

	function _addItem(e) {
		var logged = usuario.islogged();
		var estado = usuario.carrito.css('display');
		if ( logged == true ) {
			$.ajax({
				type: 'POST',
				url: 'cart/addItem',
				data: $(this).serialize(),
				dataType: 'json',
				success: function(){
					_clearVal($(this).attr('id'));
					usuario.render();
				},
				error: function() {
					alert('error');
				}
			});
			if (estado=='none') {
				usuario.showCart();
			}
			e.preventDefault();
		} else {
			e.preventDefault();
			if ( errorCountLog ) {
				if ( estado == 'none') {
					usuario.showCart();
				}
			} else {
				$carrito.append(errorLogMsg);
				errorCountLog = true;
				if ( estado == 'none') {
					usuario.showCart();
				}
			}
		}
	}
	function _renderTabs() {
		var granel = $(this).attr('data-tab');
		switch (granel) {
				case '0':
						$botonera.find('.granel').removeClass('active');
						$botonera.find('.naturales').removeClass('active');
						_render(0,0,1);
						break;
				case '1':
						$botonera.find('.granel').toggleClass('active');
						$botonera.find('.naturales').removeClass('active');
						_render(1,0,0);
						break;
				case '2':
						$botonera.find('.naturales').toggleClass('active');
						$botonera.find('.granel').removeClass('active');
						_render(0,0,0);
						break;
		}
	}

	function _render(a,b,c) {
		$productos.empty();

		var categoria = ((b != null) ? b : $(this).attr('data-categoria'));
		var granel = $(this).attr('data-granel');


		$(this).parent().find('.selected').toggleClass('selected');
		$(this).toggleClass('selected');
		if ( c == 1 ) {
				$.ajax({
			type: 'GET',
			url: 'tienda/getProducts?catid='+categoria+'&inicio=1',
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
					if ( obj.prodgranel == 1 ) {
						obj.cuenta = obj.prodprecio / obj.prodpresentacion;
						obj.proddisplay = '';
					} else {
						obj.proddisplay = 'x '+obj.prodpresentacion;
						obj.cuenta = obj.prodprecio;
						obj.prodpresentacion = 1;
					}
					if($(window).width() <= 768) {
						$productos.append(Mustache.render(prodTemplateMovil, obj));
					} else {
						$productos.append(Mustache.render(prodTemplate, obj));
					}
				});

			}
		})
		} else {
			var direccion = 'tienda/getProducts?catid='+categoria.toString()+'&granel='+granel.toString();

				$.ajax({
			type: 'GET',
			url: direccion,
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
					if ( obj.prodgranel == 1 ) {
						obj.cuenta = obj.prodprecio / obj.prodpresentacion;
						obj.proddisplay = '';
					} else {
						obj.proddisplay = 'x '+obj.prodpresentacion;
						obj.cuenta = obj.prodprecio;
						obj.prodpresentacion = 1;
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

	}

	function _expandirItem(e) {
		e.preventDefault()
		var $padre = $(this).parent('.prod');
		var id = $(this).attr('data-producto');
		$('#'+id).toggleClass("oculto");
		$(this).toggleClass("active");
	}

	function _expandirItemMovil() {
		var id = $(this).attr('data-id');
		var $span = $productos.find('span.'+id);
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
				alert('hola');
			},
			error: function() {
				alert('chau');
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
		var precio = $(this).attr('data-precio');
		var cantidad = $(this).val();
		var id = $(this).attr('data-id');
		var sub = precio * cantidad;
		var cadena = '$u. ' + sub + '- Agregar al carrito';
		$('.'+id).val(cadena);
		// alert(cadena);
	}

}();
