<header>
	<div class="wrapper">
		<div class="logo">
			<h1>Tienda Online - VQV</h1>
			<a href="<?php echo site_url() ?>">Volver a VQV</a>
		</div>
		<nav id="main">
			<form id="login" class="click" data-action="login">
				<div>
					<input type="email" name="mail">
					<input type="password" name="pass">
					<button data-action="login">Ingresar</button>
				</div>
				<div>
					<a href="#" class="click" data-action="register" >¿no estas registrado?</a>
					<a href="#" data-action="resetPswd" class="click">¿olvidaste tu contraseña?</a>
				</div>
			</form>
			<span class="msgBox"></span>
		</nav>
	</div>
	<nav id="tabs">
		<a href="#" data-type="i">Productos destacados</a>
		<a href="#" data-type="g">Productos a granel</a>
		<a href="#" data-type="n">Productos naturales envasados</a>
		<input type="text" name="search" placeholder="buscar productos">
		<button id="searchBtn">&#x55;</button>
	</nav>
</header><!-- /header -->
<div id="container">
	<section id="categorias" data-filter="destacados">
		<?php if (count($categorias)): foreach ($categorias as $categoria): ?>
			<a href="#" data-id="<?php echo $categoria->catid; ?>"><?php echo $categoria->catdescripcion; ?> <span>&#x5b;</span></a>
		 	<?php endforeach; ?>
		<?php endif; ?>
	</section>
	<section id="productsContainer" data-page="0">

	</section>
</div>	
<div id="slider" data-role="cart" class="">
	<header id="cartHead">
		<h6>Carrito de compras.</h6>
		<button data-action="close" data-text="cerrar">&#x51; </button> 
	</header>
	<div id="info">
		<p>{{name}}</p>
		<section>
		 	<label for="address">Direccion de envio: </label>
		 	<input type="text" name="address" placeholder="">
		 	<button data-action="addrUpdate">&#x4e;</button>
	 	</section>
	</div>
	<div id="items">
		<section class="item" data-id="{{id}}">
		<div> 
			<button data-action="remove">&#xe07d;</button>
			<button data-action="edit">&#x6a;</button>
		</div>
		<div>{{nombre}}</div>
		<div>{{cantidad}}{{display}}{{unidad}}</div>
		<div>{{envase}}</div>
		<div>${{costo}}</div>
	</section>
	<section class="item" data-id="{{id}}">
		<div> 
			<button data-action="remove">&#xe07d;</button>
			<button data-action="edit">&#x6a;</button>
		</div>
		<div>{{nombre}}</div>
		<div>{{cantidad}}{{display}}{{unidad}}</div>
		<div>{{envase}}</div>
		<div>${{costo}}</div>
	</section>
	</div>
	<footer id="cartFoot">
		 	<select name="formaPago">
		 		<option selected disabled>Metodo de pago.</option>
		 		<option value="1">Deposito en cuenta BROU.</option>
		 		<option value="2">Pago contrarembolso.</option>
		 	</select>
	 	<button data-action="confirm">Confirmar Pedido <span>&#xe07a;</span></button>
	 	<a href="#" data-action="cancel">Cancelar pedido</a>
		
		<a href="#" data-action="logout">Cerrar Sesión</a>
	</footer>
</div>

<script type="text/template" id="template-register">
	<header>
		<h6>Bienvenidos a la comunidad Verde </h6>
		<button data-action="close" data-text="cerrar">&#x51; </button> 
	</header>
	<p>Creemos en que los cambios de hábitos son posibles, sólo basta con proponérselo. <br>No existen las excusas de que no tenes tiempo y no sabes qué cocinar… VQV te lleva el pedido  a la puerta de tu casa y además te da tips de cómo usar los productos.
	</p>
	<form method="POST">
			
			<div>
				<label for="name"><span>&#xe08a;</span> Nombre y apellido</label>
				<input type="text" name="name" required>
			</div>
			<div>
				<label for="email"><span>&#xe084;</span> Email</label>
				<input type="email" name="email" required>
			</div>
			<div>
				<label for="phone"><span>&#xe090;</span> Telefono</label>
				<input type="text" name="phone" >
			</div>
			<div>
				<label for="address"><span>&#xe0fd;</span> Direccion de envio</label>
				<input type="text" name="address" >
			</div>
			<div>
				<label for="password"><span>&#xe06e;</span> Contraseña</label>
				<input type="password" name="password" required>
			</div>
			<div>
				<label for="password"><span>&#xe06e;</span> Repite contraseña</label>
				<input type="password" name="password2" required>
			</div>
			<div>
				<input type="submit" data-action="register" value="Registrate.">
			</div>
			<div class="msgBox"></div>
	</form>
</script>
<script type="text/template" id="template-product">
	<div class="prod" data-id="{{id}}">
		<h3>{{nombre}}{{#granel}} (granel){{/granel}}</h3>
		<div class="imgContainer">
			<img src="{{imgUrl}}" alt="Imagen">
		</div>
		<p>{{descripcion}}</p>
		<form>
			<div>
				<input type="number" name="quantity" step="{{presentation}}" min="{{presentation}}" >
				<span>{{display}} {{unidad}}</span>
			</div>
			{{#granel}}
			<select name="envase">
				<option selected disabled>Tipo de envase</option>
				{{#envases}}
				<option value="{{id}}">{{nombre}} - ${{costo}}</option>
				{{/envases}}
			</select>
			{{/granel}}
			<input type="submit" value="$ {{precio}} Agregar al carrito">
		</form>
	</div>
</script>
<script type="text/template" id="template-cartItem">
	<section class="item" data-id="{{id}}">
		<div> 
			<button data-action="remove">&#xe07d;</button>
			<button data-action="edit">&#x6a;</button>
		</div>
		<div>{{nombre}}</div>
		<div>{{cantidad}}{{display}}{{unidad}}</div>
		<div>{{envase}}</div>
		<div>${{costo}}</div>
	</section>
</script>
<script id="template-cart" type="text/template">
	<header id="cartHead">
		<h5>Carrito de compras.</h5>
		<button data-action="user" data-text="preferencias">&#x66;</button>
		<button data-action="close" data-text="cerrar">&#x51; </button> 
	</header>
	<div id="info">
		<h5>{{name}}</h5>
		<section>
		 	<label for="address">Direccion de envio: </label>
		 	<input type="text" name="address" placeholder="">
		 	<button>&#x4e;</button>
	 	</section>
	</div>
	<div id="items">
		
	</div>
	<footer id="cartFoot">
		<label for="formaPago">Metodo de pago:</label>
		 	<select name="formaPago">
		 		<option value="1">Deposito en cuenta BROU.</option>
		 		<option value="2">Pago contrarembolso.</option>
		 	</select>
	 	<button>Confirmar Pedido <span>&#xe07a;</span></button>
		
	</footer>
</script>
<script type="text/template" id="template-mensajes">
	<span class="error">
		<p>Lo sentimos, parece que hubo un error al procesar su compra. <br>Por favor intentelo mas tarde</p>
	</span>
	<span class="confirmacion">
		<h5>Su compra ha sido realizada con exito.</h5>
		<p>
			En unos minutos nos pondremos en contacto con usted para coordinar la entrega de su pedido! <br>Gracias por elegirnos!
		</p>
	</span>
	<span class="register">
		<p>Parece que hubo un error al procesar su solicitud, por favor vuelva a intentarlo.</p>
	</span>
	<span class="loginBtn">
		<button></button>
	</span>
	<span class="itemEdit">
		<span>
			<input type="number" step="{{step}}" min="{{step}}">
			<button>&#x4e;</button>
		</span>
	</span>
</script>
<script type="text/template" id="template-cartBtn">
	<button data-action="open">Mi Carrito <span>&#xe015;</span></button>
	<a href="#" data-action="changePswd">Cambiar contraseña.</a>
</script>
<script type="text/template" id="template-login">
	<form id="login" class="click" data-action="login">
				<div>
					<input type="email" name="mail">
					<input type="password" name="pass">
					<button data-action="login">Ingresar</button>
				</div>
				<div>
					<a href="#" class="click" data-action="register" >¿no estas registrado?</a>
					<a href="#" data-action="resetPswd" class="click">¿olvidaste tu contraseña?</a>
				</div>
			</form>
			<span class="msgBox"></span>
</script>