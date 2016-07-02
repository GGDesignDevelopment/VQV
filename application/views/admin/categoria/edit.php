<div class="modal-header">
    <h4 class="modal-title"><?php echo empty($categoria->catid) ? 'Nueva Familia' : 'Editar Familia';?></h4>
</div>
<div class="col-md-12">
<div class="modal-body">
<?php echo validation_errors();?>
<?php echo form_open_multipart('','class="form-horizontal" role="form"');?>
    <div class="form-group">
        <label class="control-label col-md-2">Código</label>
        <label class="control-label col-md-10"><?php echo $categoria->catid;?></label>	
    </div>
    <div class="form-group">
        <label class="control-label col-md-2">Descripción</label>
        <div class="col-md-10"><?php echo form_input('catdescripcion',$categoria->catdescripcion,'class="form-control"');?></div>		
    </div>
    <div class="form-group pull-right">
        <div class="col-sm-offset-2 col-sm-10">
            <?php echo form_submit('submit','Confirmar','class="btn btn-primary"');?>
        </div>
    </div>	
<?php echo form_close();?>
</div>
</div>