<div class="container">
	<!-- <section id="responsive">
		<nav>
			<a class="mobile" href="#alimentacion">alimentacion</a>
			<a href="#reciclaje">reciclaje</a>
			<a class="mobile faq" href="#faq">preguntas frecuentes</a>
			<a class="mobile" href="#footer">quienes somos</a>
			<a class="mobile" href="#" >tienda on line</a>
			<a class="mobile" href="#footer">contacto</a>
		</nav>	
		
		<div>
			<h2>Verde que te quiero verde</h2>
			<a href="#">&#x61;</a>
		</div>
	</section>  -->
	<section id="main">
		<header>
			<div class="logo">
				<a href="<?php echo site_url()?>"><img src="img/logo2.png"></a>
			</div>
			<nav>
				<a class="mobile" href="#alimentacion">alimentacion</a>
				<!-- <a href="#reciclaje">reciclaje</a> -->
				<a class="mobile faq" href="#faq">preguntas frecuentes</a>
				<a class="mobile" href="#footer">quienes somos</a>
				<a class="mobile" href="<?php echo site_url('Tienda')?>" >tienda on line</a>
				<a class="mobile" href="#footer">contacto</a>
			</nav>	
			<div class="pull">
				<h2>Verde que te quiero verde</h2>	
				<a class="responsive" data-posicion="main" href="#">&#x61;</a>
			</div>            
		</header>

		<h1>Verde que te quiero verde</h1>
		<h2><?php echo $home->txtWelcome; ?></h2>

		<div class="botones">
			<a href="<?php echo site_url('Tienda')?>">Tienda Virtual</a>
			<a href="#footer">Conocenos</a>
		</div>

		<div class="social">
			<a href="<?php echo $home->linkFacebook; ?>" target="blank">&#xe0aa;</a>
			<a href="<?php echo $home->linkInstagram; ?>" target="blank">&#xe0b1;</a>
		</div>

	</section>

	<section id="alimentacion">

		<header>
			<h2>Consejos para tu alimentacion diaria</h2>
			<h3><?php echo $home->subAlimentacion; ?></h3>
		</header>

		<div class="carrousel_container">
			<div class="carousel">
				<?php foreach ($alimentacion as $item) : ?>
					<div><img src="<?php echo site_url($dir . $item->imagen) ?>"></div>             			
				<?php endforeach; ?>
			</div>
		</div>

		<footer>
			<nav>
				<a href="#main">inicio</a>
				<!-- <a href="#reciclaje">reciclaje</a> -->
				<a href="#footer">quienes Somos</a>
				<a href="<?php echo site_url('Tienda')?>" target="blank">tienda on line</a>
				<a href="#footer">contacto</a>
			</nav>
		</footer>

	</section>

<!--     <section id="reciclaje">

		<header>
			<div>
				<h2>Tecnicas de Reciclaje</h2>
				<h3><?php// echo $home->subReciclaje; ?></h3>
			</div>
			<nav>
				<a href="#main">inicio</a>
				<a href="#alimentacion">alimentacion</a>
				<a href="#footer">quienes Somos</a>
				<a href="<?php //echo site_url('Tienda')?>" target="blank">tienda on line</a>
				<a href="#footer">contacto</a>
			</nav>            
		</header>

		<div class="bottom">
			<div class="quote">
				<p id="textoTecnica"><span>&#x7b;</span></p>
			</div>
			<ul id="hexGrid">
				<?php //foreach ($reciclaje as $recitem) : ?>
					<li class="hex">
						<a class="hexIn" href="#reciclaje" data-tecnica="<?php// echo $recitem->id; ?>">
							<img src="<?php //echo site_url($dir . $recitem->imagen); ?>" alt="" />
							<h1><?php //echo $recitem->titulo; ?></h1>
							<p><?php //echo $recitem->texto; ?></p>
						</a>
					</li>                    
				<?php //endforeach; ?>
			</ul>
		</div>
	</section> -->
	<section id="faq">
		<div class="column">
			<h2>Como funciona</h2>
			<ol>
				<li>Entra a <a href="<?php echo site_url('Tienda')?>">VQV - Tienda</a> y registrate</li>
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
		</div>
		<span></span>
		<div class="column">
			<h2>Preguntas frecuentes</h2>
			<dl id="preguntas">
			
			</dl>
		</div>
	</section>

	<section id="footer">
		<div class="about">
			<h2>Te contamos</h2>
			<h3><?php echo $home->subAbout; ?></h3>
			<p><?php echo $home->txtAbout; ?></p>
			<a href="#faq" id="getQuestions" >Preguntas Frecuentes</a>
		</div>
		<div class="contacto">
			<div class="menu">
				<a href="#main">Inicio</a>
				<a href="#alimentacion">Alimentacion</a>
				<!-- <a href="#reciclaje">Reciclaje</a> -->
				<a href="<?php echo site_url('Tienda')?>" target="blank">Tienda on line</a>
			</div>
			<div class="info">
				<p>
					Teléfono: (+598) 2204 7844 <br/>
					Montevideo, Uruguay<br/>
					info@vqv.com.uy
				</p>
				<div class="social">
					<a href="<?php echo $home->linkFacebook; ?>" target="blank">&#xe0aa;</a>
					<a href="<?php echo $home->linkInstagram; ?>" target="blank">&#xe0b1;</a>
				</div>
			</div>
			<form id="formContacto" method="post" action="home/suscribir">
				<div id="overlay" data-estado="inactivo">
					<!-- <span>&#xe02d;</span> -->
					<h2></h2>
					<h3>Elige con que frecuencias deseas tener noticias:</h3>
					<select name='option'>
					</select>
					<input type="submit" value="Actualizar" />
				</div>
				<label>Recibi noticias por email</label>
				<input type="text" name="nombre" placeholder="Nombre" required></input>
				<input type="text" name="apellido" placeholder="Apellido" ></input>
				<input type="email" name="email" placeholder="Email" required></input>
				<input type="submit" value="Suscribirse" id="button" />
			</form>
		</div>
	</section>

	<footer>
		<h6>2016 Verde que te Quiero Verde, todos los derechos reservados.</h6>
	</footer>
</div>
<script type="text/template" id="preguntasTemplate">
	<dt>P - {{question}}</dt>
	<dd>R - {{answer}}</dd>
</script>


