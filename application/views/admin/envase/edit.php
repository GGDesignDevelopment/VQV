<div class="row">
    <div class="page-header col-xs-12 col-sm-offset-2 col-sm-8">
        <h4><?php echo empty($envase->envaseid) ? 'Nuevo Envase' : 'Editar Envase'; ?></h4>
    </div>
    <div class="col-xs-12 col-sm-offset-3 col-sm-6">
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('', 'role="form"'); ?>
        <div class="form-group">
            <label>Código</label>
            <p class="form-control-static"><?php echo $envase->envaseid; ?></p>
        </div>
        <div class="form-group">
            <label>Nombre</label>
            <?php echo form_input('envasenombre', $envase->envasenombre, 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Presentación</label>
            <?php echo form_input('presentacion', $envase->presentacion, 'class="form-control"'); ?>
        </div>

        <div class="form-group">
            <label>Costo</label>
            <div class="input-group">
                <span class="input-group-addon">$</span>
                <?php echo form_input('envasecosto', $envase->envasecosto, 'class="form-control"'); ?>
            </div>
        </div>
        <div class="form-group pull-right">
            <?php echo form_submit('submit', 'Confirmar', 'class="btn btn-primary"'); ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
