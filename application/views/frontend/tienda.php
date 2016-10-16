<div class="contenedor">
		<header>
			<div class="titulo">
				<h1>Tienda OnLine</h1>
				<a href="<?php echo site_url() ?>">Verde que te<br> Quiero Verde</a>
			</div>
			<nav>
				<a href="<?php echo $home->linkFacebook; ?>" target="blank">&#xe0aa;</a>
				<a href="<?php echo $home->linkInstagram; ?>" target="blank">&#xe0b1;</a>
				<a href="#" class="boton" id="login"></a>
			</nav>
		</header>
		<div class="contenido">
			<nav id="tabs">
				<a class="tab" href="#" data-tab="0">Productos destacados</a>
				<a class="tab" href="#" data-tab="1">Productos a granel</a>
				<a class="tab" href="#" data-tab="2">Productos naturales</a>
			</nav>
			<nav id="filtro">
				<span class="granel">
					<a class="filter" href="#" data-granel="1" data-categoria="0">Todas las categorias</a>
					<?php if (count($categorias)): foreach ($categorias as $categoria): ?>
						<a class="filter" href="#" data-granel="1" data-categoria="<?php echo $categoria->catid; ?>"><?php echo $categoria->catdescripcion; ?></a>
					 <?php endforeach; ?>
					<?php endif; ?>
				</span>
				<span class="naturales">
					<a class="filter" href="#" data-granel="0" data-categoria="0">Todas las categorias</a>
					<?php if (count($categorias)): foreach ($categorias as $categoria): ?>
						<a class="filter" href="#" data-granel="0" data-categoria="<?php echo $categoria->catid; ?>"><?php echo $categoria->catdescripcion; ?></a>
					 <?php endforeach; ?>
					<?php endif; ?>
				</span>
			</nav>
			<div class="productos">
					         
			</div>
		</div>
</div>

<div id="carrito">
	<script id="loginForm" type="text/template">
		<a href="index.html">vqv</a>
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
		<form method="POST" id="confirmar" action="">
			<div id="dir">
				<p>Direccion de envio:</p>
				<div>
					<span>&#xe074;</span>
					<input  type="text" name="address" value="{{address}}" placeholder="Direccion">
				</div>
			</div>
			{{#items}}
			<div>
				<p>{{prodnombre}}</p>
				<input id="{{prodid}}" class="valorCompra" type="number" value="{{quantity}}" data-precio="{{cuenta}}" min="1" name="cantidad" placeholder="{{quantity}}">
				<span>{{proddisplay}}{{produnidad}}</span>
				<span class="{{prodid}}">${{amount}}</span>
				<a href="cart/removeItem/{{prodid}}" class="remove" id="{{prodid}}">&#xe019;</a>
			</div>
			{{/items}}
			<select aria-required="required" required>
				<option value="">Elegir tipo de pago.</option>
				<option value="1">Deposito en cuenta BROU</option>
				<option value="2">Pago contrarembolso</option>
			</select>
			<input type="submit" name="confirmar" value="Confirmar Compra">
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
	<div class="prod" >
		<div class="top" data-producto="{{prodid}}" style="background-image: linear-gradient(rgba(126,126,126,.15),rgba(126,126,126,.15)),url(img/{{prodimagen}})">
			<a href="#" class="expandir">{{prodnombre}}{{#prodgranel}} (producto a granel){{/prodgranel}}</a>
			<!-- {{#prodgranel}}
				<span>Producto a granel</span>
			{{/prodgranel}} -->
			<p>{{proddes}}</p>
		</div>
		
		<form id="{{prodid}}" method="POST" class="oculto addItem">
			<input type="number" class="cant" name="quantity" value="{{prodpresentacion}}" placeholder="{{prodpresentacion}}" step="1" min="1" data-precio="{{cuenta}}" data-id="{{prodid}}">
			<span>{{proddisplay}} {{produnidad}}</span>
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
		<div id="leftCon" data-id="{{prodid}}">
			<img src="img/{{prodimagen}}" title="{{prodnombre}}">
		</div>
		<div id="rightCon">
			<form id="{{prodid}}" method="POST" class="addItem">
				<h2>{{prodnombre}}</h2>
				<div>
					<input type="number" class="cant" name="quantity" value="{{prodpresentacion}}" placeholder="{{prodpresentacion}}" step="1" min="1" data-precio="{{cuenta}}" data-id="{{prodid}}">
					<p> {{proddisplay}} {{produnidad}}</p>
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
					<input type="submit" value="Agregar al carrito">
				</div>
			</form>
		</div>
		<span class="{{prodid}}">
			<h3>Descripcion</h3>
			<p>{{proddes}}</p>
		</span>
	</div>
</script>
