<div id="container">

	<header>
		<h1>Carrito de compras</h1>
		<h2>Verde que te Quiero Verde</h2>
		<nav>
			<a href="<?php echo site_url() ?>" data-text="Volver al inicio."><span>&#xe009;</span>  Volver al inicio.</a>
			<a href="<?php echo site_url('Tienda') ?>" data-text="Volver a la tienda."><span>&#xe015;</span> Volver a la tienda</a>
			<a href="<?php echo $home->linkFacebook ?>" data-text="/VqVerdeUruguay"><span>&#xe093;</span> /VqVerdeUruguay</a>
			<a href="<?php echo $home->linkInstagram; ?>" data-text="/vqvuruguay"><span>&#xe09a;</span> /vqvuruguay</a>
			<a href="#" id="logout" data-text="Cerrar sesión"><span>&#x4d;</span> Cerrar sesión</a>
		</nav>
	</header>
	<div id="middle">
		<table>
			<thead>
				<tr>
					<th></th>
					<th>Producto</th>
					<th>Cantidad</th>
					<th>Envase</th>
					<th>Sub-total</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	<footer>
		 <form method="POST" action="">
		 	<label for="address">Direccion de envio: </label>
		 	<input type="text" name="address" placeholder="">
		 	<label for="formaPago">Metodo de pago:</label>
		 	<select name="formaPago">
		 		<option value="1">Deposito en cuenta BROU.</option>
		 		<option value="2">Pago contrarembolso.</option>
		 	</select>
		 	<label id="totalPrice"></label>
		 	<a href="#">Confirmar Pedido <span>&#xe07a;</span></a>
		 </form>
	</footer>
</div>
<script id="prodTemplate" type="text/html">
<table>
	<thead>
		<tr>
			<th></th>
			<th>Producto</th>
			<th>Cantidad</th>
			<th>Envase</th>
			<th>Sub-total</th>
		</tr>
	</thead>
	<tbody>
{{#items}}
	<tr id="{{prodid}}">
		<td><a class="remove" href="#" data-id="{{prodid}}">&#xe07d;</a></td>
		<td>{{prodnombre}}</td>
		<td> {{quantity}}{{proddisplay}}{{produnidad}}</td>
		<td>{{envase}}</td>
		<td>${{amount}}</td>
	</tr>
{{/items}}
</tbody>
</table>
</script>
<script type="text/template" id="registerTemplate">
<form id="register">
	<section>
		<h2>Bienvenidos a la comunidad Verde </h2>
		<p>Creemos en que los cambios de hábitos son posibles, sólo basta con proponérselo.
No existen las excusas de que no tenes tiempo y no sabes qué cocinar… VQV te lleva el pedido  a la puerta de tu casa y además te da tips de cómo usar los productos.
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
	</section>
</form>
</script>
