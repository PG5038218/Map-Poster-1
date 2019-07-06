<div class="panelt panel-default">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="panel-title"><?php echo $seo['field_name']; ?></h3>
    </div>
    <?php echo form_open('seo/update/'.base64_encode($seo['seo_id']),array('id'=>'frmEdit')); ?>
    <input type="hidden" name="seo_id" value="<?php echo base64_encode($seo['seo_id']); ?>" />
    <div class="panel-body">
        <div class="form-group">
            <textarea class="form-control" name="field_value" rows="5" ><?php echo $seo['field_value']; ?></textarea>
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
                required:true
            }
        },
        messages:{
            field_value:{
                required:"Please enter <?php echo ucfirst($seo['field_name']);?>",
                url:"Please enter valid url"
            }
        }
    });
</script>