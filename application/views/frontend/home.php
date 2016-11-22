<div id="container">

	<section id="header">
		<div class="logo">
			<a href="<?php echo site_url() ?>"><img src="img/logo2.png" /></a>
		</div>
		<nav>
			<a href="#main">inicio</a>
			<a href="#alimentacion">alimentacion</a>
			<a href="#about">sobre nosotras</a>
			<a href="#faq">preguntas frecuentes</a>
			<a href="#footer">contacto</a>
		</nav>
	</section>
<!-- ------------------------------------------------------------ -->
	<section id="main">
		<h1>Verde que te quiero verde</h1>
		<h2><?php echo $home->txtWelcome; ?></h2>

		<div class="botones">
			<a href="<?php echo site_url('Tienda')?>">Tienda Virtual</a>
			<a href="#about">Conocenos</a>
		</div>

		<div class="social">
			<a href="<?php echo $home->linkFacebook; ?>" target="blank">&#xe093;<span>/VqVerdeUruguay</span></a>
			<a href="<?php echo $home->linkInstagram; ?>" target="blank">&#xe09a;<span>/vqvuruguay</span></a>
		</div>
	</section>
<!-- ------------------------------------------------------------ -->
	<section id="alimentacion">
		<header>
			<h2>Consejos para tu alimentacion diaria.</h2>
			<h3><?php echo $home->subAlimentacion; ?></h3>
		</header>
		<div id="frame">
			<ul class="slidee">
				<?php foreach ($alimentacion as $item) : ?>
					<li><a href="#"><img src="<?php echo site_url($dir . $item->imagen) ?>"></a>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
<!-- ------------------------------------------------------------ -->
	<section id="about">
		<h2>Te contamos</h2>
		<h3><?php echo $home->subAbout; ?></h3>
		<p><?php echo $home->txtAbout; ?></p>
	</section>
<!-- ------------------------------------------------------------ -->
	<section id="faq">
		
	</section>
<!-- ------------------------------------------------------------ -->
	<section id="footer">
		<nav>
			<a href="#main">inicio</a>
			<a href="#alimentacion">alimentacion</a>
			<a href="#about">sobre nosotras</a>
			<a href="#faq">preguntas frecuentes</a>
			<a href="#footer">contacto</a>
		</nav>
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
				<input type="text" name="nombre" placeholder="Nombre" required></input>
				<input type="text" name="apellido" placeholder="Apellido" ></input>
				<input type="email" name="email" placeholder="Email" required></input>
				<input type="submit" value="Suscribirse" id="button" />
		</form>
	</section>
</div>