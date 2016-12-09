<header id="mainMenu">
	<a id="logo" href="<?php echo site_url() ?>"><img src="img/logo2.png" /></a>
	<h2>Verde que te Quiero Verde</h2>
	<nav>
		<a href="#main">inicio</a>
		<a href="#alimentacion">alimentacion</a>
		<a href="#about">sobre nosotras</a>
		<a href="#faq">preguntas frecuentes</a>
		<a href="#footer">contacto</a>
	</nav>
</header>
<section id="main">
	<h1>Verde que te quiero verde</h1>
	<h2><?php echo $home->txtWelcome; ?></h2>

	<div class="botones">
		<a href="<?php echo site_url('Tienda')?>">Tienda Virtual</a>
		<a href="#about">Conocenos</a>
	</div>

	<div class="social">
		<a href="<?php echo $home->linkFacebook; ?>" target="blank">&#xe093;<span> /VqVerdeUruguay</span></a>
		<a href="<?php echo $home->linkInstagram; ?>" target="blank">&#xe09a;<span> /vqvuruguay</span></a>
	</div>
</section>

<section id="alimentacion">
	<header>
		<h3><?php echo $home->subAlimentacion; ?></h3>
	</header>
	<div id="frame">
		<div id="imgContainer"></div>
		<div id="navBar"></div>
	</div>
</section>
<!-- ------------------------------------------------------------ -->
<section id="about">
	<h3><?php echo $home->subAbout; ?></h3>
	<p><?php echo $home->txtAbout; ?></p>
</section>
<!-- ------------------------------------------------------------ -->
<section id="faq">
	<nav>
		<a href="#" data-posicion="0">Como Funciona.</a>
		<a href="#" data-posicion="1">Preguntas Frecuentes.</a>
	</nav>
	<div data-posicion="0">
		<ul>
			<li>1- Entra a <a href="http://vqv.com.uy/Tienda"> VQV - Tienda </a> y registrate</li>
			<li>2- Selecciona de nuestro catalogo el producto que desees</li>
			<li>3- Elegi la cantidad a comprar</li>
			<li>4- Selecciona el envase en el que ira presentado</li>
			<ul>
				<li>Bolsas de papel reciclado.</li>
				<li>Envase de vidrio para intercambio -sin costo adicional-</li>
				<li>Envase de vidrio nuevo para tu cocina -con costo adicional-</li>
			</ul>
			<li>5- Agrega al carrito el producto.</li>
			<li>6- Al cerrar el carrito de compra elige tu metodo de pago:</li>
			<ul>
				<li>Efectivo a contraentrega.</li>
				<li>Giro bancario en cuenta del BROU.</li>
			</ul>
			<li>7- Recibiras un mail confirmando tu compra.</li>
			<li>8- En el correr de x horas te contactaremos para coordinar la entrega a tu domicilio.</li>
		</ul>
	</div>
	<div data-posicion="1" id="preguntas">
		
	</div>
</section>
<!-- ------------------------------------------------------------ -->
<footer>
	<div id="info">
		<p>Télefono: (+598) 2204 7844</p>
		<p>Montevideo, Uruguay</p>
		<p>info@vqv.com.uy</p>
	</div>
	<div id="social">
		<a href="<?php echo $home->linkFacebook; ?>" target="blank">&#xe0aa;</a>
		<a href="<?php echo $home->linkInstagram; ?>" target="blank">&#xe0b1;</a>
	</div>
	<form id="formContacto" method="post" action="home/suscribir">
			<label>Recibi noticias por email</label>
			<input type="text" name="nombre" placeholder="Nombre" required>
			<input type="email" name="email" placeholder="Email" required>
			<input type="submit" value="Suscribirse" id="button">
	</form>
</footer>

<script type="text/template" id="templateQuestions">
	<a href="#" data-id="{{id}}">{{question}}</a>
	<p data-id="{{id}}">{{answer}}</p>
</script>
<script type="text/javascript">
var imagenes = [];
<?php foreach ($alimentacion as $item) : ?>
	imagenes.push('<?php echo site_url($dir . $item->imagen) ?>');
<?php endforeach; ?>
</script>