paginaGlobal = 1;
categoriaGlobal = 0;
inicioGlobal = 1;
granelGlobal = 0;
nroProductosGlobal = 15;
scrollControl = false;
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
			url: baseURL + 'cart/islogged',
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
			url: baseURL + 'cart/login',
			data: $(this).serialize(),
			dataType: 'json',
			success: function (json) {
				if (json.msg) {
					$loginContainer.html(botonCarrito);
				} else {
					$(location).attr('href', baseURL + 'tienda/carrito?login=true');
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
	var iconoMarcado = '&#x5c;';
	var iconoDesmarcado = '&#x5b;';
	//Variables para primera carga

	arrayInicio = [1, 0, 0, 1, 15];

	// Bind Events
	$productos.on('click', '#leftCon', _expandirItemMovil);
	$productos.on('submit', '.addItem', _addItem);
	$productos.on('keyup change', '.cant', _calcPrice);
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
				paginaGlobal = 1;
		var	tab = (inicio == 1 ? 0 : (granel == 1 ? 1 : 2));
				filter[4] = 15;

		if (filter[5]) {

			if (!$activeTab.hasClass('active')) {
				$botonera.find('a.active span').html(iconoDesmarcado);
				$botonera.find('a.active').removeClass('active');
				$tabs.find('.active').removeClass('active');
				$activeTab.addClass('active');
				active = true;
				console.log('filter 3 + not active');
			}

			_renderTabs(tab, active);
		} else {

			if (!$activeTab.hasClass('active')) {
				$botonera.find('a.active span').html(iconoDesmarcado);
				$botonera.find('a.active').removeClass('active');
				$activeTab.addClass('active');
				$activeTab.find('span').html(iconoMarcado);
				console.log('else... ')
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
			if ($(document).width() <= 505) {
				$productos.append(Mustache.render(prodTemplateMovil, obj));
			} else {
				$productos.append(Mustache.render(prodTemplate, obj));
			}
		});
		scrollControl = false;
	}

	function _nroItemsCarrito() {
		$.ajax({
			type: 'GET',
			url: baseURL + 'cart/get',
			dataType: 'json',
			success: function (json) {
				var ln = json.items.length;
				$('#boton').html('Mi Carrito <span>('+ln+')</span>');
			}
		})
	}

	function _addItem(e) {
		var $cont = $(this).parent('.prod');
		if ( usuario.isLogged() ) {
			$.ajax({
				type: 'POST',
				url: 'cart/addItem',
				data: $(this).serialize(),
				dataType: 'json',
				success: function () {
					_nroItemsCarrito();
					$cont.addClass('box-shadow-animate');
					$cont.on('cssanimationend', function() {
						$cont.removeClass('box-shadow-animate')
					});
					$cont.append('<span>Agregado exitosamente</span>');
				}
			});
		} else {
			$cont.append('<span class="msg">Debes iniciar sesion para agregar productos al carrito</span>');
			$cont.addClass('box-shadow-animate-error');
					$cont.on('cssanimationend', function() {
						$cont.removeClass('box-shadow-animate-error');
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
		var sub2 = Math.round((sub + 0.00001) * 100) / 100;
		var cadena = '$u. ' + sub2 + '- Agregar al carrito';
		$('.'+id).val(cadena);
	}

	function _lazyLoad(event) {
		if ( !scrollControl && ($(window).scrollTop() + 50 >= $(document).height() - $(window).height()) ){
			scrollControl = true;
			paginaGlobal = paginaGlobal + 1;
			arrayValores = [inicioGlobal,categoriaGlobal,granelGlobal,paginaGlobal,nroProductosGlobal];
			_getProducts(arrayValores);
		}
	}

})();
