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
                            <li><a href="<?php echo base_url(); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
                            <li>Email Template</li>
                        </ul>
                        <h4>
                            <?php
                            if (!empty($email_template)) {
                                echo $email_template[0]['title'];
                            } else {
                                echo "Edit Email-template";
                            }
                            ?>
                        </h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->

            <div class="contentpanel">
                <!--<div class="row row-stat">-->

                <?php echo form_open(base_url('emailformat/update/' . base64_encode($email_template[0]['mail_id'])), array(
                    "id" => "update_page", "class" => "form-horizontal", "name" => "about_us"));
                ?>
                <!--form action="<?php echo base_url('emailformat/update/' . base64_encode($email_template[0]['mail_id'])); ?>"  id="update_page" class="form-horizontal" method="post" name="about_us" -->                            
                <div class="form-group">
                    <label class="col-sm-2 control-label">Title<span class="text-maroon"> *</span></label>
                    <div class="col-sm-8">
                        <input type="text" value="<?php echo $email_template[0]['title']; ?>" class="form-control" name="title" disabled="true" id="title">
                    </div>
                    <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Subject<span class="text-maroon"> *</span></label>
                    <div class="col-sm-8">
                        <input type="text" value="<?php echo $email_template[0]['subject']; ?>" class="form-control" name="subject" id="subject">
                    </div>
                    <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Variables<span class="text-maroon"> *</span></label>
                    <div class="col-sm-8">
                        <label><?php echo $email_template[0]['variables']; ?></label>
                    </div>
                    <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email Format<span class="text-maroon"> *</span></label>
                    <div class="col-sm-8">
                        <textarea style="width:494px;height:233px;margin: 0px -0.015625px 0px 0px;" class="form-control" name="description" id="description" onchange="getinst()"><?php echo trim($email_template[0]['mailformat']); ?></textarea>
<?php echo display_ckeditor($ckeditor); ?>
                    </div>
                    <!--<div class="col-sm-8 pull-right text-red" style="display: none;" id="title_err">Title is required</div>-->
                </div>


                <div class="form-group">
                    <label class="col-sm-4 control-label"> </label>
                    <div class="col-sm-4">
                        <input type="submit" class="btn btn-primary" name="btnsubmit" id="btnsubmit" value="Update">
                        <a class="btn btn-dark" href="<?php echo base_url('emailformat'); ?>" >Cancel</a>
                    </div>
                </div>
                </form>
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

        <script type="text/javascript">
                                $(document).ready(function () {
                                    $('.close').click(function () {
                                        $('.alert').hide();
                                    });
                                    $('#update_page').validate({
                                        debug: false,
                                        ignore: [],
                                        rules: {
                                            title: "required",
                                            subject: "required",
                                            description: {
                                                required: function ()
                                                {
                                                    CKEDITOR.instances.description.updateElement();
                                                }
                                            }

                                        },
                                        messages: {
                                            title: " Email Title is required",
                                            subject: "Email subject is required",
                                            description: {
                                                required: "Mail format is required"
                                            }
                                        },
                                        errorElement: 'div',
                                        errorClass: 'error'

                                    });

                                });

        </script>