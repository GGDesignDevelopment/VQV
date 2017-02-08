
var user = (function() {


	// Event Binding 
	event.on('login', login);

	/**
	 * Does an ajax consult to check if the user is logged to the website
	 * @return {Boolean} [true if is logged]
	 */
	function _isLogged() {
		var control = null;
		$.ajax({
			async: false,
			type: 'GET',
			url: baseURL + 'cart/islogged',
			dataType: 'json',
			success: function(json) {
					control = json.msg;
			}
		});
		return control;
	};

	/**
	 * Handles the login of the user
	 * @param  {[event]} e [description]
	 * @return {[bool]}   if true the login is complete ELSE user doesn't exists
	 */
	function login(data) {
		var control = false;
		$.ajax({
				type: 'POST',
				url: baseURL + 'cart/login',
				data: data,
				dataType: 'json',
				success: function(json) {
						control = json.msg;
				},
		});
		return control;
	}	

	function render(id) {
		var flag = id || null;
	}

})();











/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

var productos = ( function() {
	
	var unidades = {
		m : 'ml.',
		l : 'lt.',
		g : 'gr.',
		k : 'kg.',
		u : 'uni.'
	};

	//BINDING
	event.on('prodUpdate', function(data) {
		store
	})

	/**
	 * Product object constructor
	 * that helps with manipulation by replacing odd 
	 * names provided by API
	 * 
	 * @param  {[obj]} p [prod obj]
	 * @return {[obj]}   [new prod obj]
	 */
	function createProd(p) {
		var producto = {
			id: p.prodid,
			catId: p.catid,
			envases: p.envases,
			descripcion: p.proddes,
			imgUrl: p.prodimagen,
			nombre: p.prodnombre,
			precio: p.prodprecio,
			presentacion: p.prodpresentacion,
			unidad: unidades[p.produnidad],
			subTotal : p.amount || 0,
			cantidad: p.quantity || 0, 
			granel: p.granel
		}
		return new Object(producto);
	}

	/**
	 * Makes the ajax request to get the products
	 * @param  {[string]} type ['g'=> granel || 'i' => inicio(destacados) || ]
	 *                         ['n' => naturales || 'id' => get by id ]
	 * @param  {[string]} id   [category of products, only needed if type == id]
	 * @return {[json]}      [products object]
	 */
	function getProducts(type, id) {

		var types = {
			g: 'granel=1',
			i: 'inicio=1',
			n: 'granel=0',
			id: 'catid='
		}

		var request = baseUrl + 'tienda/getProducts?';
				request += id ? types.id+id : types[type];
		var results = {};

		$.ajax({
			type: 'GET',
			url: request,
			dataType: 'json',
			success: function (json) {
				results = json;
			}
		});
		return results;

	}

	/**
	 * Given a prod.arr returned by getProducts
	 * Creates the object prod to store at local storage
	 * @param  {[arr of obj]} prods [products]
	 * @return {[obj{ id: '', prod: {} }]}  
	 */
	function createProducts(prods) {
		var results = new Object();
		for(var i=0; i<=prods.length; i++) {
			results[prods[i].id] = createProd(prods[i]);
		}
		return results;
	}

	
	function store() {
		var granel = createProducts(getProducts('g')),
				destacados = createProducts(getProducts('i')),
				naturales = createProducts(getProducts('n'));

		session.create('granel', granel);
		session.create('destacados', destacados);
		session.create('naturales', naturales);

	}

	function getByCat(catId, type) {
		var products = session.retrieve(type),
				results = new Object(),
				keys = Object.keys(products)

		for (var i=0; i<keys.length; i++) {
			if ( products[keys[i]].catId == catId ) {
				results[keys[i]] = products[keys[i]];
			}
		}

		return (Object.keys(results).length > 0) ? results : false;
	}

	function render() {

	}

	return {
		render: render
	}



})();












/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

var cart = (function() {

	/**
	 * Function to get the cart from the DB
	 * @return [{obj}] [cart object contains
	 *                      name: nameofuser,
	 *                      address: shipingadress,
	 *                      products: array of prods]
	 */
	function fetchCart() {
		var result = {},
		$.ajax({
			type: 'GET',
			url: baseURL + 'cart/get',
			dataType: 'json',
			success: function (json) {
				result = json;
			}
		})
		return result;
	}

	/**
	 * Given a cart JSON creates a cart obj, 
	 * with the products structure in it.
	 * @return {[obj]} [products object]
	 */
	function createCart() {
		var obj = fetchCart();
		var cart = {
			name: obj.name,
			addr: obj.addr,
			products: productos.create(obj.items)
		}
		return new Object(cart);
	}

	/**
	 * Given a certain value updates the shipping adress
	 * only used to communicate the change to the DB
	 * @param  {[str]} val [new shipping address]
	 * @return {[bool]}     [success of operation]
	 */
	function _updateAdress(val) {
		var result = false;
		$.ajax({
			type: 'POST',
			url: baseURL + 'cart/updateAdress',
			data: val,
			success: function (json) {
				result = true;
			}
		})
		return result;
	}

	/**
	 * Given an id and a value it communnicates to the DB 
	 * the new quantity to set to that certain product
	 * @param  {[str]} id  [id of the product to update]
	 * @param  {[num]} val [new value of the prod]
	 * @return {[bool]}     [success of the operation]
	 */
	function _updateProduct(id, val) {
		var result = false;
		$.ajax({
			type: 'GET',
			url: baseUrl + 'cart/modifyitem/' + id + '/' + val,
			success: function () {
				result = true;
			}
		})
		return result;
	}

	/**
	 * Updates certain cart item given a key 
	 * @param  {[obj]} obj [the cart object]
	 * @param  {[str]} key [addr || prodid]
	 * @param  {[str]} val [value to update]
	 */
	function updateCart(obj, key, val) {
		if ( key === 'addr' ) {
			obj.addr = val;
			_updateAdress(obj.addr)
				 
		} else {
			obj.products[key] = val;
			_updateProduct(key, val)
				
		}
	}

	/**
	 * Given certain ID deletes the product from the cart
	 * @param  {[str]} id [id of the producto]
	 * @return {[bool]}    [succes of operation]
	 */
	function deleteProd(id) {
		var result = false;
		$.ajax({
			type: 'POST',
			url: baseURL + 'cart/removeItem/' + id,
			success: function () {
				result = true;
			}
		})
		return result;
	}

	/**
	 * Destroys the cart
	 * @return {[bool]} [succes of operation]
	 */
	function dropCart() {
		var result = false;
		$.ajax({
			type: 'POST',
			url: baseUrl + 'cart/cancel'
			success: function() {
				result: true;
			}
		})
		return result;
	}

})();











/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

var session = (function() {
	
	function create(key, value) {
			sessionStorage.setItem(JSON.stringify(arguments[i]), JSON.stringify(arguments[i+1]));
	}

	function retrieve(key) {
		var result = JSON.parse(sessionStorage.getItem(key));
		return result; 
	}

	function delete(key) {
		sessionStorage.removeItem(key);
	}

	function storeProducts(obj) {
		var results = Object.keys(obj);
		for (var i=0; i < results.length; i++) {
			create(resuts[i], obj[results[i]]);
		}

	}

	function getProducts(type) {
		var query = type+'-keys',
				keys = retrieve(query),
				results = [];

		for (var i=0; i<keys.length; i++) {
			results.push(retrieve(keys[i]));
		}

		return results;
	}

	return {
		create: create,
		retr: retrieve,
		update: update,
		delete: deleteItem,
		products: storeProducts,
		build: build,
		getProducts: getProducts
	}

})();











/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

var helpers = (function() {

	function isMobile() {
		if ($(document).width() <= 768) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * updates the content of a view
	 * @param  {[$]} view     [jquery object]
	 * @param  {[DOM_String]} template [MUSTACHE templating style]
	 * @param  {[object]} object   [data to feed the template]
	 */
	function updateView(view, template, object) {
		if object {
			view.html(Mustache.render(template, object))
		} else {
			view.html(Mustache.render(template))
		}
	}


	function drawProducts(prods, template) {
		for (var i=0; i<prods.length; i++) {
			$prodContainer.append(Mustache.render(prods[i], template));
		}
	}

	return {
		isMobile: isMobile,
		updateView: updateView,
		drawProducts: drawProducts
	}

})();


 









/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

var interface = (function() {

	//DOM CACHE
	var views = {
		$mainNav: $('#main'),
		$tabsNav: $('#tabs'),
		$catNav: $('#filter'),
		$prodContainer: $('#productos'),
		$button: $('#boton')
	};

	
	//TEMPLATE CACHE
	var templates = {
		login: $('#loginTemplate').html(),
		prod: $('#prodTemplate').html(),
		prodM: $('#prodTemplateMovil').html(),
		button: $mainNav.find('#boton'),
		logged: $mainNav.find('#boton').html('Mi Carrito')
	}

	//EVENT BINDING
	$boton.on('click', handleMainNav);
	$mainNav.on('submit', handleLogin);
	$tabsNav.on('click', prodUpdate);
	$catNav.on('click', prodUpdate);

	session.build();

	

	function handleMainNav(e) {
		e.preventDefault();
		if ( user.isLogged() ) {
			$(location).attr('href', baseURL + 'tienda/carrito');
		} else {
			helpers.updateView($mainNav, templates.button);
		}
	}

	function handleLogin(e) {
		e.preventDefault();
		var data = $(this).serialize();
		if user.login(data) {
			helpers.updateView($mainNav, templates.logged);
		} else {
			$mainNav.find('form').addClass('error');
		}
	}

	function prodUpdate(e) {
		e.preventDefault();
		var role = $(this).data('role');
		if ( role == 'tabs') {
			var type  = $(this).data('type'),
					products = session.getProducts(type),
					template = helpers.isMobile ? templates.prodM : templates.prod;

			helpers.drawProducts(products, template)
		} else {
			var id = $(this).data('id');
		}
	}


})();











/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

var productos() {

	function create(obj) {
		var producto = {
			id: p.prodid,
			catId: p.catid,
			envases: p.envases,
			description: p.proddes,
			imgUrl: p.prodimagen,
			nombre: p.prodnombre,
			precio: p.prodprecio,
			presentacion: p.prodpresentacion,
			unidad: unidades[p.produnidad],
			subTotal : p.amount ? p.amount : 0,
			quantity: p.quantity = p.quantity : 0
		}
		return new Object(producto);
	
	}

	function retrieve(type, id) {

		var types = {
			g: 'granel=1',
			i: 'inicio=1',
			n: 'granel=0',
			id: 'catid='
		}

		var request = baseUrl + 'tienda/getProducts?';
				request += id ? types.id+id : types[type];
		var results = {};

		$.ajax({
			type: 'GET',
			url: request,
			dataType: 'json',
			success: function (json) {
				results = json;
			}
		});

		return results;

	}

	function sort(products) {
		
	}

}