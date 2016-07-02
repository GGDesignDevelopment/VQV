<div class="modal-header">
    <h4 class="modal-title"><?php echo empty($user->email) ? 'Nuevo Usuario' : 'Editar Usuario';?></h4>
</div>
<div class="col-md-8">
<div class="modal-body">
<?php echo validation_errors();?>
<?php echo form_open('','class="form-horizontal" role="form"');?>
    <div class="form-group">
        <label class="control-label col-md-3">Email</label>
        <div class="col-md-9"><?php echo form_input('email',$user->email,'class="form-control"');?></div>
    </div>	
    <div class="form-group">
        <label class="control-label col-md-3">Nombre</label>
        <div class="col-md-9"><?php echo form_input('name',$user->name,'class="form-control"');?></div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Password</label>
        <div class="col-md-9"><?php echo form_password('password','','class="form-control"');?></div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Confirmar Password</label>
        <div class="col-md-9"><?php echo form_password('password_confirm','','class="form-control"');?></div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Tipo</label>
        <div class="col-md-9"><?php echo form_dropdown('type',$tipos,$user->type,'class="form-control"');?></div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3">Teléfono</label>
        <div class="col-md-9"><?php echo form_input('phone',$user->phone,'class="form-control"');?></div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Dirección</label>
        <div class="col-md-9"><?php echo form_input('address',$user->address,'class="form-control"');?></div>
    </div>    
    <div class="form-group pull-right">
        <div class="col-sm-offset-2 col-sm-10">
            <?php echo form_submit('submit','Confirmar','class="btn btn-primary"');?>
        </div>
    </div>	
<?php echo form_close();?>
</div>
</div>