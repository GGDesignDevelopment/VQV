<div class="modal-header">
    <h4 class="modal-title">Login</h4>
</div>
<div class="modal-body">
<?php echo validation_errors();?>
<?php echo form_open('','class="form-horizontal" role="form"');?>
    <div class="form-group">
        <label class="control-label col-sm-2">Email</label>
        <div class="col-md-10"><?php echo form_input('email','','class="form-control"');?></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Password</label>
        <div class="col-md-10"><?php echo form_password('password','','class="form-control"');?></div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php echo form_submit('submit','log in','class="btn btn-primary btn-block"');?>
        </div>
    </div>	
<?php echo form_close();?>
</div>
