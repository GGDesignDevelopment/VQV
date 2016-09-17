<div class="row">
    <div class="page-header col-xs-12 col-sm-offset-2 col-sm-8">
        <h4><?php echo empty($user->email) ? 'Nuevo Usuario' : 'Editar Usuario'; ?></h4>
    </div>    
    <div class="col-xs-12 col-sm-offset-3 col-sm-6">
        <?php echo validation_errors(); ?>
        <?php echo form_open('', 'role="form"'); ?>
        <div class="form-group">
            <label>Email</label>
            <p class="form-control-static"><?php echo $user->email; ?></p>
        </div>	
        <div class="form-group">
            <label>Nombre</label>
            <?php echo form_input('name', $user->name, 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Password</label>
            <?php echo form_password('password', '', 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Confirmar Password</label>
            <?php echo form_password('password_confirm', '', 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Tipo</label>
            <?php echo form_dropdown('type', $tipos, $user->type, 'class="form-control"'); ?>
        </div>

        <div class="form-group">
            <label>Teléfono</label>
            <?php echo form_input('phone', $user->phone, 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Dirección</label>
            <?php echo form_input('address', $user->address, 'class="form-control"'); ?>
        </div>    
        <div class="form-group ">
            <div class="pull-right">
                <?php echo form_submit('submit', 'Confirmar', 'class="btn btn-primary"'); ?>
            </div>
        </div>	
        <?php echo form_close(); ?>
    </div>
</div>