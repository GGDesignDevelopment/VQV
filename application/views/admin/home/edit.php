<div class="modal-header">
    <h4 class="modal-title">Configuraci&oacuten de Inicio</h4>
</div>
<div class="col-md-12">
    <div class="modal-body">
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('', 'class="form-horizontal" role="form"'); ?>
        <div class="form-group">
            <label class="control-label col-md-2">Link Facebook</label>
            <div class="col-md-10"><?php echo form_input('linkFacebook', $home->linkFacebook, 'class="form-control"'); ?></div>		
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Link Instagram</label>
            <div class="col-md-10"><?php echo form_input('linkInstagram', $home->linkInstagram, 'class="form-control"'); ?></div>		
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Texto Bienvenida</label>
            <div class="col-md-10"><?php echo form_textarea('txtWelcome', $home->txtWelcome, 'class="form-control"'); ?></div>
        </div>	
        <div class="form-group">
            <label class="control-label col-md-2">Subtítulo Alimentación</label>
            <div class="col-md-10"><?php echo form_input('subAlimentacion', $home->subAlimentacion, 'class="form-control"'); ?></div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Subtítulo Reciclaje</label>
            <div class="col-md-10"><?php echo form_input('subReciclaje', $home->subReciclaje, 'class="form-control"'); ?></div>
        </div>	
        <div class="form-group">
            <label class="control-label col-md-2">Subtítulo Sobre Nosotros</label>
            <div class="col-md-10"><?php echo form_input('subAbout', $home->subAbout, 'class="form-control"'); ?></div>
        </div>	
        <div class="form-group">
            <label class="control-label col-md-2">Texto Sobre Nosotros</label>
            <div class="col-md-10"><?php echo form_textarea('txtAbout', $home->txtAbout, 'class="form-control"'); ?></div>
        </div>	    
        <div class="form-group">
            <label class="control-label col-md-2">Alimentacion</label>
            <div class="col-md-10"><input id="files" type="file" name="files[]" class="file" multiple data-preview-file-type="any" data-upload-url="#"></div>
        </div>    
        <div class="form-group pull-right">
            <div class="col-sm-offset-2 col-sm-10">
                <?php echo form_submit('submit', 'Confirmar', 'class="btn btn-primary"'); ?>
            </div>
        </div>	
        <?php echo form_close(); ?>
    </div>
</div>