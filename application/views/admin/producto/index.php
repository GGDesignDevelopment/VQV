<h2>Productos</h2>
<!--<div class="form-group">
    <label class="control-label col-md-2">Producto</label>
    <input class="col-md-10" type="text" onkeyup="showResults(this.value)">
</div>-->

<?php echo anchor('admin/producto/edit', '<i class="glyphicon glyphicon-plus"></i> Agregar Producto'); ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Familia</th>
            <th>Presentación</th>
            <th>unidad</th>            
            <th>Precio</th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th></th>
            <th><input id="filtroNombre" class="form-control" type="text" onkeyup="showResults()"></th>
            <th><input id="filtroDescripcion" class="form-control" type="text" onkeyup="showResults()"></th>
            <th><input id="filtroFamilia" class="form-control" type="text" onkeyup="showResults()"></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody id="results">
        <?php if (count($productos)): foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo $producto->prodid; ?></td>
                    <td><?php echo anchor('admin/producto/edit/' . $producto->prodid, $producto->prodnombre); ?></td>	 
                    <td><?php echo $producto->proddes ?></td>	                     
                    <td><?php echo $producto->familia; ?></td>
                    <td><?php echo $producto->prodpresentacion; ?></td>   
                    <td><?php echo get_unidades($producto->produnidad);?></td>                                    
                    <td><?php echo $producto->prodprecio; ?></td>                    
                    <td><?php echo btn_edit('admin/producto/edit/' . $producto->prodid); ?></td>
                    <td><?php echo btn_delete('admin/producto/delete/' . $producto->prodid); ?></td>
                </tr>			
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan=9>No se encontraron productos</td>
            </tr>			
        <?php endif; ?>     
    </tbody>
</table> 
