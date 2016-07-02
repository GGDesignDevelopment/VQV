<div class="contenedor">
    <header>
        <div class="titulo">
            <h1>Tienda OnLine</h1>
            <h2>Verde que te Quiero Verde</h2>
        </div>
        <nav>
            <a href="#">&#xe0aa;</a>
            <a href="#">&#xe0b1;</a>
            <a href="#" class="boton" >Mi Carrito <span>&#xe015;</span></a>
        </nav>
    </header>
    <div class="contenido">
        <div class="menu">
            <h2>Categorias</h2>
            <nav>
                <button class="button checked" data-categoria="todos">Todas las categorias<span></span></button>
                <?php if (count($categorias)): foreach ($categorias as $categoria): ?>
                        <button class="button" data-categoria="almacen"><?php echo $categoria->catdescripcion; ?><span></span></button>
                    <?php endforeach; ?>
                <?php endif; ?>	
            </nav>
        </div>
        <div class="productos">
            <?php for ($i=0; $i < count($productos); $i++): ?>
                    <div class="column">
                        <?php if (count($productos[$i])): foreach ($productos[$i] as $producto): ?>
                                <div class="prod">
                                    <img src="<?php echo site_url($dir . $producto->prodimagen); ?>" title="Algo" />
                                    <span>
                                        <h2><?php echo $producto->prodnombre; ?></h2>
                                        <a href="#" class="expandir" data-producto="<?php echo $producto->prodid;?>">&#x33;</a>
                                    </span>
                                    <form id="<?php echo $producto->prodid;?>" class="oculto">
                                        <div>
                                            <label>Cantidad </label>
                                            <input type="number" name="cantidad" placeholder="gr">
                                        </div>
                                        <p><?php echo $producto->proddes; ?></p>
                                        <input type="submit" name="agregar" value="Agregar al carrito" data-icon="&#xe015;">
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>	                
                    </div>
                <?php endfor; ?>	                
<!--
            <div class="column">
            </div>
            <div class="column">
            </div>-->
        </div>
    </div>
</div>
