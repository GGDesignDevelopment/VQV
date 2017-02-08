
(function() {


		var user = (function() {

			events.on('login', login);
			events.on('register', register);
			events.on('logout', logout);

			function login(res) {
				var res = JSON.parse(res);
				if ( !res.msg ) {
					$('.msgBox').html(res.des);
				} else {
					$mainNav.html(Mustache.render(templates.cartBtn));
					events.emit('cartRender');
				}
			}

			function register(data) {
				var flag = data.msg;

				if (flag) {
					events.emit('cartRender');
				} else {
					$slider.find('.msgBox').html(Mustache.render(templates.msg.find('.register').html()));
				}
			}

			function logout() {
				$slider.empty();
				$mainNav.html(Mustache.render(templates.login));
			}

			function isLogged() {
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

			return {
				logged: isLogged,
			}

		})();


		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		function getProducts(url) {
			return $.get(baseURL+url);
		}

		/***
		 *** Cache de elementos DOM
		 ***/
		var $mainNav = $('#main'),
				$tabs = $('#tabs'),
				$searchBox = $tabs.find('input'),
				$searchBtn = $('#searchBtn'),
				$filterNav = $('#categorias'),
				$prodContainer = $('#productsContainer'),
				$product = $prodContainer.find('.prod'),
				$slider = $('#slider');

		var templates = {
					register: $('#template-register').html(),
					product: $('#template-product').html(),
					cartItem: $('#template-cartItem').html(),
					cart: $('#template-cart').html(),
					msg: $('#template-mensajes').html(),
					cartBtn: $('#template-cartBtn').html(),
					login: $('#template-login').html()
				}

		$tabs.on('click', 'a', function(e){
			e.preventDefault();
			var url = {
				i: 'tienda/getProducts?inicio=1',
				g: 'tienda/getProducts?granel=1',
				n: 'tienda/getProducts?granel=0'
			};
			var filter = $(e.target).data('type'),
					request = getProducts(url[filter]);

			console.log('Tab pressed: '+filter);
			request.then(function(products){
				events.emit('render', products);
				sessionStorage.setItem('currentTab', filter);
				console.log('products fetched!');
			}) 
		})

		$searchBtn.on('click', function(e){
			e.preventDefault();
			var data = $searchBox.val(),
					request = getProducts('tienda/search?filter='+data);
			console.log('Search data: '+data);
			request.then(function(products){
				console.log('Search succesfull, results:');
				console.log(products);
				events.emit('render', products);
			})
		});

		$filterNav.on('click', function(e){
			e.preventDefault();
			var urls = {
				i: 'tienda/getProducts?inicio=1',
				g: 'tienda/getProducts?granel=1',
				n: 'tienda/getProducts?granel=0'
			};
			var id = $(e.target).data('id'),
					tab = sessionStorage.getItem('currentTab') || 'i',
					url = urls[tab]+'&catId='+id,
					request = getProducts(url);
			request.then(function(products){
				events.emit('render', products);
				console.log('Pedido exitoso, categoria: '+id+' tab: '+tab);
				console.log(products);
			}) 
		})

		$mainNav.on('click', function(e){

			e.preventDefault();
			var action = $(e.target).data("action");

			if (action == 'login') {
				if ( user.logged() ) {
					sliderOpen();
					events.emit('login', {msg: true});
				} else {
					var data = $(this).find('form').serialize(),
							login = $.post(	baseURL + 'cart/login',data );

					login.then(function(res) {
						console.log('Login then success: ', res); //DEBUG
						events.emit('login', res);
					});
				}
			} 
			else if (action == 'register') {
				$slider.attr("data-role", "register");
				$slider.html(Mustache.render(templates.register));
				$slider.addClass('show');
				return;
			}

		});		

		$slider.on('click', function(e) {
			e.preventDefault();
			var action = $(e.target).data('action');
			console.log('Slider click Action: '+action);

			if (action == 'close') {
				e.preventDefault();
				$slider.removeClass('show');
				return;
			}
			if (action == 'register' ) {
				var data = $(this).find('form').serialize(),
						register = $.post(baseURL+'cart/register', data);

				register.then(function(res) {
					events.emit('register', res);
					console.log('Register then succes: ', res);
				})
			} 
			if (action == 'remove') {
				var id = $(this).parent('section').data('id'),
						remove = $.post(baseURL+'cart/removeItem', id);
				remove.then(function(res) {
					console.log('Delete item: '+res);
					events.emit('deleteCartItem', res);
				})
			}
			if (action== 'edit') {
				var id = $(this).parent('section').data('id');
				events.emit('editItem', id);
				console.log('Item edit: '+ id);
			}
			if (action == 'confirmEdit') {
				var id = $(this).parent('section').data('id'),
						value = $(this).parent().find('input').val,
						data = [id, value],
						edit = $.post(baseURL+'cart/modifyItem', data);
				edit.then(function(res) {
					console.log('Confirm edit: '+res);
					events.emit('confirmEdit', data);
				})
			}
			if ( action == 'addrUpdate' ) {
				var data = $('input[name=address]').val(),
						modify = $.post(baseURL+'cart/updateAddress', data);
				modify.then(function(res) {
					events.emit('addrUpdate');
					console.log('Modify addres: '+data+' '+res);
				})
			}
			if (action=='confirm') {
				var data = $('select[name=formaPago').val(),
						confirm = $.post(baseURL+'cart/confirm', data);
				confirm.then(function(res){
					events.emit('cartSubmit', res);
					console.log('Confirm cart: '+res+' data: '+data);
				})
			}
			if (action=='cancel') {
				$(e.target).html('¿Seguro que deseas eliminar el pedido?');
				$(e.target).data('action', 'confirmCancel')
			}
			if (action=='confirmCancel') {
				var cancel = $.get(baseURL+'cart/cancel');
				cancel.then(function (res) {
					events.emit('cancelCart');
				})
			}
			if (action=='logout') {
				var request = $.post(baseURL+'cart/logout');
				request.then(function(res){
					console.log('Logout complete');
					events.emit('logout', res);
				})
			}
		});


})();


// var productos = ( function() {
	
// 	var unidades = {
// 		m : 'ml.',
// 		l : 'lt.',
// 		g : 'gr.',
// 		k : 'kg.',
// 		u : 'uni.'
// 	};

// 	//BINDING
// 	events.on('prodUpdate', function(data) {
// 		render(data);
// 		console.log('yeah');
// 	})

// 	/**
// 	 * Product object constructor
// 	 * that helps with manipulation by replacing odd 
// 	 * names provided by API
// 	 * 
// 	 * @param  {[obj]} p [prod obj]
// 	 * @return {[obj]}   [new prod obj]
// 	 */
// 	function createProd(p) {
// 		var producto = {
// 			id: p.prodid,
// 			catId: p.catid,
// 			envases: p.envases,
// 			descripcion: p.proddes,
// 			imgUrl: baseURL + 'assets/dynamic_img/' + p.prodimagen,
// 			nombre: p.prodnombre,
// 			precio: p.prodprecio,
// 			presentacion: p.prodpresentacion,
// 			unidad: unidades[p.produnidad],
// 			subTotal : p.amount || 0,
// 			cantidad: p.quantity || 0, 
// 			granel: p.granel
// 		}
// 		return new Object(producto);
// 	}

// 	/**
// 	 * Makes the ajax request to get the products
// 	 * @param  {[string]} type ['g'=> granel || 'i' => inicio(destacados) || ]
// 	 *                         ['n' => naturales || 'id' => get by id ]
// 	 * @param  {[string]} id   [category of products, only needed if type == id]
// 	 * @return {[json]}      [products object]
// 	 */
// 	function getProducts(type, id) {

// 		var types = {
// 			g: 'granel=1',
// 			i: 'inicio=1',
// 			n: 'granel=0',
// 			id: 'catid='
// 		}

// 		var request = baseURL + 'tienda/getProducts?';
// 				request += id ? types.id+id : types[type];
// 		var results = {};

// 		$.ajax({
// 			type: 'GET',
// 			url: request,
// 			dataType: 'json',
// 			success: function (json) {
// 				session.create(type, createProducts(json));
// 			}
// 		});
// 	}

// 	/**
// 	 * Given a prod.arr returned by getProducts
// 	 * Creates the object prod to store at local storage
// 	 * @param  {[arr of obj]} prods [products]
// 	 * @return {[obj{ id: '', prod: {} }]}  
// 	 */
// 	function createProducts(prods) {
// 		var results = new Object(),
// 				keys = Object.keys(prods);

// 		for(var i=0; i<=keys.length; i++) {

// 			if (prods.hasOwnProperty(keys[i])) {
// 				var id = prods[keys[i]].prodid;
// 				results[id] = createProd(prods[keys[i]]);
// 			}
			
// 		}
// 		return results;
// 	}

	
// 	function store() {
// 		getProducts('g');
// 		getProducts('i');
// 		getProducts('n');
// 	}

// 	function getByCat(catId, type) {
// 		var products = session.retrieve(type),
// 				results = new Object(),
// 				keys = Object.keys(products)

// 		for (var i=0; i<keys.length; i++) {
// 			if ( products[keys[i]].catId == catId ) {
// 				results[keys[i]] = products[keys[i]];
// 			}
// 		}

// 		return (Object.keys(results).length > 0) ? results : false;
// 	}

// 	var $prodContainer = $('#productsContainer'),
// 			product = $('#template-product').html();

// 	function render(tab, id) {
// 		if ( tab == null ) {
// 			store();
// 			var prods = session.retr('i');
// 		} else {
// 			var prods = session.retr(tab);
// 		}
// 		var keys = Object.keys(prods);

// 		for (var i=0; i<keys.length; i++) {
// 			$prodContainer.append(Mustache.render(product, prods[keys[i]]));
// 			console.log(i)
// 		}
// 	}

// 	return {
// 		render: render
// 	}



// })();












// /////////////////////////////////////////////////////////////////////
// /////////////////////////////////////////////////////////////////////
// /////////////////////////////////////////////////////////////////////
// /////////////////////////////////////////////////////////////////////
// /////////////////////////////////////////////////////////////////////
// var app = (function() {
	
	

// 	/**
// 	 * Suscripcion a eventos
// 	 */
	
// 	$login.on('click', function(e) {
// 		var data = $(this).serialize();
// 		events.emit('login', data);
// 		user.render();
// 		e.preventDefault();
// 	});

// 	$register.on('click', function(e) {
// 		e.preventDefault();
// 		user.render();
// 	})

// 	$tabs.on('click', function(e) {
// 		var data = $(this).data('type');
// 		console.log(data);
// 		$prodContainer.empty();
// 		sessionStorage.setItem('currentTab', data);
// 		events.emit('prodUpdate', data);
// 		e.preventDefault();
// 	})

// 	$search.on('keyup', function(e) {
// 		e.preventDefault();
// 		var data = $search.find('input').val();
// 		events.emit('filter', data);
// 		productos.render();
// 	})

// 	$filterNav.on('click', function(e) {
// 		e.preventDefault();
// 		var data = $(this).data('catId');
// 		events.emit('filter', data);
// 		productos.render()
// 	})

// 	$product.on('change', function(e) {
// 		var data = new Array(),
// 				id = $(this).parent('form').data('id');
// 		data.push($(this).val());
// 		data.push($(this).data('type'));

// 		events.emit('prodUpdate', data);
// 		products.render(currentTab, id);
// 	})

// 	$product.on('submit', function(e) {
// 		e.preventDefault();
// 		var data = $(this).serialize();
// 		events.emit('addToCart', data);
// 	})

// 	//
// 	//
// 	//

// 	var currentTab = session.retr('currentTab') || null;
// 	productos.render(currentTab);

	
// })();