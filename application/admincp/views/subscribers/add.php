<div class="panelt panel-primary">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="panel-title">New Poster</h3>
    </div>
    <?php echo form_open('subscribers/add',array('id'=>'frmSubscribe')); ?>
    <div class="panel-body">
        <div class="col-xs-12">
            <div class="form-group">
                <label class="control-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="" />
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group pull-right">
                <input type="submit" class="btn btn-success" value="Save" />
                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script>
    $('#frmSubscribe').validate({
           rules: {
                email: {
                  required: true,
                  email: true
                }
            },
            messages:{
                email: {
                  required:"Enter email to subscribe.",
                  email: "Enter valid email to subscribe."
                }
            }
      });
</script>
