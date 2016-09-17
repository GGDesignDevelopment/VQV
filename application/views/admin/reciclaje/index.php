<div class="page-header">
    <h2>Técnicas de Reciclaje</h2>
    <?php echo anchor('admin/reciclaje/edit', '<i class="glyphicon glyphicon-plus"></i> Agregar Técnica'); ?>
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Código</th>
                <th>Título</th>	
                <th></th>	
                <th></th>	            
            </tr>  
        </thead>
        <tbody id="results">
            <?php if (count($reciclajes)): foreach ($reciclajes as $reciclaje): ?>
                    <tr>
                        <td><?php echo $reciclaje->id; ?></td>
                        <td><?php echo anchor('admin/reciclaje/edit/' . $reciclaje->id, $reciclaje->titulo); ?></td>	                       
                        <td><?php echo btn_edit('admin/reciclaje/edit/' . $reciclaje->id); ?></td>
                        <td><?php echo btn_delete('admin/reciclaje/delete/' . $reciclaje->id); ?></td>				
                    </tr>			
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan=4>No se encontraron técnicas de reciclaje</td>
                </tr>			
            <?php endif; ?>					
        </tbody>
    </table>
</div>