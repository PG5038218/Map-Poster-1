<div class="panelt panel-default">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="panel-title"><?php echo $setting['field_name']; ?></h3>
    </div>
    <?php echo form_open('setting/update',array('id'=>'frmEdit')); ?>
    <input type="hidden" name="setting_id" value="<?php echo base64_encode($setting['setting_id']); ?>" />
    <div class="panel-body">
        <div class="form-group">
            <?php if ($setting['field_name'] == 'Location'): ?>
                <textarea class="form-control" rows="4" name="field_value"><?php echo $setting['field_value']; ?></textarea>
            <?php elseif($setting['field_name'] == 'Printmotor Mode'):  ?>
                <lable for="live"><input type="radio" name="field_value" value="Live" id="live" <?php if($setting['field_value']=='Live'){echo "checked";} ?> /> Live Mode</lable>
                <lable for="test"><input type="radio" name="field_value" value="Test" id="test" <?php if($setting['field_value']=='Test'){echo "checked";} ?> /> Test Mode</lable>
            <?php else: ?>
                <input type="text" class="form-control" name="field_value" value="<?php echo $setting['field_value']; ?>" />
            <?php endif; ?>
        </div>
        <div class="form-group pull-right">
            <input type="submit" class="btn btn-success" value="Update" />
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script>
    jQuery.validator.addMethod("phoneUS", function (phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length <= 20 &&
                    phone_number.match(/[0-9 -()+]+$/);
        }, "");
    $('#frmEdit').validate({
        rules:{
            field_value:{
                required:true<?php if($setting['setting_id']==2): echo ','; ?>
                email:true<?php endif; ?><?php if($setting['setting_id']==3): echo ','; ?>
                phoneUS: true<?php endif; ?>
            }
        },
        messages:{
            field_value:{
                required:"Please enter <?php echo ucfirst($setting['field_name']);?>"<?php if($setting['setting_id']==2): echo ','; ?>
                email:"Please enter valid email"<?php endif; ?><?php if($setting['setting_id']==3): echo ','; ?>
                phoneUS:"Please enter a valid Phone Number."<?php endif; ?>
            }
        }
    });
</script>
