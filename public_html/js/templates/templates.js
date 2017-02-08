var login-template = '';
var prod-template = '<div class="prod" >
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
	</div>';
var prod-template-movil = '<div class="prod" data-id="{{prodid}}">
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

	</div>';