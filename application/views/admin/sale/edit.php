<div class="row">
    <div class="page-header col-xs-12 col-sm-offset-1 col-sm-10">
        <h4>Venta #<?php echo $sale->id ?></h4>
    </div>

    <?php echo validation_errors(); ?>
    <?php echo form_open_multipart('admin/sale/save/' . $sale->id, 'role="form"'); ?>
    
    <div class="col-xs-12 col-sm-offset-2 col-sm-4">
        <div class="form-group">
            <label>Email</label>
            <p class="form-control-static"><?php echo $sale->email; ?></p>	
        </div>
        <div class="form-group">
            <label>Dirección</label>
            <p class="form-control-static"><?php echo $sale->address; ?></p>	
        </div>
        <div class="form-group">
            <label>Forma de Pago</label>
            <p class="form-control-static"><?php echo ($sale->payment ? get_fp($sale->payment) : '- Sin Forma de Pago -'); ?></p>	
        </div>        
    </div> 
    <div class="col-xs-12 col-sm-4">   
        <div class="form-group">
            <label>Entrega</label>
            <div class='input-group date' id='dtp'>
                <input type='text' name='shippingDate' class="form-control" value="<?php echo $sale->shippingDate; ?>"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label>Estado</label>
            <?php echo form_dropdown('status', $estados, $sale->status, 'class="form-control"'); ?>
        </div>
    </div>
    <div class="col-xs-12">
        <h3>Detalle</h3>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th colspan="2">Producto</th>
                    <th>Envase</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>                    
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php if (count($productos)): foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo $producto->productid; ?></td>
                            <td><?php echo $producto->prodnombre; ?></td>	 
                            <td><?php echo ($producto->envase ? get_envases($producto->envase) : '- SIN ENVASE -'); ?></td>	 
                            <td><?php echo $producto->quantity; ?></td>
                            <td><?php echo '$'. $producto->productprice; ?></td>   
                            <td><?php
                                echo '$' . $producto->subtotal;
                                $total += $producto->subtotal;
                                ?></td>                                    
                        </tr>			
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan=6>No se encontraron productos</td>
                    </tr>			
                <?php endif; ?>     
            </tbody>
        </table>
    </div>
    <div class="col-xs-12 ">
        <div class="form-group pull-right">
            <label>TOTAL: $ <?php echo $total; ?></label>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="form-group pull-right">            
            <?php echo form_submit('submit', 'Confirmar', 'class="btn btn-primary"'); ?>            
        </div>	
        <?php echo form_close(); ?>
    </div>  
</div>