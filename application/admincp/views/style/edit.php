<div class="panelt panel-primary">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="panel-title">Edit Poster</h3>
    </div>
    <?php echo form_open('style/edit/'.base64_encode($style['style_id']),array('id'=>'frmedit','enctype'=>'multipart/form-data')); ?>
    <div class="panel-body">
        <img id="imgLogo" src="<?php echo base_url($this->config->item('style_img_upload_path').$style['style_img']); ?>" height="60" width="60" class="pull-right" />
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $style['style_name'] ?>" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Style Logo</label>
                <input type="file" name="logo" id="logo" value="" />
                <label class="control-label">Logo size must be 60x60</label>
                <label for="logo" class="error hide">Please select image only</label>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">Path</label>
                    <input type="text" class="form-control" name="path" id="path" value="<?php echo $style['style_path'] ?>" />
            </div>
        </div>
         <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">Static API Path</label>
                <input type="text" class="form-control" name="api_path" id="api_path" value="<?php echo $style['static_api_path'] ?>" />
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
    $('#logo').change(function(){
        var file=$(this)[0].files[0];
        if(file.type.startsWith("image")){
            $('label[for="logo"]').hide();
            var reader= new FileReader();
            reader.onloadend = function(e){
                    $('#imgLogo').attr('src',e.target.result);
            };
            reader.readAsDataURL(file);
            return;
        }else{
            $(this).val('');
            $(this).clearQueue();
            $('label[for="logo"]').show();
        }
    });
    $('#frmedit').validate({
        rules:{
            name:"required",
            path:"required",
            api_path:"required"
        },
        messages:{
            name:"Please enter style name",
            path:"Please enter style Path",
            api_path:"Please enter style Staic API Path"
        }
    });
</script>