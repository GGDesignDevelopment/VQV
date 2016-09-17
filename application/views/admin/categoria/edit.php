<div class="row">
    <div class="page-header col-xs-12 col-sm-offset-2 col-sm-8">
        <h4><?php echo empty($categoria->catid) ? 'Nueva Familia' : 'Editar Familia'; ?></h4>
    </div>
    <div class="col-xs-12 col-sm-offset-3 col-sm-6">
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('', 'role="form"'); ?>
        <div class="form-group">
            <label>Código</label>
            <p class="form-control-static"><?php echo $categoria->catid; ?></p>	
        </div>
        <div class="form-group">
            <label>Descripción</label>
            <?php echo form_input('catdescripcion', $categoria->catdescripcion, 'class="form-control"'); ?>
        </div>
        <div class="form-group pull-right">
            <?php echo form_submit('submit', 'Confirmar', 'class="btn btn-primary"'); ?>
        </div>	
        <?php echo form_close(); ?>
    </div>
</div>