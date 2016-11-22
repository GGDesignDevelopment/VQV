paginaGlobal = 1;
categoriaGlobal = 0;
inicioGlobal = 1;
granelGlobal = 0;
nroProductosGlobal = 15;
var usuario = (function () {
	//Cache DOM
	var $login = $('#boton');
			$loginContainer = $login.parent('nav');
			$loginForm = $('#login');
			loginHelper = $('#loginTemplate').html();
			botonCarrito = $loginContainer.html();
	
	//Bind Events
	$login.on('click', _render);
	$loginContainer.on('submit', '#login', _register);
	
	//Funcion para checkear si el usuario esta loggeado
	function _isLogged() {
		var control = null;
		$.ajax({
			async: false,
			type: 'GET',
			url: 'http://vqv/cart/islogged',
			dataType: 'json',
			success: function (json) {
				control = json.msg;
			}
		});
		return control;
	};
	
	function _render(e) {
		if ( !_isLogged() ) {
			$loginContainer.html(loginHelper);
			e.preventDefault();
		} 
	}
	
	function _register(e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'http://vqv/cart/login',
			data: $(this).serialize(),
			dataType: 'json',
			success: function (json) {
				if (json.msg) {
					$loginContainer.html(botonCarrito);
				} else {
					$(location).attr('href', 'http://vqv/tienda/carrito?login=true');
				}
			},
		});
	}
	
	return {
		isLogged: _isLogged
	};
	
})();

var productos = (function() {
	// Cache DOM
	var $productos = $('#productos');
	var $botonera = $('#filtro');
	var $tabs = $('#tabs');
	var $search = $tabs.find('#searchItem');
	var $searchBox = $tabs.find('div.search');
	var $producto = $('.productos');
	var prodTemplate = $('#prodTemplate').html();
	var prodTemplateMovil = $('#prodTemplateMovil').html();
	//Variables para primera carga
	
	arrayInicio = [1, 0, 0, 1, 15];

	// Bind Events
	$productos.on('click', '#leftCon', _expandirItemMovil);
	$productos.on('submit', '.addItem', _addItem);
	$productos.on('change', '.cant', _calcPrice);
	$botonera.on('click', '.filter', _getData);
	$tabs.on('click', '.tab', _getData);
	$searchBox.on('click', '.search', _searchItem);
	$searchBox.on('keyup', '#searchItem', _searchItem);
	$(window).bind('mousewheel DOMMouseScroll', _lazyLoad);
	
	_getProducts(arrayInicio);
	
	//Levanta los datos para filtrar los productos
	function _getData(e) {
		var filter = $(this).data('filter');
		var	active = false;
		var	$activeTab = $(this);
		var	inicio = filter[0];
				inicioGlobal = filter[0];
		var	categoria = filter[1];
				categoriaGlobal = categoria;
		var	granel = filter[2];
				granelGlobal = granel;
		var	tab = (inicio == 1 ? 0 : (granel == 1 ? 1 : 2));
				filter[4] = 15;
		if (filter[3]) {
			if (!$activeTab.hasClass('active')) {
				$tabs.find('.active').removeClass('active');
				$activeTab.addClass('active');
				active = true;
			}
			_renderTabs(tab, active);
		} else {
			if (!$activeTab.hasClass('active')) {
				$botonera.find('a.active').removeClass('active');
				$activeTab.addClass('active');
			}
		}
		filter[3] = paginaGlobal;
		//arrayInicio[inicio, categoria, granel, pagina, 15];
		_getProducts(filter);
		e.preventDefault();
	}
	
	//Hace el llamado AJAX para conseguir productos
	function _getProducts(array) {
		var request = 'tienda/getProducts?catid=' + array[1] + '&inicio=' + array[0] + '&granel=' + array[2]+'&pag=' + array[3]+'&cnt='+array[4];
		$.ajax({
			type: 'GET',
			url: request,
			dataType: 'json',
			success: function (json) {
				_render(json,array[3])
			}
		});
	}
	
	//Cambia estado css de las pestañas
	function _renderTabs(tab, active) {
		switch (tab) {
			case 0:
				$botonera.addClass('hide');
				$productos.addClass('full');
				$botonera.find('.granel').removeClass('active');
				$botonera.find('.naturales').removeClass('active');
				break;
			case 1:
				if (active) {
					$productos.removeClass('full');
					$botonera.removeClass('hide');
					$botonera.find('.granel').toggleClass('active');
					$botonera.find('.naturales').removeClass('active');	
				}
				break;
			case 2:
				if (active) {
					$productos.removeClass('full');
					$botonera.removeClass('hide');
					$botonera.find('.naturales').toggleClass('active');
					$botonera.find('.granel').removeClass('active');
				}
				break;
		}
	}
	
	//Renderiza los productos
	function _render(json, pagina) {
		if ( pagina <= 1 ) {
			$productos.empty();	
		}
		var unidades = {m : 'ml.',
					l : 'lt.',
					g : 'gr.',
					k : 'kg.',
					u : 'uni.'};
		$.each(json, function (indice, obj) {
			obj.produnidad = unidades[obj.produnidad];
			if (obj.prodgranel == 1) {
				obj.cuenta = obj.prodprecio / obj.prodpresentacion;
				obj.proddisplay = '';
			} else {
				obj.proddisplay = 'x ' + obj.prodpresentacion;
				obj.cuenta = obj.prodprecio;
				obj.prodpresentacion = 1;
			}
			if ($(document).width() <= 768) {
				$productos.append(Mustache.render(prodTemplateMovil, obj));
			} else {
				$productos.append(Mustache.render(prodTemplate, obj));
			}
		});
	}
	
	function _nroItemsCarrito() {
		$.ajax({
			type: 'GET',
			url: 'http://vqv/cart/get',
			dataType: 'json',
			success: function (json) {
				var ln = json.items.length;
				alert(ln);
				$('#boton').append('  <span>('+ln+')</span>');
			}
		})
	}
	
	function _addItem(e) {
		if ( usuario.isLogged() ) {
			$.ajax({
				type: 'POST',
				url: 'cart/addItem',
				data: $(this).serialize(),
				dataType: 'json',
				success: function () {
					_nroItemsCarrito();
				}
			});
		}
		e.preventDefault();
	}
	
	function _expandirItemMovil() {
		var id = $(this).attr('data-id');
		var $span = $productos.find('span.' + id);
		$span.slideToggle();
	}
	
	function _searchItem() {
		var query = $search.val();
		$.ajax({
			type: 'GET',
			url: 'tienda/search?filter=' + query,
			dataType: 'json',
			success: function (json) {
				_render(json,1);
			},
		})
	}

	function _calcPrice() {
		var precio = $(this).attr('data-precio');
		var cantidad = $(this).val();
		var id = $(this).attr('data-id');
		var sub = precio * cantidad;
		var cadena = '$u. ' + sub + '- Agregar al carrito';
		$('.'+id).val(cadena);
	}
	
	function _lazyLoad(event) {		
		if ( $(window).scrollTop() >= $(document).height() - $(window).height() ){
			paginaGlobal = paginaGlobal + 1;
			arrayValores = [inicioGlobal,categoriaGlobal,granelGlobal,paginaGlobal,nroProductosGlobal];
			_getProducts(arrayValores);
		} else {
			pagina = 1;
		}
	}
	
})();

/*
var usuario = (function () {

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
		if (_isLogged() == true) {
			$boton.html(islog);
			$.ajax({
				type: 'GET',
				url: 'cart/get',
				dataType: 'json',
				success: function (json) {
					$.each(json.items, function (i, obj) {
						switch (obj.produnidad) {
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
						if (obj.prodgranel == 1) {
							obj.cuenta = obj.prodprecio / obj.prodpresentacion;
							obj.proddisplay = '';
						} else {
							obj.quantity /= obj.prodpresentacion;
							obj.proddisplay = 'x ' + obj.prodpresentacion;
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
			success: function (json) {
				control = json.msg;
			}
		});
		return control;
	};

	function _login(e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'cart/login',
			data: $(this).serialize(),
			dataType: 'json',
			success: function (json) {
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
			success: function () {
				render();
			}
		});
		e.preventDefault();
	};

	function _logout() {
		$.ajax({
			type: 'GET',
			url: 'cart/logout',
			success: function () {
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
			success: function (json) {
				if (json.msg) {
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
		if ($(window).width() <= 768) {
			if (estado == 'none') {
				$contenedor.css('display', 'none');
				$carrito.animate({
					width: '100%;'
				});
				$carrito.css('display', 'flex');
			}
		} else {
			if (estado == 'none') {
				$contenedor.animate({
					width: '80%'
				}, function () {
					$carrito.css('display', 'flex');
				})
			} else {
				$carrito.css('display', 'none');
				$contenedor.animate({
					width: '100%'
				});
			}
		}
	}

	function _hideCart() {
		$carrito.css('display', 'none');
		$contenedor.css('display', 'flex');
		$contenedor.animate({
			width: '100%'
		});
	}

	function _updatePrice() {
		var precio = $(this).attr('data-precio');
		var cantidad = $(this).val();
		var id = $(this).attr('id');
		var sub = precio * cantidad;
		$('.' + id).html('$u.' + sub);
	}

	return {
		islogged: _isLogged,
		render: render,
		carrito: $carrito,
		showCart: showCart
	}
})();

var productos = function () {

	// Cache DOM
	var $productos = $('.productos');
	var $carrito = usuario.carrito;
	var $botonera = $('#filtro');
	var $tabs = $('#tabs');
	var $search = $tabs.find('#searchItem');
	var $searchBox = $tabs.find('div.search');
	var $producto = $('.productos');
	var prodTemplate = $('#prodTemplate').html();
	var prodTemplateMovil = $('#prodTemplateMovil').html();
	var itemTemplate = $('#carritoItem').html();
	var errorLogMsg = '<span class="errorMsg">Debes iniciar sesion o registrarte para poder realizar tu compra exitosamente. </span>';

	var errorCountLog = false;
	
	
	var y = $(window).scrollTop();
	var document = $(document).height();
	var window = $(window).height();
	var pagina = 1;
	var nroProductos = 15;
	var inicio = 1;
	var categoria = 0;
	var granel = 0;
	var cargaInicial = [inicio,categoria,granel,pagina,nroProductos];


	// Bind Events
	$productos.on('click', '#leftCon', _expandirItemMovil);
	$productos.on('submit', '.addItem', _addItem);
	$productos.on('change', '.cant', _calcPrice);
	$botonera.on('click', '.filter', _getData);
	$tabs.on('click', '.tab', _getData);
	$searchBox.on('click', '.search', _searchItem);
	$searchBox.on('keyup', '#searchItem', _searchItem);
	$producto.on('click', '.prod', _expandirItem);
	$carrito.on('change', '#dir', _modifyAddress);
	$carrito.on('change', '.quantity', _modifyItem);
	$carrito.on('click', '.remove', _deleteItem);
	$(window).bind('mousewheel DOMMouseScroll', _lazyLoad);

	_getProducts(cargaInicial);

	function _clearVal(id) {
		$('#form ' + id + 'input[type=number]').val('');
	};

	function _addItem(e) {
		var logged = usuario.islogged();
		var estado = usuario.carrito.css('display');
		if (logged == true) {
			$.ajax({
				type: 'POST',
				url: 'cart/addItem',
				data: $(this).serialize(),
				dataType: 'json',
				success: function () {
					_clearVal($(this).attr('id'));
					usuario.render();
				},
				error: function () {
					alert('error');
				}
			});
			if (estado == 'none') {
				usuario.showCart();
			}
			e.preventDefault();
		} else {
			e.preventDefault();
			if (errorCountLog) {
				if (estado == 'none') {
					usuario.showCart();
				}
			} else {
				$carrito.append(errorLogMsg);
				errorCountLog = true;
				if (estado == 'none') {
					usuario.showCart();
				}
			}
		}
	}

	function _getData(pagina) {
		var filter = $(this).data('filter');
		filter.push(pagina);
		filter[4] = nroProductos;
		var active = false;
		$activeTab = $(this);
		inicio = filter[0];
		categoria = filter[1];
		granel = filter[2];
		tab = (inicio == 1 ? 0 : (granel == 1 ? 1 : 2));
		//alert(inicio+' '+categoria+' '+granel+' '+tab);
		if (filter[3]) {
			if (!$activeTab.hasClass('active')) {
				$tabs.find('.active').removeClass('active');
				$activeTab.addClass('active');
				active = true;
			}
			_renderTabs(tab, active);
		} else {
			if (!$activeTab.hasClass('active')) {
				$botonera.find('a.active').removeClass('active');
				$activeTab.addClass('active');
			}
		}
		_getProducts(filter);
	}

	function _getProducts(array) {
		var request = 'tienda/getProducts?catid=' + array[1] + '&inicio=' + array[0] + '&granel=' + array[2]+'&pag=' + array[3]+'&cnt='+array[4];
		alert(array);
		$.ajax({
			type: 'GET',
			url: request,
			dataType: 'json',
			success: function (json) {
				_render(json)
			}
		});
	}

	function _renderTabs(tab, active) {
		switch (tab) {
			case 0:
				$botonera.find('.granel').removeClass('active');
				$botonera.find('.naturales').removeClass('active');
				break;
			case 1:
				if (active) {
					$botonera.find('.granel').toggleClass('active');
					$botonera.find('.naturales').removeClass('active');	
				}
				break;
			case 2:
				if (active) {
					$botonera.find('.naturales').toggleClass('active');
					$botonera.find('.granel').removeClass('active');
				}
				break;
		}
	}

		
	function _render(a,b,c) {
		$productos.empty();
		var categoria = ((b != null) ? b : $(this).attr('data-categoria'));
		
		var granel = ((a != null) ? a : $(this).attr('data-granel'));
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


	function _render(json) {

		$productos.empty();
		var unidades = [m => 'ml.',
					l => 'lt.',
					g => 'gr.',
					k => 'kg.',
					u => 'uni.'];
		$.each(json, function (indice, obj) {
			obj.produnidad = unidades[obj.produnidad];
			if (obj.prodgranel == 1) {
				obj.cuenta = obj.prodprecio / obj.prodpresentacion;
				obj.proddisplay = '';
			} else {
				obj.proddisplay = 'x ' + obj.prodpresentacion;
				obj.cuenta = obj.prodprecio;
				obj.prodpresentacion = 1;
			}
			if ($(document).width() <= 768) {
				$productos.append(Mustache.render(prodTemplateMovil, obj));
			} else {
				$productos.append(Mustache.render(prodTemplate, obj));
			}
		});
	}

	function _expandirItem(e) {
		//e.preventDefault();
		var $padre = $(this).parent('.prod');
		var id = $(this).attr('data-producto');
		alert(id);
		$('#' + id).toggleClass("oculto");
	}

	function _expandirItemMovil() {
		var id = $(this).attr('data-id');
		var $span = $productos.find('span.' + id);
		$span.slideToggle();
	}

	function _modifyAddress() {
		$.ajax({
			type: 'POST',
			url: 'cart/updateAddress',
			data: $(this).serialize(),
			dataType: 'json',
			success: function () {
				// Funcion tooltip
				alert('hola');
			},
			error: function () {
				alert('chau');
			}
		})
	}

	function _modifyItem() {
		var prodId = $(this).attr('id');
		var quantity = $(this).attr('value');
		$.ajax({
			type: 'GET',
			url: 'cart/modifyitem/' + prodId + '/' + quantity,
			success: function () {}
		})
	}

	function _deleteItem(e) {
		e.preventDefault();
		var id = $(this).attr('id');
		$.ajax({
			type: 'POST',
			url: 'cart/removeItem/' + id,
			success: function () {
				usuario.render();
			}
		})
	}

	function _searchItem() {
		var query = $search.val();
		$.ajax({
			type: 'GET',
			url: 'tienda/search?filter=' + query,
			dataType: 'json',
			success: function (json) {
				_render(json);
			},

		})
	}

	function _calcPrice() {
		var precio = $(this).attr('data-precio');
		var cantidad = $(this).val();
		var id = $(this).attr('data-id');
		var sub = precio * cantidad;
		var cadena = '$u. ' + sub + '- Agregar al carrito';
<<<<<<< HEAD
		$('.'+id).val(cadena);
=======
		$('.' + id).val(cadena);
		// alert(cadena);
>>>>>>> refs/remotes/origin/master
	}
	
	function _lazyLoad(event) {
		if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {
       alert('sisisisisi');
    }
    else {
       alert('sisisisisi');
    }
			
		if ( $(window).scrollTop() >= $(document).height() - $(window).height() ){
			cargaInicial = (inicio,categoria,granel,pagina,nroProductos);
			pagina = pagina + 1;
			_getProducts(cargaInicial);
		} else {
			pagina = 0;
		}
	}

}();
*/