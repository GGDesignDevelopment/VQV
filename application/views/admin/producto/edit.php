<div class="modal-header">
    <h4 class="modal-title"><?php echo empty($producto->prodid) ? 'Nuevo Producto' : 'Editar Producto'; ?></h4>
</div>
<div class="col-md-12">
    <div class="modal-body">
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('', 'class="form-horizontal" role="form"'); ?>
        <div class="form-group">
            <label class="control-label col-md-2">Código</label>
            <label class="control-label col-md-10"><?php echo $producto->prodid; ?></label>	
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Nombre</label>
            <div class="col-md-10"><?php echo form_input('prodnombre', $producto->prodnombre, 'class="form-control"'); ?></div>		
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Descripcion</label>
            <div class="col-md-10"><?php echo form_input('proddes', $producto->proddes, 'class="form-control"'); ?></div>		
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Familia</label>
            <div class="col-md-10"><?php echo form_dropdown('catid',$categorias,$producto->catid,'class="form-control"');?></div>
        </div>        
        <div class="form-group">
            <label class="control-label col-md-2">Presentación</label>
            <div class="col-md-10"><?php echo form_input('prodpresentacion', $producto->prodpresentacion, 'class="form-control"'); ?></div>		
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Unidad</label>
            <div class="col-md-10"><?php echo form_dropdown('produnidad', $unidades, $producto->produnidad, 'class="form-control"'); ?></div>		
        </div>        
        <div class="form-group">
            <label class="control-label col-md-2">Precio</label>
            <div class="col-md-10"><?php echo form_input('prodprecio', $producto->prodprecio, 'class="form-control"'); ?></div>		
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Imagen</label>
            <div class="col-md-10"><input id="file" type="file" name="file" class="file" data-preview-file-type="any" data-upload-url="#"></div>		
        </div>        
        <div class="form-group pull-right">
            <div class="col-sm-offset-2 col-sm-10">
                <?php echo form_submit('submit', 'Confirmar', 'class="btn btn-primary"'); ?>
            </div>
        </div>	
        <?php echo form_close(); ?>
    </div>
</div>