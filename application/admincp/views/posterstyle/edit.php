<div class="panelt panel-default">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="panel-title"><?php echo $style['style_name']; ?></h3>
    </div>
    <?php echo form_open('posterstyle/update',array('id'=>'frmEdit')); ?>
    <input type="hidden" name="style_id" value="<?php echo base64_encode($style['style_id']); ?>" />
    <div class="panel-body">
        <div class="form-group">
                <input type="text" class="form-control" name="style_value" value="<?php echo $style['style_value']; ?>" />
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
            style_value:{
                required:true
            }
        },
        messages:{
            style_value:{
                required:"Please enter <?php echo ucfirst($style['style_name']);?>",
            }
        }
    });
</script>