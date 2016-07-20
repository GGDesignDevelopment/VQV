<h2>Familias</h2>
<?php echo anchor('admin/categoria/edit', '<i class="glyphicon glyphicon-plus"></i> Agregar Familia'); ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Código</th>
            <th>Descripción</th>
            <th></th>
            <th></th> 
        </tr>  
        <tr>
            <th></th>
            <th><input class="form-control" type="text" onkeyup="showResults(this.value)"></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody id="results">
        <?php if (count($categorias)): foreach ($categorias as $categoria): ?>
                <tr>
                    <td><?php echo $categoria->catid; ?></td>
                    <td><?php echo anchor('admin/categoria/edit/' . $categoria->catid, $categoria->catdescripcion); ?></td>	                       
                    <td><?php echo btn_edit('admin/categoria/edit/' . $categoria->catid); ?></td>
                    <td><?php echo btn_delete('admin/categoria/delete/' . $categoria->catid); ?></td>				
                </tr>			
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan=4>No se encontraron Familias</td>
            </tr>			
        <?php endif; ?>					
    </tbody>
</table>