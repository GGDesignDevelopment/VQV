<h2>Técnicas de Reciclaje</h2>
<!--<div class="form-group">
    <label class="control-label col-md-2">Categoria</label>
    <input class="col-md-10 form-control" type="text" onkeyup="showResults(this.value)">
</div>-->
<?php echo anchor('admin/reciclaje/edit','<i class="glyphicon glyphicon-plus"></i> Agregar Familia');?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Código</th>
            <th>Título</th>	
            <th></th>	
            <th></th>	            
        </tr>  
<!--        <tr>
            <th></th>
            <th></th>
            <th><input class="form-control" type="text" onkeyup="showResults(this.value)"></th>
        </tr>-->
    </thead>
    <tbody id="results">
    <?php if (count($reciclajes)): foreach ($reciclajes as $reciclaje): ?>
        <tr>
            <td><?php echo $reciclaje->id;?></td>
            <td><?php echo anchor('admin/reciclaje/edit/' . $reciclaje->id, $reciclaje->titulo);?></td>	                       
            <td><?php echo btn_edit('admin/reciclaje/edit/' . $reciclaje->id);?></td>
            <td><?php echo btn_delete('admin/reciclaje/delete/' . $reciclaje->id);?></td>				
        </tr>			
    <?php endforeach;?>
    <?php else: ?>
        <tr>
            <td colspan=4>No se encontraron técnicas de reciclaje</td>
        </tr>			
    <?php endif;?>					
    </tbody>
</table>