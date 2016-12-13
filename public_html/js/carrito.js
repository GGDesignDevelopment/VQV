var carrito = (function() {
	//DOM CACHE
	var $container = $('#container');
	var $header = $container.find('header');
	var $middle = $container.find('#middle');
	var $footer = $container.find('footer');
	var tableOfProducts = $middle.html();
	var registerTemplate = $('#registerTemplate').html();
	var productTemplate = $('#prodTemplate').html();

	//BindEvents
	$middle.on('submit', '#register', _register);
	$middle.on('click', '.remove', _remove);
	$header.on('click', '#logout', _logout);

	_render();


	//Chequea si el usuario esta loggeado
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

	//Decide si renderizar el registro o el carrito dependiendo del estado del usuario
	function _render() {
		if ( !_isLogged() ) {
			$middle.html(registerTemplate);
		} else {
			$middle.html(tableOfProducts);
			_getProducts();
		}
	}

	//Maneja el registro del usuario, redirige al carro de compras.
	function _register(e) {
		$.ajax({
			type: 'POST',
			url: baseURL + 'cart/register',
			data: $(this).serialize(),
			dataType: 'json',
			success: function (data) {
				_render(data);
			}
		});
		e.preventDefault();
	};

	//OBtiene los productos del carrito
	function _getProducts() {
		$.ajax({
			type: 'GET',
			url: baseURL + 'cart/get',
			dataType: 'json',
			success: function (json) {
				_renderItems(json);
				_calcPrice(json);
			}
		})
	}

	//renderiza Items del carrito
	function _renderItems(json) {
		var unidades = {m : 'ml.',
					l : 'lt.',
					g : 'gr.',
					k : 'kg.',
					u : 'uni.'};
		$.each(json.items, function (i, obj) {
			obj.produnidad = unidades[obj.produnidad];
			if (obj.prodgranel == 1) {
				obj.cuenta = (obj.prodprecio / obj.prodpresentacion)*obj.quantity;
				obj.proddisplay = '';
			} else {
				obj.quantity /= obj.prodpresentacion;
				obj.proddisplay = 'x ' + obj.prodpresentacion;
				obj.cuenta = obj.prodprecio;
				obj.prodpresentacion = 1;
			}
			obj.amount = Math.round(obj.amount * 100) / 100;
		})
		$middle.html(Mustache.render(productTemplate, json));
	}

	//remueve Items del carrito
	function _remove(e) {
		var id = $(this).data('id');
				$row = $('#'+id);
		$.ajax({
			type: 'POST',
			url: baseURL + 'cart/removeItem/'+id,
			success: function() {
				$row.remove();
			}
		})
	}

	//Calcula el precio total de la compra
	function _calcPrice(json) {
		var total = 0;
		$.each(json.items, function (i, obj) {
			obj.amount = Math.floor(Math.round(obj.amount * 100) / 100);
			total += obj.amount;
		});
		$footer.find('#totalPrice').html('Total: $ '+total);
		$footer.find('input[name=address]').val(json.address);
	}

	function checkout() {

	}

	//Ajustes pa responsive
	function _responsive() {
		if ($(window).width() <= 600) {
			$navBar=$container.find('nav');
			$.each($navBar, function(i,obj){
				icono = $(this[i]).find('span').html();
				$(this).find('a').html('<span>'+icono+'</span>');
			})
		}
	}

	function _logout(e) {
		e.preventDefault();
		console.log('entro');
		$.ajax({
			type: 'POST',
			url: baseURL + 'cart/logout',
			success: function() {
				_render();
				console.log('ajax');
			}
		})

	}
	_responsive();
})();
