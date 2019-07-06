<?php echo $header; ?>
<section>
            <div class="mainwrapper">
                   <?php echo $sidebar; ?>
<style type="text/css">
    .control-label{
        font: bold;
    }
</style>
<?php 
$pageid= base64_decode($this->uri->segment(3));

?>


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
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> <b>Page Title :</b></label>
                        <div class="col-md-8">
                             <?php echo $page_data[0]['page_title']; ?>
                        </div>
                        <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"> <b> Meta title :</b></label>
                        <div class="col-md-8"> <?php echo $page_data[0]['meta_title']; ?>
                        </div>
                        <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> <b>Meta Keyword :</b></label>
                        <div class="col-md-8"><?php echo $page_data[0]['meta_keyword']; ?>
                        </div>
                        <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> <b>Meta Description :</b></label>
                        <div class="col-md-8"> <?php echo trim($page_data[0]['meta_description']); ?>
                        </div>
                    </div>  
                    
                    

                    <div class="form-group">
                        <label class="col-sm-2 control-label"> <b>Description :</b></label>
                         <div class="col-md-8"><?php echo trim($page_data[0]['description']); ?>
                        </div>
                        <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                    </div>
            </div>

 </div>
<!--</div>-->

<script src="<?php echo base_url('../assets/js/jquery-1.11.1.min.js'); ?>"></script>
<script src="<?php echo base_url('../assets/js/jquery-migrate-1.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('../assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('../assets/js/modernizr.min.js'); ?>"></script>
<script src="<?php echo base_url('../assets/js/pace.min.js'); ?>"></script>
<script src="<?php echo base_url('../assets/js/retina.min.js'); ?>"></script>
<script src="<?php echo base_url('../assets/js/jquery.cookies.js'); ?>"></script>
<script src="<?php echo base_url('../assets/js/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('../assets/js/morris.min.js'); ?>"></script>
<script src="<?php echo base_url('../assets/js/raphael-2.1.0.min.js'); ?>"></script>
<script src="<?php echo base_url('../assets/js/bootstrap-wizard.min.js'); ?>"></script>
<script src="<?php echo base_url('../assets/js/select2.min.js'); ?>"></script>
<script src="<?php echo base_url('../assets/js/custom.js'); ?>"></script>
