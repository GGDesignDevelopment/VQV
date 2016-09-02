<div class="modal-header">
    <h4 class="modal-title">Venta #<?php echo $sale->id ?></h4>
</div>
<div class="col-md-12">
    <div class="modal-body">
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('admin/sale/save/' . $sale->id, 'class="form-horizontal" role="form"'); ?>
        <div class="form-group">
            <label class="control-label col-md-2">Email</label>
            <label class="control-label col-md-10"><?php echo $sale->email; ?></label>	
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Dirección</label>
            <label class="control-label col-md-10"><?php echo $sale->address; ?></label>	
        </div>        
        <div class="form-group">
            <label class="control-label col-md-2">Entrega</label>
            <div class='input-group date' id='dtp'>
                <input type='text' name='shippingDate' class="form-control" value="<?php echo $sale->shippingDate;?>"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Estado</label>
            <div class="col-md-4"><?php echo form_dropdown('status', $estados, $sale->status, 'class="form-control"'); ?></div>		
        </div>		        
        <div class="form-group pull-right">
            <div class="col-sm-offset-2 col-sm-10">
                <?php echo form_submit('submit', 'Confirmar', 'class="btn btn-primary"'); ?>
            </div>
        </div>	
        <?php echo form_close(); ?>
    </div>
</div>