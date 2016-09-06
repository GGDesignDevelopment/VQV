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
            <label class="control-label col-md-2">Forma de Pago</label>
            <label class="control-label col-md-10"><?php echo ($sale->payment ? get_fp($sale->payment) : '- Sin Forma de Pago -') ; ?></label>	
        </div>        
        <div class="form-group">
            <label class="control-label col-md-2">Entrega</label>
            <div class='input-group date' id='dtp'>
                <input type='text' name='shippingDate' class="form-control" value="<?php echo $sale->shippingDate; ?>"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Estado</label>
            <div class="col-md-4"><?php echo form_dropdown('status', $estados, $sale->status, 'class="form-control"'); ?></div>		
        </div>	
        <h3>Detalle</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="2">Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>                    
                </tr>
            </thead>
            <tbody>
                <?php $total=0; ?>
                <?php if (count($productos)): foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo $producto->productid; ?></td>
                            <td><?php echo $producto->prodnombre; ?></td>	 
                            <td><?php echo $producto->quantity; ?></td>
                            <td><?php echo $producto->productprice; ?></td>   
                            <td><?php echo $producto->subtotal; 
                                $total += $producto->subtotal;
                            ?></td>                                    
                        </tr>			
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan=5>No se encontraron productos</td>
                    </tr>			
                <?php endif;?>     
            </tbody>
        </table> 
        <div class="form-group">
            <label class="control-label col-md-offset-9 col-md-1">TOTAL: </label>
            <label class="control-label col-md-2"><?php echo $total; ?></label>	
        </div>
        <div class="form-group pull-right">
            <div class="col-sm-offset-2 col-sm-10">
                <?php echo form_submit('submit', 'Confirmar', 'class="btn btn-primary"'); ?>
            </div>
        </div>	
        <?php echo form_close(); ?>
    </div>
</div>