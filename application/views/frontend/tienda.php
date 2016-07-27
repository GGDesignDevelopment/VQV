<div class="contenedor">
    <header>
        <div class="titulo">
            <h1>Tienda OnLine</h1>
            <h2>Verde que te Quiero Verde</h2>
        </div>
        <nav>
            <a href="#">&#xe0aa;</a>
            <a href="#">&#xe0b1;</a>
            <a href="#" class="boton" id="carrito_show">Mi Carrito <span>&#xe015;</span></a>
        </nav>
    </header>
    <div class="contenido">
        <nav id="filtro">
            <a class="filter" href="#" data-categoria="0">Todas las categorias</a>
            <?php if (count($categorias)): foreach ($categorias as $categoria): ?>
                        <a class="filter" href="#" data-categoria="<?php echo $categoria->catid; ?>"><?php echo $categoria->catdescripcion; ?></a>
                 <?php endforeach; ?>
            <?php endif; ?> 
        </nav>
        <div class="productos">
            <div id="col1" class="column"></div>
            <div id="col2" class="column"></div>   
            <div id="col3" class="column"></div>           
        </div>
    </div>
</div>
    <!-- Revisar pa' dinamico  -->
<div id="carrito">
        <a href="index.html">vqv</a>
        <form method="POST" action="cart/login" name="iniciar">
            <h2>Iniciar sesion</h2>
            <input type="email" name="email" placeholder="email" required>
            <input type="password" name="password" placeholder="contrase&ntilde;a"required>
            <input type="submit" value="Ingresar">
        </form>
        <span></span>
        <form method="POST" action="cart/register" name="registrarse">
            <h2>Registrarse</h2>
            <input type="email" name="email" placeholder="email" required>
            <input type="password" name="password" placeholder="contrase&ntilde;a"required>
            <input type="text" name="name" placeholder="Nombre y Apellido" required>
            <input type="text" name="phone" placeholder="Telefono">
            <input type="text" name="address" placeholder="Direccion">
            <input type="submit" value="Registrarse">
        </form>
       <!--  <form method="POST" action="#">
            <h2>Nombre usuario</h2>
            <div class="direccion">Direccion</div>
            <fieldset>
                <legend><a href="#" class="x">&#xe019;</a></legend>
                <p>Nombre del Producto.</p>
                <div>
                    <input type="text" name="cantidad" placeholder="300gr.">
                    <span>$300</span>
                </div>
            </fieldset>
            <fieldset>
                <legend><a href="#" class="x">&#xe019;</a></legend>
                <p>Nombre del Producto.</p>
                <div>
                    <input type="text" name="cantidad" placeholder="300gr.">
                    <span>$300</span>
                </div>
            </fieldset>
            <fieldset>
                <legend><a href="#" class="x">&#xe019;</a></legend>
                <p>Nombre del Producto.</p>
                <div>
                    <input type="text" name="cantidad" placeholder="300gr.">
                    <span>$300</span>
                </div>
            </fieldset>
            <fieldset>
                <legend><a href="#" class="x">&#xe019;</a></legend>
                <p>Nombre del Producto.</p>
                <div>
                    <input type="text" name="cantidad" placeholder="300gr.">
                    <span>$300</span>
                </div>
            </fieldset>
            <a class="boton" href="#">Confirmar compra</a>
        </form> -->
    </div>
    <template id="prodTemplate">
        <div class="prod">
            <img src="img/{{prodimagen}}" title="{{prodnombre}}">
            <a href="#" class="expandir" data-producto="{{prodid}}">{{prodnombre}}<span>&#x33;</span></a>
            <form id="{{prodid}}" method="POST" action="" class="oculto">
                <div>
                    <!-- {{#granel}}
                        <select name="envase">
                            <option selected disabled>Tipo de envase</option>
                            <option value="1">Bolsa de papel</option>
                            <option value="2">Envase de vidrio nuevo</option>
                            <option value="3">Intercambio envase</option>
                        </select>
                    {{/granel}} -->
                    <input type="number" name="cantidad" placeholder="cantidad">
                    <span>{{produnidad}}</span>
                </div>
                <p>{{proddes}}</p>
                <input type="hidden" name="id" value="{{prodid}}" >
                <input type="submit" name="prodid" value="Agregar al" data-icon="&#xe015;">
            </form>
            
        </div>
    </template>
