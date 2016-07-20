<h2 class="faq">Como funciona</h2>
<ol>
	<li>Entra a <a href="#">VQV - Tienda</a> y registrate</li>
	<li>Selecciona de nuestro catalogo el producto que desees</li>
	<li>Elegi la cantidad a comprar</li>
	<li>Selecciona el envase en el que ira presentado</li>
	<ul>
		<li>Bolsas de papel reciclado.</li>
		<li>Envase de vidrio para intercambio -sin costo adicional-</li>
		<li>Envase de vidrio nuevo para tu cocina -con costo adicional-</li>
	</ul>
	<li>Agrega al carrito el producto.</li>
	<li>Al cerrar el carrito de compra elige tu metodo de pago:</li>
	<ul>
		<li>Efectivo a contraentrega.</li>
		<li>Giro bancario en cuenta del BROU.</li>
	</ul>
	<li>Recibiras un mail confirmando tu compra.</li>
	<li>En el correr de x horas te contactaremos para coordinar la entrega a tu domicilio.</li>
</ol>

<h2 class="faq">Preguntas frecuentes</h2>
<dl>
	<?php foreach ($questions as $item) : ?>
	 	<dt>P - <?php echo $item->question; ?></dt>
	 	<dd>R - <?php echo $item->answer; ?></dd>
	<?php endforeach; ?>
</dl>