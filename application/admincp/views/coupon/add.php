<?php echo $header; ?>        
<section>
    <div class="mainwrapper">
        <?php echo $sidebar; ?>
        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-qrcode"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href="<?php echo site_url(); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
                            <li><a href="<?php echo site_url('coupon'); ?>">Coupon Codes</a></li>
                            <li>Add</li>
                        </ul>
                        <h4>Coupon Codes</h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->                                       
            <div class="contentpanel">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add Coupon Codes</h4>
                    </div>
                    <?php echo form_open('coupon/add', array('id' => 'frmAdd')); ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Coupon Name</label>
                                    <input type="text" name="name" class="form-control">
                                    <label for="name" class="error"></label>
                                </div><!-- form-group -->
                            </div><!-- col-sm-4 -->
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Discount</label>
                                    <div class="input-group">
                                        <input type="text" name="discount" class="form-control">
                                        <span class="input-group-addon">%</span>
                                    </div>
                                    <label for="discount" class="error"></label>
                                </div><!-- form-group -->
                            </div><!-- col-sm-4 -->
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Expire Date</label>
                                    <div class="input-group">
                                        <input id="expiredate" type="text" name="expiredate" class="form-control" onkeypress="return false;">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <label for="expiredate" class="error"></label>
                                </div><!-- form-group -->
                            </div><!-- col-sm-4-->
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Uses per Code <small>(0 for Unlimited use)</small></label>
                                    <input id="uses" type="text" name="uses" class="form-control" value="0">
                                    <label for="expiredate" class="error"></label>
                                </div><!-- form-group -->
                            </div><!-- col-sm-4-->
                            <div class="col-sm-12 padng_rmv">
                                <div id="code_group" class="form-group">
                                    <label class="col-xs-12 control-label">Coupon Codes <small>(Leave blank to be Generated by System)</small></label>
                                    <div class="form-group col-sm-2">
                                        <div class="input-group">
                                            <input type="text" name="code" class="form-control col-sm-3">
                                            <span class="input-group-btn">
                                                <button type="button" id="btn_add" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i></button>
                                            </span>
                                        </div>
                                        <label for="code" class="error"></label>
                                    </div>

                                    <div class="clearfix"></div>
                                </div><!-- col-sm-3 -->
                            </div>
                        </div><!-- row -->
                    </div><!-- panel-body -->
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a class="btn btn-default" href="<?php echo site_url('coupon'); ?>">Cancel</a>
                    </div><!-- panel-footer -->
                    <?php echo form_close(); ?>
                </div>
            </div><!-- contentpanel -->
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>
<div id="coupon_codes" class="form-group col-sm-2 hidden">
    <div class="input-group">
        <input type="text" name="codes[]" class="form-control col-sm-3">
        <span class="input-group-btn">
            <button type="button" class="btn_remove btn btn-default"><i class="glyphicon glyphicon-remove"></i></button>
        </span>
    </div>
</div>
<?php echo $footer ?>
<script>
    jQuery(document).ready(function () {
        $('.btn_remove').on('click', function () {
            $(this).parent('span.input-group-btn').parent('div.input-group').parent('div.form-group').remove();
        });
        var codeblock = $('#coupon_codes').clone(true, true).removeClass('hidden');
        $('#btn_add').on('click', function () {
            $('#code_group').append(codeblock.clone(true, true));
        });
        $('#expiredate').datepicker({
            dateFormat: "yy-mm-dd",
            showButtonPanel: true
        });
        $('#frmAdd').validate({
            rules: {
                name: "required",
                discount: {required: true, number: true},
                expiredate: "required"
            },
            messages: {
                name: "Enter coupon name",
                discount: {required: "Enter discount", number: "Enter valid discount"},
                expiredate: "Enter expire date"
            }
        });
    });
</script>