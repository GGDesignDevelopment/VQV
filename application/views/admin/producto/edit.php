<div class="row">
    <div class="page-header col-xs-12">
        <h4><?php echo empty($producto->prodid) ? 'Nuevo Producto' : 'Editar Producto'; ?></h4>
    </div>
    <?php echo validation_errors(); ?>
    <?php echo form_open_multipart('', 'role="form"'); ?>

    <div class="col-xs-12 col-sm-6">
        <div class="form-group">
            <label>Código</label>
            <p class="form-control-static"><?php echo $producto->prodid; ?></p>	
        </div>
        <div class="form-group">
            <label>Nombre</label>
            <?php echo form_input('prodnombre', $producto->prodnombre, 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Descripcion</label>
            <?php echo form_input('proddes', $producto->proddes, 'class="form-control"'); ?>		
        </div>

        <label>Imagen</label>
        <input id="file" type="file" name="file" class="file" data-preview-file-type="any" data-upload-url="#">		        
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="form-group">
            <label>Familia</label>
            <?php echo form_dropdown('catid', $categorias, $producto->catid, 'class="form-control"'); ?>
        </div>        
        <div class="form-group">
            <label>Presentación</label>
            <?php echo form_input('prodpresentacion', $producto->prodpresentacion, 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Unidad</label>
            <?php echo form_dropdown('produnidad', $unidades, $producto->produnidad, 'class="form-control"'); ?>		
        </div>        
        <div class="form-group">
            <label>Precio</label>
            <div class="input-group">
                <span class="input-group-addon">$</span>
                <?php echo form_input('prodprecio', $producto->prodprecio, 'class="form-control"'); ?>		
            </div>
        </div>
        <div class="form-group">
            <label>¿Granel?</label>
            <?php echo form_checkbox('prodgranel', '1', ($producto->prodgranel == '1')); ?>		
        </div>
        <div class="form-group">
            <label>¿Extranjero?</label>
            <?php echo form_checkbox('prodextranjero', '1', ($producto->prodextranjero == '1')); ?>		
        </div>      
    </div>
    <div class="col-xs-12">
        <div class="form-group pull-right">
            <?php echo form_submit('submit', 'Confirmar', 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
