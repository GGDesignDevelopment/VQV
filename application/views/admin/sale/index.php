<div class="page-header">
    <h2>Ventas</h2>
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
<!--            <tr>
                <th>Código</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Entrega</th>
                <th>Estado</th>            
                <th></th>
                <th></th> 
            </tr>  -->
            <tr>
                <th>Código</th>
                <th><input id="email" class="form-control" type="text" onkeyup="showResults()" placeholder="Email"></th>
                <th>Dirección</th>
                <th><div class='input-group date' id='dtp'>
                        <input id="fecha" type='text' class="form-control" value=""/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div></th>
                <th><select id="status" class="form-control" type="text" onchange="showResults()" >
                        <option value="P">Pendiente</option>
                        <option value="C">Coordinado</option>
                        <option value="E">Entregado</option>
                    </select></th>
                <th></th> 
                <th></th>
            </tr>
        </thead>
        <tbody id="results">
            <?php if (count($sales)): foreach ($sales as $sale): ?>
                    <tr>
                        <td><?php echo anchor('admin/sale/edit/' . $sale->id, $sale->id); ?></td>	    
                        <td><?php echo $sale->email; ?></td>
                        <td><?php echo $sale->address; ?></td>
                        <td><?php echo $sale->shippingDate; ?></td>
                        <td><?php echo get_status($sale->status); ?></td>
                        <td><?php echo btn_edit('admin/sale/edit/' . $sale->id); ?></td>
                        <td><?php echo btn_delete('admin/sale/delete/' . $sale->id); ?></td>				
                    </tr>			
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan=7>No se encontraron Ventas</td>
                </tr>			
            <?php endif; ?>					
        </tbody>
    </table>
</div>