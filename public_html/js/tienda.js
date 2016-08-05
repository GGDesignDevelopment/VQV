// $(function () {
		
// 		// LOGIN
// 		$('#ingresar').submit(function(e){
				// $.ajax({
				// 		type: 'POST',
				// 		url: $(this).attr('action'),
				// 		data: $(this).serialize(),
				// 		dataType: 'json',
				// 		success: function(json) {
				// 				carrito(json.msg);
				// 		}
				// });
// 				return false;
// 		});

// 		// Dibujar carrito 
// 		function dibujarCarrito() {
// 				var carrTemplate = $('#carritoTemplate').html();
// 				$.ajax({
// 						type: 'GET',
// 						url: 'cart/get',
// 						dataType: 'json',
// 						success: function(json){
// 								$('#carritoForm').append(Mustache.render(carrTemplate, json))
// 						}
// 				})
// 		}

// 		// Mostrar Carrito 
// 		function carrito(islog) {
// 				if (islog == true) {
// 						$('#ingresar').hide();
// 						$('#registrarse').hide();
// 						$('#carritoForm').show();
// 						dibujarCarrito();
// 				} else {
// 						$('#ingresar').show();
// 						$('#registrarse').show();
// 						$('#carritoForm').hide();
// 				}
// 		}

// 		// LogedIn
// 		function isLogged() {
// 				var $carrito = $('#carrito_show');
// 				var islog = 'Mi Carrito <span>&#xe015;</span>';
// 				var notlog = 'Iniciar / Registrarse';
// 				$.ajax({
// 						type: 'GET',
// 						url: 'cart/islogged',
// 						dataType: 'json',
// 						success: function(json) {
// 								if ( json.msg == true ) {
// 										$carrito.append(islog);
// 										carrito(true);
// 								} else {
// 										$carrito.append(notlog);
// 										carrito(false);
// 								}
// 						}
// 				})
// 		};

// 		isLogged();

// 		// Register 
// 		$('#registrarse').submit(function() {
				// $.ajax({
				// 		type: 'POST',
				// 		url: $(this).attr('action'),
				// 		data: $(this).serialize(),
				// 		dataType: 'json',
				// 		success: function(json) {
				// 				carrito(json.msg);
				// 		}
				// });
// 				return false;
// 		})

// 		// Funcion para expandir el item producto.
		// $('.productos').delegate('.expandir', 'click', function(e) {
		// 		e.preventDefault();
		// 		var producto = $(this).attr('data-producto');
		// 		$('#'+producto).slideToggle();
		// 		$(this).toggleClass("fondo");
		// });

// Funcion para mostrar el carrito de compras
var $boton_carrito = $('#login');
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



// 		// Funcion dibujado y filtro de productos en AJAX
		// var producto = $('#prodTemplate').html();

		// function dibujar(categoria) {
		// 		$.ajax({
		// 				type: 'GET',
		// 				url: 'tienda/getProducts?catid='+categoria,
		// 				dataType: 'json',
		// 				success: function(json) {
		// 						var i = 1;
		// 						$.each(json, function(indice, obj) {
		// 								$('#col'+i).append(Mustache.render(producto, obj));
		// 								i = (i == 3 ? 1 : i + 1);
		// 						});
		// 				}
		// 		})  
		// };
		
// 		// inicializa con todos los productos
// 		dibujar(0);
		
// 		var $boton = $('#filtro a');

// 		$boton.on('click', function(e){
// 				var categoria = $(this).attr('data-categoria');
				// $('#col1').empty();
				// $('#col2').empty();
				// $('#col3').empty();
// 				dibujar(categoria);
// 		});

// });
// var user = {
// 	isloggedin: false,
// 	init : function() {
// 		this.cacheDOM();
// 		this.bindEvents();
// 		this.render();
// 	},
// 	cacheDOM : function() {
// 		this.$boton = $('#login');
// 		this.$carrito = $('#carrito');
// 		this.$formLogin = this.$carrito.find('#ingresar');
// 		this.$formRegister = this.$carrito.find('#registrarse'); 
// 		this.islog = 'Mi Carrito <span>&#xe015;</span>';
// 		this.notlog = 'Iniciar / Registrarse';
// 		this.login = this.$carrito.find('#loginForm').html();
// 		this.carritoTemplate = this.$carrito.find('#carritoTemplate').html(); 
// 	},
// 	bindEvents : function() {
// 		this.$formLogin.submit(this.login);
// 		this.$formRegister.submit(this.register);
// 	},
// 	render : function() {
// 		if ( this.isLogged() == true ) {
// 			this.$boton.html(this.islog);
// 			$.ajax({
// 					type: 'GET',
// 					url: 'cart/get',
// 					dataType: 'json',
// 					success: function(json){
// 							user.$carrito.html(Mustache.render(user.carritoTemplate, json));
// 					}
// 			})
// 		} else {
// 			this.$boton.html(this.notlog);
// 			this.$carrito.html(this.login);
// 		}
// 	},
// 	isLogged : function() {
// 		var control = null;
// 		$.ajax({
// 			async: false,
// 			type: 'GET',
// 			url: 'cart/islogged',
// 			dataType: 'json',
// 			success: function(json) {
// 				control = json.msg;
// 			}
// 		});
// 		return control;
// 	},
// 	login : function() {
		// $.ajax({
		// 	type: 'POST',
		// 	url: $(this).attr('action'),
		// 	data: $(this).serialize(),
		// 	dataType: 'json',
		// 	success: function(json) {
		// 		return false;
		// 	}
		// });
		// return false;
// 	},
// 	logout : function() {

// 	},
// 	register : function() {
		// $.ajax({
		// 		type: 'POST',
		// 		url: $(this).attr('action'),
		// 		data: $(this).serialize(),
		// 		dataType: 'json',
		// 		success: function(json) {
		// 				carrito(json.msg);
		// 		}
		// });
		// return false;
// 	}
// };
// user.init();
var usuario = (function(){

	// Cache DOM 
	var $boton = $('#login');
	var $carrito = $('#carrito');
	// Contenido html boton principal
	var islog = 'Mi Carrito <span>&#xe015;</span>';
	var notlog = 'Iniciar / Registrarse';
	// Templates MUSTACHE para render 
	var loginValue = $carrito.find('#loginForm').html();
	var carritoTemplate = $carrito.find('#carritoTemplate').html(); 

	// Bind Events
	$carrito.on('submit', '#ingresar', _login);
	$carrito.on('submit', '#registrarse', _register);
	$carrito.on('click', '#logout', _logout);
	$carrito.on('submit', '#confirmar', _confirmar);


	function render() {
		if ( _isLogged() == true ) {
			$boton.html(islog);
			$.ajax({
					type: 'GET',
					url: 'cart/get',
					dataType: 'json',
					success: function(json){
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
		$.ajax({
			type: 'POST',
			url: 'cart/confirm',
			success: function() {
				render();
			}
		})
		e.preventDefault();
	}

	return {
		render: render,
		carrito: $carrito,
	}
})();

var productos = function() {

	// Cache DOM
	var $col1 = $('col1');
	var $col2 = $('col2');
	var $col3 = $('col3');
	var $carrito = usuario.carrito;
	var $boton = $('#filtro a'); 
	var $producto = $('.productos');
	var prodTemplate = $('#prodTemplate').html();
	var itemTemplate = $('#carritoItem').html();

	// Bind Events 
	$col1.on('submit', '.agregar', _addItem);
	$col2.on('submit', '.agregar', _addItem);
	$col3.on('submit', '.agregar', _addItem);
	$boton.on('click', _render($(this).attr('[data-categoria]')));
	$producto.on('click', '.expandir', _expandirItem);


	_render(0);

	function _clearVal(id) {
		$('#form '+id+'input[type=number]').val('');
	};

	function _renderItem(obj) {

	}

	function _addItem(e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'cart/additem',
			data: $(this).serialize(),
			dataType: 'json',
			success: function(){
				alert('success');
				usuario.render();
				_clearVal($(this).attr('id'));
			}
		});
	}

	function _render(categoria) {
		$col1.empty();
		$col2.empty();
		$col3.empty();
		$.ajax({
			type: 'GET',
			url: 'tienda/getProducts?catid='+categoria,
			dataType: 'json',
			success: function(json) {
				var i = 1;
				$.each(json, function(indice, obj) {
					$('#col'+i).append(Mustache.render(prodTemplate, obj));
					i = (i == 3 ? 1 : i + 1);
				});
			}
		})  
	}
	
	function _expandirItem(e) {
		e.preventDefault()
		var id = $(this).attr('data-producto');
		$('#'+id).slideToggle();
		$(this).toggleClass("fondo");
	}

}();
