<header id="mainMenu">
	<a id="logo" href="<?php echo site_url() ?>"><img src="img/logo2.png" /></a>
	<h2>Verde que te Quiero Verde</h2>
	<nav data-state="hidden">
		<a href="#main">inicio</a>
		<!--<a href="#alimentacion">alimentacion</a>-->
		<a href="#about">sobre nosotras</a>
		<a href="#faq">preguntas frecuentes</a>
		<a href="#footer">contacto</a>
	</nav>
	<a href="#" id="burguer" ><span>&#x61;</span></a>
</header>

<div id="social">
	<a href="<?php echo $home->linkFacebook; ?>" target="blank">&#xe093;</a>
	<a href="<?php echo $home->linkInstagram; ?>" target="blank">&#xe09a;</a>
</div>

<section id="main">
	<div class="wrap">
		<h1>Verde que te quiero verde</h1>
		<p>
			<?php echo $home->txtWelcome; ?>
		</p>

		<div class="botones">
			<a href="<?php echo site_url('Tienda')?>">Tienda Virtual</a>
			<a href="#about">Conocenos</a>
		</div>
	</div>
</section> 

<section id="alimentacion">
	<header>
		<h5>
			<?php echo $home->subAlimentacion; ?>
		</h5>
	</header>
	<div id="frame">
		<div id="imgContainer"></div>
		<div id="navBar">
			<div class="wrap">
				<div class="arrow l"><a href="#">&#x44;</a></div>
				<div class="pages"></div>
				<div class="arrow r"><a href="#">&#x45;</a></div>
			</div>
		</div>
	</div>
</section>
<!-- ------------------------------------------------------------ -->
<section id="about">
	<div class="wrap">
		<h1>
			<?php echo $home->subAbout; ?>
		</h1>
		<p>
			<?php echo $home->txtAbout; ?>
		</p>
	</div>
</section>
<!-- ------------------------------------------------------------ -->
<section id="faq">
	<nav>
		<a href="#" data-posicion="0">Como Funciona.</a>
		<a href="#" data-posicion="1">Preguntas Frecuentes.</a>
	</nav>
	<div id="first" class="hidden">
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
	<div id="preguntas" class="hidden">

	</div>
</section>
<!-- ------------------------------------------------------------ -->
<footer id="footer">
	<h6>© 2016 -2017 Verde que te Quiero Verde<br />Contacto: info@vqv.com.uy</h6>
	<div id="form-wrap">
		<form action="" method="POST" data-state="wait">
			<h5>Recib&iacute; noticias por mail.</h5>
			<input class="eval" type="text" name="firstName" value="Nombre" required>
			<input class="eval" type="text" name="lastName" value="Apellido">
			<input class="eval" type="email" name="email" value="Email" required>
			<input type="submit" value="Suscribirse">
		</form>
	</div>
</footer>

<div id="lightBox"></div>
<script type="text/template" id="templateQuestions">
	<a class="question" href="#" data-id="{{id}}"><span>&#x4c;</span>{{question}}</a>
	<p data-id="{{id}}">{{answer}}</p>
</script>
<script type="text/template" id="form-sent">
	<p class="msg succes">Gracias por suscribirse!</p>
</script>
<script type="text/template" id="form-error">
	<h5 class="msg error">Parece que hubo un error. <br> Por favor intentelo nuevamente</h5>
</script>