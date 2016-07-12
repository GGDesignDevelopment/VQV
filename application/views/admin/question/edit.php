<div class="modal-header">
    <h4 class="modal-title"><?php echo empty($question->catid) ? 'Nueva Pregunta' : 'Editar Pregunta'; ?></h4>
</div>
<div class="col-md-12">
    <div class="modal-body">
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('', 'class="form-horizontal" role="form"'); ?>
        <div class="form-group">
            <label class="control-label col-md-2">Código</label>
            <label class="control-label col-md-10"><?php echo $question->id; ?></label>	
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Pregunta</label>
            <div class="col-md-10"><?php echo form_input('question', $question->question, 'class="form-control"'); ?></div>		
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Respuesta</label>
            <div class="col-md-10"><?php echo form_input('answer', $question->answer, 'class="form-control"'); ?></div>		
        </div>

        <div class="form-group pull-right">
            <div class="col-sm-offset-2 col-sm-10">
                <?php echo form_submit('submit', 'Confirmar', 'class="btn btn-primary"'); ?>
            </div>
        </div>	
        <?php echo form_close(); ?>
    </div>
</div>