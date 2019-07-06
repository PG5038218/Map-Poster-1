<div class="panelt panel-default">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="panel-title"><?php echo $sem['field_name']; ?></h3>
    </div>
    <?php echo form_open('sem/update',array('id'=>'frmEdit')); ?>
    <input type="hidden" name="sem_id" value="<?php echo base64_encode($sem['sem_id']); ?>" />
    <div class="panel-body">
        <div class="form-group">
                <input type="text" class="form-control" name="field_value" value="<?php echo $sem['field_value']; ?>" />
        </div>
        <div class="form-group pull-right">
            <input type="submit" class="btn btn-success" value="Update" />
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script>
    $('#frmEdit').validate({
        rules:{
            field_value:{
                required:true,
                url:true
            }
        },
        messages:{
            field_value:{
                required:"Please enter <?php echo ucfirst($sem['field_name']);?>",
                url:"Please enter valid url"
            }
        }
    });
</script>