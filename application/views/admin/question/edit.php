<div class="row">
    <div class="page-header col-xs-12 col-sm-offset-2 col-sm-8">
        <h4><?php echo empty($question->id) ? 'Nueva Pregunta' : 'Editar Pregunta'; ?></h4>
    </div>
    <div class="col-xs-12 col-sm-offset-3 col-sm-6">
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('', 'role="form"'); ?>
        <div class="form-group">
            <label>Código</label>
            <p class="form-control-static"><?php echo $question->id; ?></p>	
        </div>
        <div class="form-group">
            <label>Pregunta</label>
            <?php echo form_input('question', $question->question, 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Respuesta</label>
            <?php echo form_textarea('answer', $question->answer, 'class="form-control"'); ?>
        </div>

        <div class="form-group pull-right">
            <?php echo form_submit('submit', 'Confirmar', 'class="btn btn-primary"'); ?>
        </div>	
        <?php echo form_close(); ?>
    </div>
</div>