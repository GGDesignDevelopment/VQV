<div class="page-header">
    <h2>Preguntas Frecuentes</h2>
    <?php echo anchor('admin/question/edit', '<i class="glyphicon glyphicon-plus"></i> Agregar Pregunta'); ?>
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Código</th>
                <th>Pregunta</th>	 
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
</div>