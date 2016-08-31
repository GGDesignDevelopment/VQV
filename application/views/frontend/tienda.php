<div class="contenedor">
		<header>
			<div class="titulo">
				<h1>Tienda OnLine</h1>
				<h2>Verde que te Quiero Verde</h2>
			</div>
			<nav>
				<a href="#">&#xe0aa;</a>
				<a href="#">&#xe0b1;</a>
				<a href="#" class="boton" id="login"></a>
			</nav>
		</header>
		<div class="contenido">
				<nav id="filtro">
						<a class="filter" href="#" data-categoria="0">Todas las categorias</a>
						<?php if (count($categorias)): foreach ($categorias as $categoria): ?>
												<a class="filter" href="#" data-categoria="<?php echo $categoria->catid; ?>"><?php echo $categoria->catdescripcion; ?></a>
								 <?php endforeach; ?>
						<?php endif; ?> 
				</nav>
				<div class="productos">
						<div id="col1" class="column"></div>
						<div id="col2" class="column"></div>   
						<div id="col3" class="column"></div>           
				</div>
		</div>
</div>
		<!-- Revisar pa' dinamico  -->
<div id="carrito">
	<script id="loginForm" type="text/template">
		<a href="index.html">vqv</a>
		<a id="ocultar" href="#">Ocultar carrito.</a>
		<form id="ingresar" method="POST" action="#" name="iniciar">
			<h2>Iniciar sesion</h2>
			<input type="email" name="email" placeholder="email" required>
			<input type="password" name="password" placeholder="contrase&ntilde;a"required>
			<input type="submit" value="Ingresar">
		</form>
		<span></span>
		<form id="registrarse" method="POST" action="cart/register" name="registrarse">
			<h2>Registrarse</h2>
			<input type="email" name="email" placeholder="email" required>
			<input type="password" name="password" placeholder="contrase&ntilde;a" required>
			<input type="password" name="password2" placeholder="confirmar contrase&ntilde;a" required>
			<input type="text" name="name" placeholder="Nombre y Apellido" required>
			<input type="text" name="phone" placeholder="Telefono">
			<input type="text" name="address" placeholder="Direccion">
			<input type="submit" value="Registrarse">
		</form>
		<a id="ocultar" href="#">Ocultar carrito.</a>
	</script>
	<script id="carritoTemplate" type="text/template">
		<a href="index.html">vqv</a>
		<a id="ocultar" href="#">Ocultar carrito.</a>
		<h2>{{name}}</h2>
		<form method="POST" action="cart/confirm">
			<input id="dir" type="text" name="address" value="{{address}}" placeholder="Direccion">
			{{#items}}
			<fieldset>
				<legend><a href="#" id="{{prodid}}" class="remove">&#xe019;</a></legend>
				<p>{{prodnombre}}</p>
				<div>
						<input type="number" class="quantity" name="cantidad" data-id="{{prodid}}" placeholder="{{quantity}}">
						<span>${{amount}}</span>
				</div>
			</fieldset>
			{{/items}}
			<input type="submit" id="confirmar" name="confirmar" value="Confirmar Compra">
		</form>
		<a href="#" id="logout">Cerrar sesion</a>
	</script>
	<script id="carritoItem" type="text/template">
		<fieldset>
			<legend><a href="cart/removeItem/{{prodid}}" class="remove">&#xe019;</a></legend>
			<p>{{prodnombre}}</p>
			<div>
				<input type="number" name="cantidad" placeholder="{{quantity}}">
				<span>${{amount}}</span>
			</div>
		</fieldset>
	</script>	
</div>
<script type="text/template" id="prodTemplate">
	<div class="prod">
		<img src="img/{{prodimagen}}" title="{{prodnombre}}">
		<a href="#" class="expandir" data-producto="{{prodid}}">{{prodnombre}}<span>&#x33;</span></a>
		<form id="{{prodid}}" method="POST" class="oculto addItem">
			<div>
				{{#granel}}
					<select name="envase">
						<option selected disabled>Tipo de envase</option>
						<option value="1">Bolsa de papel</option>
						<option value="2">Envase de vidrio nuevo</option>
						<option value="3">Intercambio envase</option>
					</select>
				{{/granel}}
				<input type="number" name="quantity" placeholder="cantidad">
				<span>{{produnidad}}</span>
			</div>
			<p>{{proddes}}</p>
			<input type="hidden" name="productid" value="{{prodid}}" >
			<input type="submit" value="Agregar al" data-icon="&#xe015;">
		</form>
	</div>
</script>
<script type="text/template" id="prodTemplateMovil">
	<div class="prod">
		<div id="leftCon">
			<img src="img/{{prodimagen}}" title="{{prodnombre}}">
		</div>
		<div id="rightCon">
			<form id="{{prodid}}" method="POST" class="addItem">
				<h2>{{prodnombre}}</h2>
				<div>
					<input type="number" name="quantity" placeholder="Cantidad.">
					<p>/ {{produnidad}}</p>
				</div>
				{{#granel}}
					<select name="envase">
						<option selected disabled>Tipo de envase</option>
						<option value="1">Bolsa de papel</option>
						<option value="2">Envase de vidrio nuevo</option>
						<option value="3">Intercambio envase</option>
					</select>
				{{/granel}}
				<input type="hidden" name="productid" value="{{prodid}}" >
				<div class="button">
					<input type="submit" value="Agregar al" data-icon="&#xe015;">
					<span>&#xe015;</span>
				</div>
			</form>
		</div>
		<span>
			<h3>Descripcion</h3>
			<p>{{proddes}}</p>
		</span>
	</div>
</script>
