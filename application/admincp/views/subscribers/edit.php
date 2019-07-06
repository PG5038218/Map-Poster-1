<div class="panelt panel-primary">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="panel-title">Edit Poster</h3>
    </div>
    <?php echo form_open('poster/edit/'.base64_encode($poster['poster_id']),array('id'=>'frmedit')); ?>
    <div class="panel-body">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $poster['poster_name'] ?>" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Price</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-eur"></i></span>
                    <input type="text" class="form-control" name="price" value="<?php echo $poster['poster_price'] ?>" />
                </div>
                <label for="price" class="error" style="display: none"></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Height</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="height" value="<?php echo $poster['poster_height'] ?>" />
                    <span class="input-group-addon">cm</span>
                </div>
                <label for="height" class="error" style="display: none"></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Width</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="width" value="<?php echo $poster['poster_width'] ?>" />
                    <span class="input-group-addon">cm</span>
                </div>
                <label for="width" class="error" style="display: none"></label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">Printmotor Name</label>
                <input type="text" class="form-control" name="printmotorid" id="width" value="<?php echo $poster['printmotorid'] ?>" />
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
    $('#frmedit').validate({
        rules:{
            name:"required",
            price:"required",
            height:{required:true,digit:true},
            width:{required:true,digit:true}
        },
        messages:{
            first_name:"Please enter poster name",
            last_name:"Please enter poster price",
            height:{required:"Please enter height"},
            width:{required:"Please enter width"}
        }
    });
</script>
