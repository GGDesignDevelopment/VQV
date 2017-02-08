<header>
	<div class="wrapper">
		<div class="logo">
			<h1>Tienda Online - VQV</h1>
			<a href="<?php echo site_url() ?>">Volver a VQV</a>
		</div>
		<nav id="main">
			<form id="login">
				<div>
					<input type="email" name="mail">
					<input type="password" name="pass">
					<input type="submit" value="ingresar">
				</div>
				<div>
					<p>¿no estas registrado?</p>
					<a href="#">registrarse</a>
				</div>
			</form>
		</nav>
	</div>
	<nav id="tabs">
		<a href="#" data-filter="tab" data-type="i">Productos destacados</a>
		<a href="#" data-filter="tab" data-type="g">Productos a granel</a>
		<a href="#" data-filter="tab" data-type="n">Productos naturales envasados</a>
		<input type="text" name="search" placeholder="buscar productos">
	</nav>
</header><!-- /header -->
<div id="container">
	<section id="categorias" data-filter="destacados">
		
	</section>
	<section id="productsContainer" data-page="0">
		
	</section>
</div>	

<script type="text/template" id="template-login">
	
</script>
<script type="text/template" id="template-register">
	<form id="register">
		<section>
			<h2>Bienvenidos a la comunidad Verde </h2>
			<p>Creemos en que los cambios de hábitos son posibles, sólo basta con proponérselo. <br>No existen las excusas de que no tenes tiempo y no sabes qué cocinar… VQV te lleva el pedido  a la puerta de tu casa y además te da tips de cómo usar los productos.
			</p>
		</section>
		<section>
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
				<input type="submit" value="Registrate" >
			</div>
			<div class="msgBox"></div>
		</section>
	</form>
</script>
<script type="text/template" id="template-product">
	<div class="prod" data-id="{{id}}">
		<h2>{{nombre}}{{#granel}} (granel){{/granel}}</h2>
		<div class="imgContainer"></div>
		<p>{{descripcion}}</p>
		<form>
			<input type="number" name="quantity" step="{{presentation}}" min="{{presentation}}" >
			<span>{{display}} {{unidad}}</span>
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
	<section class="item">
		<div>
			<a href="#" class="remove">&#xe07d;</a>
			<a href="#" class="edit">&#x6a;</a>
		</div>
		<div>{{nombre}}</div>
		<div>{{cantidad}}{{display}}{{unidad}}</div>
		<div>{{envase}}</div>
		<div>${{costo}}</div>
	</section>
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
	<span class="loginerror">
		<p>{{msg}}</p>
	</span>
</script>