<div class="row">
    <div class="page-header col-xs-12">
        <h4>Configuraci&oacuten de Inicio</h4>
    </div>

    <?php echo validation_errors(); ?>
    <?php echo form_open_multipart('', 'role="form"'); ?>
    <div class="col-xs-12 col-sm-7">
        <div class="form-group">
            <label>Link Facebook</label>
            <?php echo form_input('linkFacebook', $home->linkFacebook, 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Link Instagram</label>
            <?php echo form_input('linkInstagram', $home->linkInstagram, 'class="form-control"'); ?>
        </div>

        <div class="form-group">
            <label>Subtítulo Reciclaje</label>
            <?php echo form_input('subReciclaje', $home->subReciclaje, 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Subtítulo Sobre Nosotros</label>
            <?php echo form_input('subAbout', $home->subAbout, 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Subtítulo Alimentación</label>
            <?php echo form_input('subAlimentacion', $home->subAlimentacion, 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Mail Envios</label>
            <?php echo form_input('mailEnvio', $home->mailEnvio, 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Mail Ventas</label>
            <?php echo form_input('mailVenta', $home->mailVenta, 'class="form-control"'); ?>
        </div>
    </div>
    <div class="col-xs-12 col-sm-5">
        <div class="form-group">
            <label>Texto Bienvenida</label>
            <?php echo form_textarea('txtWelcome', $home->txtWelcome, 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Texto Sobre Nosotros</label>
            <?php echo form_textarea('txtAbout', $home->txtAbout, 'class="form-control"'); ?>
        </div>
    </div>
    <div class="form-group col-xs-12">
        <label>Alimentacion</label>
        <input id="files" type="file" name="files[]" class="file" multiple data-preview-file-type="any" data-upload-url="#">
    </div>
    <div class="col-xs-12">
        <div class="form-group pull-right ">
            <?php echo form_submit('submit', 'Confirmar', 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
