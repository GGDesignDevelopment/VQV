<div class="modal-header">
	<h4 class="modal-title">Contacto #<?php echo $contacto->id?></h4>
</div>
<div class="col-md-8">
<div class="modal-body">
<?php echo validation_errors();?>
<?php echo form_open('admin/contacto/save/' . $contacto->id,'class="form-vertical" role="form"');?>
	<div class="form-group">
		<label class="control-label col-md-2">Creado</label>
		<p class="col-md-10"><?php echo $contacto->creado;?></p>		
	</div>
	<div class="form-group">
		<label class="control-label col-md-2">Nombre</label>
		<p class="col-md-10"><?php echo $contacto->nombre;?></p>
	</div>	
	<div class="form-group">
		<label class="control-label col-md-2">Email</label>
		<p class="col-md-10"><?php echo $contacto->email;?></p>
	</div>		
	<div class="form-group">
		<label class="control-label col-md-2">Celular</label>
		<p class="col-md-10"><?php echo $contacto->celular;?></p>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2">Texto</label>
		<p class="col-md-10"><?php echo $contacto->texto;?></p>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2">Estado</label>
		<div class="col-md-4"><?php echo form_dropdown('estado',$estados,$contacto->estado,'class="form-control"');?></div>		
	</div>		
	<div class="form-group ">
		<div class=" col-sm-10">
			<?php echo form_submit('submit','Confirmar','class="btn btn-primary"');?>
		</div>
	</div>	
<?php echo form_close();?>
</div>
</div>