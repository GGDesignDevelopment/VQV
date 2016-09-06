<div class="contenedor">
		<header>
			<div class="titulo">
				<h1>Tienda OnLine</h1>
				<h2>Verde que te<br> Quiero Verde</h2>
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
						<!-- <div id="col1" class="column"></div>
						<div id="col2" class="column"></div>   
						<div id="col3" class="column"></div>  -->          
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
			<div>
				<p>{{prodnombre}}</p>
				<input id="{{prodid}}" type="number" name="cantidad" placeholder="{{quantity}}{{produnidad}}">
				<span>${{amount}}</span>
				<a href="cart/removeItem/{{prodid}}" class="remove" id="{{prodid}}">&#xe019;</a>
			</div>
			{{/items}}
			<input type="submit" id="confirmar" name="confirmar" value="Confirmar Compra">
		</form>
		<a href="#" id="logout">Cerrar sesion</a>
	</script>
	<script id="carritoItem" type="text/template">
		<div>
			<p>{{prodnombre}}</p>
			<input id="{{prodid}}" type="number" name="cantidad" placeholder="{{quantity}}">
			<span>{{produnidad}} ${{amount}}</span>
			<a href="cart/removeItem/{{prodid}}" class="remove">&#xe019;</a>
		</div>
	</script>	
</div>
<script type="text/template" id="prodTemplate">
	<div class="prod">
		<div id="top" style="background-image: linear-gradient(rgba(126,126,126,.15),rgba(126,126,126,.15)),url(img/{{prodimagen}})">
			<a href="#" class="expandir" data-producto="{{prodid}}">{{prodnombre}}</a>
			<p>{{proddes}}</p>
		</div>
		
		<form id="{{prodid}}" method="POST" class="oculto addItem">
			<input type="number" class="cant" name="quantity" placeholder="{{prodpresentacion}}" value="{{prodpresentacion}}" step="{{prodpresentacion}}" min="{{prodpresentacion}}" data-presentacion="{{prodpresentacion}}" data-precio="{{prodprecio}}" data-id="{{prodid}}">
			<span>{{produnidad}}</span>
			{{#prodgranel}}
				<select name="envase">
					<option selected disabled>Tipo de envase</option>
					<option value="1">Bolsa de papel</option>
					<option value="2">Envase de vidrio nuevo</option>
					<option value="3">Intercambio envase</option>
				</select>
			{{/prodgranel}}
			<input type="hidden" name="productid" value="{{prodid}}" >
			<input class="{{prodid}}" type="submit" value="$u. {{prodprecio}} - Agregar al carrito" >
		</form>
	</div>
</script>
<script type="text/template" id="prodTemplateMovil">
	<div class="prod" data-id="{{prodid}}">
		<div id="leftCon">
			<img src="img/{{prodimagen}}" title="{{prodnombre}}">
		</div>
		<div id="rightCon">
			<form id="{{prodid}}" method="POST" class="addItem">
				<h2>{{prodnombre}}</h2>
				<div>
					<input type="number" class="cant" name="quantity" placeholder="{{prodpresentacion}}" value="{{prodpresentacion}}" step="{{prodpresentacion}}" min="{{prodpresentacion}}" data-presentacion="{{prodpresentacion}}" data-precio="{{prodprecio}}" data-id="{{prodid}}">
					<p>/ {{produnidad}}</p>
				</div>
				{{#prodgranel}}
					<select name="envase" >
						<option selected disabled>Tipo de envase</option>
						<option value="1">Bolsa de papel</option>
						<option value="2">Envase de vidrio nuevo</option>
						<option value="3">Intercambio envase</option>
					</select>
				{{/prodgranel}}
				<input type="hidden" name="productid" value="{{prodid}}" >
				<div class="button">
					<input type="submit" value="Agregar al" data-icon="&#xe015;">
					<span>&#xe015;</span>
				</div>
			</form>
		</div>
		<span class="{{prodid}}">
			<h3>Descripcion</h3>
			<p>{{proddes}}</p>
		</span>
	</div>
</script>
