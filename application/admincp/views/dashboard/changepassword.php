<div class="panelt panel-default">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="panel-title">Edit Profile</h3>
    </div>
    <?php echo form_open('dashboard/changepassword',array('id'=>'frmEdit')); ?>
    <div class="panel-body">
        <div class="form-group">
            <label class="control-label col-md-3">Old Password</label>
            <div class="col-md-9">
                <input type="password" class="form-control" name="old_password" value="" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">New Password</label>
            <div class="col-md-9">
                <input type="password" class="form-control" name="new_password" value="" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Confirm Password</label>
            <div class="col-md-9">
                <input type="password" class="form-control" name="confirm_password" value="" />
            </div>
        </div>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-success" value="Change" />
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script>
    $('#frmEdit').validate({
        rules:{
            old_password:"required",
            new_password:"required",
            confirm_password:"required"
        },
        messages:{
            old_password:"Enter current password",
            new_password:"Enter new passoerd",
            confirm_password:"Enter Confirm password"
        }
    });
</script>