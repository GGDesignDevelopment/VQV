<h2>Preguntas</h2>
<!--<div class="form-group">
    <label class="control-label col-md-2">Question</label>
    <input class="col-md-10 form-control" type="text" onkeyup="showResults(this.value)">
</div>-->
<?php echo anchor('admin/question/edit', '<i class="glyphicon glyphicon-plus"></i> Agregar Pregunta'); ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Código</th>
            <th>Pregunta</th>	            
        </tr>  
        <tr>
            <th></th>
            <th><input class="form-control" type="text" onkeyup="showResults(this.value)"></th>
        </tr>
    </thead>
    <tbody id="results">
        <?php if (count($questions)): foreach ($questions as $question): ?>
                <tr>
                    <td><?php echo $question->id; ?></td>
                    <td><?php echo anchor('admin/question/edit/' . $question->id, $question->question); ?></td>	                       
                    <td><?php echo btn_edit('admin/question/edit/' . $question->id); ?></td>
                    <td><?php echo btn_delete('admin/question/delete/' . $question->id); ?></td>				
                </tr>			
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan=4>No se encontraron preguntas</td>
            </tr>			
        <?php endif; ?>					
    </tbody>
</table>