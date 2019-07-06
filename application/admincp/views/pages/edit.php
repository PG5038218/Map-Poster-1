<?php echo $header; ?>
<section>
<div class="mainwrapper">
<?php echo $sidebar; ?>
<style type="text/css">
    .error{
        color: maroon;
        font-size: 16px;
    }
    .button{
        text-align: center;
    }
    .text-maroon{
        color: maroon;
    }
</style>

<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                    <li><a href="<?php echo base_url('pages'); ?>">Pages</a></li>
                    <li><?php echo $page_data[0]['page_title']; ?></li>
                </ul>
                <h4><?php echo $page_data[0]['page_title']; ?></h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">
        <!--<div class="row row-stat">-->

                <?php echo form_open('pages/update/'.base64_encode($page_data[0]['pageid']),array(
                    "id"=>"update_page","class"=>"form-horizontal","name"=>"about_us"));?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Page Name<span class="text-maroon"> *</span></label>
                        <div class="col-sm-10">
                            <input type="text" value="<?php echo $page_data[0]['page_title']; ?>" class="form-control" name="page_title" id="page_title" disabled="">
                        </div>
                        <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Page Title</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?php echo $page_data[0]['meta_title']; ?>" class="form-control" name="meta_title" id="meta_title">
                        </div>
                        <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Meta Keyword</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?php echo $page_data[0]['meta_keyword']; ?>" class="form-control" name="meta_keyword" id="meta_keyword">
                        </div>
                        <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Meta Description</label>
                        <div class="col-sm-10">
                            <textarea rows="5" class="form-control" name="meta_description" id="meta_description"><?php echo trim($page_data[0]['meta_description']); ?></textarea>
                        </div>
                    </div>
                    <?php if($page_data[0]['pageid']==1){ ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Short Description</label>
                        <div class="col-sm-10">
                            <textarea rows="5" class="form-control" name="short_description" id="short_description"><?php echo trim($page_data[0]['short_desc']); ?></textarea>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($page_data[0]['pageid']!=3 && $page_data[0]['pageid']!=7 && $page_data[0]['pageid']!=10){ ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description<span class="text-maroon"> *</span></label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" id="description"><?php echo trim($page_data[0]['description']); ?></textarea>
                            
                        </div>
                        <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> </label>
                        <div class="col-sm-4">
                            <input type="submit" class="btn btn-primary" name="btnsubmit" id="btnsubmit" value="Update">
                            <a class="btn btn-dark" href="<?php echo base_url('pages'); ?>" >Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
 </div>
<!--</div>-->
<?php echo $footer; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.close').click(function () {
            $('.alert').hide();
        });
        $('#update_page').validate({
            rules: {
                meta_title: "required",
                description: "required"
            },
            messages: {
                meta_title: "Page Title is required",
                description:"Description is required"
            },
            errorElement: 'div',
            errorClass: 'error',
            highlight: function (element) {
                $(element).parent('div').addClass('error');
            },
            unhighlight: function (element) {
                $(element).parent('div').removeClass('error');
            }
        });
        CKEDITOR.replace('description', 
        {            
            toolbar :
                        [
                            { name: 'document', items : [ 'Source','Preview' ] },
                            { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                            { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
                            { name: 'insert', items : [ 'Image','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'] },
                                    '/',
                            { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
                            { name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
                            { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
                            { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                               { name: 'colors', items : [ 'TextColor','BGColor' ] }, 
                            { name: 'tools', items : [ 'Maximize','-','About' ] } 
                        ]
	});
    });
</script>
