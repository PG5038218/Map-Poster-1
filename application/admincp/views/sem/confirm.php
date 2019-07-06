<div class="panelt panel-default">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="panel-title"><?php echo $sem['field_name']; ?></h3>
    </div>
    <?php echo form_open('sem/change_status',array('id'=>'frmEdit')); ?>
    <input type="hidden" name="sem_id" value="<?php echo base64_encode($sem['sem_id']); ?>" />
    <div class="panel-body">
        <h5>Are you sure you want to change status of <?php echo $sem['field_name']; ?>?</h5>
        <div class="pull-right">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <?php if($sem['status']=='Enable'): ?>
            <button type="submit" class="btn btn-danger">Yes</button>
            <?php else: ?>
            <button type="submit" class="btn btn-success">Yes</button>
            <?php endif; ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>