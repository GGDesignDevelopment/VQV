<header>
	<div class="logo">
		<h1>Tienda Online </h1>
		<a href="<?php echo site_url() ?>">Verde que te quiero verde</a>
	</div>
	<nav>
		<a class="icono" href="<?php echo $home->linkFacebook; ?>" target="blank">&#xe0aa;</a>
		<a class="icono" href="<?php echo $home->linkInstagram; ?>" target="blank">&#xe0b1;</a>
		<a href="<?php echo site_url('tienda/carrito') ?>" class="boton" id="boton">Mi carrito</a>
	</nav>
	<nav id="tabs" tabindex="0">
		<!-- [inicio, categoria, granel, paginaGolbal, 15, tabValue] -->
		<a class="tab" href="#" data-filter='["1","0","0","1","15","1"]'>Productos destacados</a>
		<a class="tab" href="#" data-filter='["0","0","1","1","15","1"]'>Productos a granel</a>
		<a class="tab" href="#" data-filter='["0","0","0","1","15","1"]'>Productos naturales</a>
		<div class="search">
			<input id="searchItem" type="text" placeholder="Buscar producto.">
			<a class="search" href="#">&#x55;</a>
		</div>
	</nav>
</header>
<div id="container">	
	<section id="filtro" class="hide">
		<span class="granel">
			<a class="filter" href="#" data-filter='["0","0","1"]'>Todas las categorias <span>&#x5b;</span></a>
			<?php if (count($categorias)): foreach ($categorias as $categoria): ?>
				<a class="filter" href="#" data-filter='["0","<?php echo $categoria->catid; ?>","1"]'><?php echo $categoria->catdescripcion; ?> <span>&#x5b;</span></a>
			 <?php endforeach; ?>
			<?php endif; ?>
		</span>
		<span class="naturales">
			<a class="filter" href="#" data-filter='["0","0","0"]'>Todas las categorias <span>&#x5b;</span></a>
			<?php if (count($categorias)): foreach ($categorias as $categoria): ?>
				<a class="filter" href="#" data-filter='["0","<?php echo $categoria->catid; ?>","0"]'><?php echo $categoria->catdescripcion; ?> <span>&#x5b;</span></a>
			 <?php endforeach; ?>
			<?php endif; ?>
		</span>
	</section>
	<section id="productos">
		
	</section>
</div>
<script type="text/template" id="loginTemplate">
<form id="login">
	<input type="text" name="email" value="Email" required>
	<input type="password" name="password" value="Contraseña" required>
	<input type="submit" value="Ingresar / Registrarse" >
</form>
</script>
<script type="text/template" id="prodTemplate">
	<div class="prod" >
		<a href="#" class="expandir">{{prodnombre}}{{#prodgranel}} (producto a granel){{/prodgranel}}</a>
		<div class="top" data-producto="{{prodid}}" style="background: url(<?php echo site_url('img/dynamic_img')?>/{{prodimagen}})">
		</div>
		<p>{{proddes}}</p>

		<form id="{{prodid}}" method="POST" class="addItem">
			<input type="number" class="cant" name="quantity" value="{{prodpresentacion}}" placeholder="{{prodpresentacion}}" step="{{prodpresentacion}}" min="{{prodpresentacion}}" data-precio="{{cuenta}}" data-id="{{prodid}}">
			<span>{{proddisplay}} {{produnidad}}</span>
			{{#prodgranel}}
				<select name="envase">
					<option selected disabled>Tipo de envase</option>
					{{#envases}}
					<option value="{{envaseid}}">{{envasenombre}} - ${{envasecosto}}</option>
					{{/envases}}
				</select>
			{{/prodgranel}}
			<input type="hidden" name="productid" value="{{prodid}}" >
			<input class="{{prodid}}" type="submit" value="$u. {{prodprecio}} - Agregar al carrito" >
		</form>
	</div>
</script>
<script type="text/template" id="prodTemplateMovil">
	<div class="prod" data-id="{{prodid}}">
		<img src="img/dynamic_img/{{prodimagen}}" title="{{prodnombre}}">
		<form id="{{prodid}}" method="POST" class="addItem">
			<h2>{{prodnombre}}</h2>
			<p>{{proddes}}</p>
			<span>
				<input type="number" class="cant" name="quantity" value="{{prodpresentacion}}" placeholder="{{prodpresentacion}}" step="1" min="1" data-precio="{{cuenta}}" data-id="{{prodid}}">
				<p> {{proddisplay}} {{produnidad}}</p>
			{{#prodgranel}}
				<select name="envase" >
					<option selected disabled>Tipo de envase</option>
					{{#envases}}
					<option value="{{envaseid}}">{{envasenombre}} - ${{envasecosto}}</option>
					{{/envases}}
				</select>
			{{/prodgranel}}
			</span>
			<input type="hidden" name="productid" value="{{prodid}}" >
			<input type="submit" class="{{prodid}}" value="$u. {{prodprecio}} -Agregar al carrito">

		</form>

	</div>
</script>
