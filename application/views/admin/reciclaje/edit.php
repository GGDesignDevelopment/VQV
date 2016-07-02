<div class="modal-header">
    <h4 class="modal-title"><?php echo empty($reciclaje->id) ? 'Nueva Técnica' : 'Editar Técnica'; ?></h4>
</div>
<div class="col-md-12">
    <div class="modal-body">
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('', 'class="form-horizontal" role="form"'); ?>
        <div class="form-group">
            <label class="control-label col-md-2">Código</label>
            <label class="control-label col-md-10"><?php echo $reciclaje->id; ?></label>	
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Título</label>
            <div class="col-md-10"><?php echo form_input('titulo', $reciclaje->titulo, 'class="form-control"'); ?></div>		
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Subtítulo</label>
            <div class="col-md-10"><?php echo form_input('subtitulo', $reciclaje->subtitulo, 'class="form-control"'); ?></div>		
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Texto</label>
            <div class="col-md-10"><?php echo form_textarea('texto', $reciclaje->texto, 'class="form-control"'); ?></div>		
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