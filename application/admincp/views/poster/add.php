<div class="panelt panel-primary">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="panel-title">New Poster</h3>
    </div>
    <?php echo form_open('poster/add', array('id' => 'frmAdd')); ?>
    <div class="panel-body">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Price</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-eur"></i></span>
                    <input type="text" class="form-control" name="price" id="price" value="" />
                </div>
                <label for="price" class="error" style="display: none"></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Width</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="width" id="width" value="" />
                    <span class="input-group-addon">Inch</span>
                </div>
                <label for="width" class="error" style="display: none"></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Height</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="height" id="height" value="" />
                    <span class="input-group-addon">Inch</span>
                </div>    
                <label for="height" class="error" style="display: none"></label>
            </div>
        </div>

        <!--div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Display in</label>
                <select name="version" id="version" class="form-control">
                    <option value="V1">Editor</option>			
                    <option value="V2">Editor V2</option>
                </select>
                <label for="version" class="error" style="display: none"></label>
            </div>
        </div-->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">API Product ID</label>
                <input type="text" class="form-control" name="printmotorid" id="width" />
            </div>
        </div>
        <!--div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Landscape api name</label>
                <input type="text" class="form-control" name="printmotorid2" id="width" />
            </div>
        </div-->
        <div class="col-md-6">
            <div class="form-group pull-right mt20">
                <input type="submit" class="btn btn-success mt5" value="Save" />
                <button class="btn btn-default mt5" data-dismiss="modal">Cancel</button>
            </div>
        </div>

    </div>
    <?php echo form_close(); ?>
</div>
<script>
    $('#frmAdd').validate({
        rules: {
            name: "required",
            price:
                    {
                        required: true,
                        digit: true,
                        maxlength: 9,
                    },
            height:
                    {
                        required: true,
                        digit: true,
                        maxlength: 5,
                    },
            width:
                    {
                        required: true,
                        digit: true,
                        maxlength: 5, },
            ratio: "required",
            printmotorid: "required",
            printmotorid2: "required"
        },
        messages: {
            name: "Please enter poster name",
            price: {
                required: "Please enter poster price",
                digit: "Height Should be allow in digit.",
                maxlength: "allow only 9 digit",
            },
            height: {required: "Please enter height", digit: "Height Should be allow in digit.", maxlength: "allow only 5 digit", },
            width: {required: "Please enter width", digit: "Width Should be allow in digit.", maxlength: "allow only 5 digit", },
            ratio: "Please enter poster aspect ratio",
            printmotorid: "Please enter printmotor potrait name",
            printmotorid2: "Please enter printmotor lanscape name"
        },
    });
</script>
