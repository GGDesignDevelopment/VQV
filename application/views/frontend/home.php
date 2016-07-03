<div class="container">
    <section id="main">
        <header>
            <div class="logo">
                <a href="<?php echo site_url()?>"><img src="img/logo2.png"></a>
            </div>
            <nav data-posicion="main">
                <a href="#alimentacion">alimentacion</a>
                <a href="#reciclaje">reciclaje</a>
                <a href="#footer">quienes somos</a>
                <a href="<?php echo site_url('Tienda')?>" target="blank">tienda on line</a>
                <a href="#footer">contacto</a>
            </nav>	
            <div class="pull">
                <h2>Verde que te quiero verde</h2>	
                <a class="responsive" data-posicion="main" href="#">&#x61;</a>
            </div>            
        </header>

        <h1>Verde que te quiero verde</h1>
        <h2><?php echo $home->txtWelcome; ?></h2>

        <div class="botones">
            <a href="<?php echo site_url('Tienda')?>" target="blank">Tienda Virtual</a>
            <a href="#footer">Conocenos</a>
        </div>

        <div class="social">
            <a href="<?php echo $home->linkFacebook; ?>">&#xe0aa;</a>
            <a href="<?php echo $home->linkInstagram; ?>">&#xe0b1;</a>
        </div>

    </section>

    <section id="alimentacion">

        <h2>Consejos Para tu alimentacion Diaria</h2>

        <!--<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus id ultrices justo. Aliquam luctus nulla ac arcu lobortis feugiat. </h3>-->
        <h3><?php echo $home->subAlimentacion; ?></h3>

        <div class="carrousel">
            <?php foreach ($alimentacion as $item) : ?>
                <img src="<?php echo site_url($dir . $item->imagen) ?>">                			
            <?php endforeach; ?>
        </div>

        <nav data-posicion="alimentacion">
            <a href="#main">inicio</a>
            <a href="#reciclaje">reciclaje</a>
            <a href="#footer">quienes Somos</a>
            <a href="<?php echo site_url('Tienda')?>" target="blank">tienda on line</a>
            <a href="#footer">contacto</a>
        </nav>
        <div class="pull">
            <h2>Menu</h2>	
            <a class="responsive" data-posicion="alimentacion" href="#">&#x61;</a>
        </div>
    </section>

    <section id="reciclaje">
        <div class="head">
            <div>
                <h2>Tecnicas de Reciclaje</h2>
                <h3><?php echo $home->subReciclaje; ?></h3>
            </div>
            <nav data-posicion="reciclaje">
                <a href="#main">inicio</a>
                <a href="#alimentacion">alimentacion</a>
                <a href="#footer">quienes Somos</a>
                <a href="<?php echo site_url('Tienda')?>" target="blank">tienda on line</a>
                <a href="#footer">contacto</a>
            </nav>
            <div class="pull">	
                <a class="responsive" data-posicion="reciclaje" href="#">&#x61;</a>
            </div>            
        </div>
        <div class="bottom">
            <div class="quote">
                <span>&#x7b;</span>
                <p id="textoTecnica">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non turpis venenatis, congue ante ac, semper mauris. Nam egestas purus eros, ut tempor erat interdum ac. Sed sem sem, tincidunt id lobortis tincidunt, sodales sit amet odio. Nulla consectetur mattis nulla, vehicula dignissim elit feugiat non. Donec convallis dolor id faucibus porttitor.</p>
            </div>
            <ul id="hexGrid">
                <?php foreach ($reciclaje as $recitem) : ?>
                    <li class="hex">
                        <a class="hexIn" href="#reciclaje" data-tecnica="<?php echo $recitem->id; ?>">
                            <img src="<?php echo site_url($dir . $recitem->imagen); ?>" alt="" />
                            <h1><?php echo $recitem->titulo; ?></h1>
                            <p><?php echo $recitem->texto; ?></p>
                        </a>
                    </li>                    
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <section id="footer">
        <div class="about">
            <h2>Te contamos</h2>
            <h3><?php echo $home->subAbout; ?></h3>
            <p><?php echo $home->txtAbout; ?></p>
            <a href="#">Preguntas Frecuentes</a>
        </div>
        <div class="contacto">
            <div class="menu">
                <a href="#main">Inicio</a>
                <a href="#alimentacion">Alimentacion</a>
                <a href="#reciclaje">Reciclaje</a>
                <a href="<?php echo site_url('Tienda')?>" target="blank">Tienda on line</a>
                <a class="pull" href="#">&#x61;</a>
            </div>
            <div class="info">
                <p>
                    Lorem Ipsum 2313<br/>
                    Montevideo, Uruguay<br/>
                    598 123 123 123<br/>
                    lipsum@vqv.com.uy
                </p>
                <div class="social">
                    <a href="<?php echo $home->linkFacebook; ?>">&#xe0aa;</a>
                    <a href="<?php echo $home->linkInstagram; ?>">&#xe0b1;</a>
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


