<div class="row">
    <div class="page-header col-xs-12 col-sm-offset-2 col-sm-8">
        <h4><?php echo empty($reciclaje->id) ? 'Nueva Técnica' : 'Editar Técnica'; ?></h4>
    </div>
    <div class="col-xs-12 col-sm-offset-3 col-sm-6">
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('', 'role="form"'); ?>
        <div class="form-group">
            <label>Código</label>
            <p class="form-control-static"><?php echo $reciclaje->id; ?></p>	
        </div>
        <div class="form-group">
            <label>Título</label>
            <?php echo form_input('titulo', $reciclaje->titulo, 'class="form-control"'); ?>		
        </div>
        <div class="form-group">
            <label>Subtítulo</label>
            <?php echo form_input('subtitulo', $reciclaje->subtitulo, 'class="form-control"'); ?>		
        </div>
        <div class="form-group">
            <label>Texto</label>
            <?php echo form_textarea('texto', $reciclaje->texto, 'class="form-control"'); ?>		
        </div>
        <div class="form-group">
            <label>Imagen</label>
            <input id="file" type="file" name="file" class="file" data-preview-file-type="any" data-upload-url="#">		
        </div>        
        <div class="form-group pull-right">
            <?php echo form_submit('submit', 'Confirmar', 'class="btn btn-primary"'); ?>
        </div>	
        <?php echo form_close(); ?>
    </div>
</div>