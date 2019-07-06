<div class="panelt panel-primary">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="panel-title">Edit Coupon code: <?php echo $coupon['coupon_code']; ?></h3>
    </div>
    <?php echo form_open('coupon/edit/'.base64_encode($coupon['coupon_id']),array('id'=>'frmedit')); ?>
    <div class="panel-body">
        <div class="col-md-6">
             <div class="form-group">
                <label class="control-label">Coupon Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $coupon['coupon_name'] ?>">
                <label for="name" class="error"></label>
            </div><!-- form-group -->
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Discount</label>
                <div class="input-group">
                    <input type="text" name="discount" class="form-control" value="<?php echo $coupon['discount'] ?>">
                    <span class="input-group-addon">%</span>
                </div>
                <label for="discount" class="error"></label>
            </div><!-- form-group -->
        </div>
        <div class="col-md-6">
             <div class="form-group">
                <label class="control-label">Expire Date</label>
                <div class="input-group">
                    <input id="expiredate" type="text" name="expiredate" class="form-control" value="<?php echo date('Y-m-d',strtotime($coupon['expired_datetime'])); ?>" onkeypress="return false;">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
                <label for="expiredate" class="error"></label>
            </div><!-- form-group -->
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-xs-12 control-label">Uses per code <small>(0 for Unlimited use)</small></label>
                <input type="text" name="uses" class="form-control col-sm-3" value="<?php echo $coupon['total_use'] ?>">
                <label for="code" class="error"></label>
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
     jQuery(document).ready(function(){
         $('#expiredate').datepicker({
            dateFormat: "yy-mm-dd",
            showButtonPanel: true
        });
        $('#frmAdd').validate({
            rules:{
                name:"required",
                discount:{required:true,number:true},
                expiredate:"required"
            },
            messages:{
                name:"Enter coupon name",
                discount:{required:"Enter discount",number:"Enter valid discount"},
                expiredate:"Enter expire date"
            }
        });
    });
</script>