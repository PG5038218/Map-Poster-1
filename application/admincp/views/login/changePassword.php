<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo $title; ?></title>
		<!--link rel="icon" href="<?php echo base_url('assets/images/favicon-1.ico'); ?>" type="image/ico" sizes="16x16"--> 
        <link href="<?php echo base_url('assets/css/style.default.css'); ?>" rel="stylesheet">
       
    </head>
    <body class="signin">
        <section>
            <div class="row">
		<div class="col-sm-4"></div>
                <div class="col-xs-12 col-sm-4">
                    <div class="catm-alert-msg">
                        <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success">
                                <button type="button" class="close" onclick="closediv()" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong><?php echo $this->session->flashdata('success'); ?></strong> 
                            </div>

                        <?php } ?>
                        <?php if ($this->session->flashdata('error')) { ?>
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="closediv()">&times;</button>
                               <strong> <?php echo $this->session->flashdata('error'); ?> </strong>
                            </div>

                        <?php } ?>
                        <?php if ($this->session->flashdata('info')) { ?>
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong><?php echo $this->session->flashdata('info'); ?> </strong>
                            </div>
                        <?php } ?>
                    </div>
                   </div>
		<div class="col-sm-4"></div>
                </div>    
                <div class="panel panel-signin">
                    <div class="panel-body">
                        <div class="logo text-center">
                            <img src="<?php echo base_url('assets/images/login_logo.png'); ?>" alt="Chain Admin" >
                        </div>
                        <div>
                            <span></span>
                        </div>
                        <div class="mb30"></div>
                        <?php echo form_open($this->uri->uri_string(), array('id' => 'changepasswd', 'class' => 'form-horizontal login_frm tp_mrgn4', 'role' => 'form')); ?>
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" placeholder="New Password"  name="password" id="password" >
                        </div><!-- input-group -->
                        <div>&nbsp;
                            <label for="password" class="error"></label>
                        </div>
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Confirm Password" name="cnfpassword" id="cnfpassword">
                        </div><!-- input-group -->
                        <div>
                            &nbsp;
                            <label for="cnfpassword" class="error"></label>
                        </div>
                          
                    </div><!-- panel-body -->
                    <div class="panel-footer">
                        <input type="submit" class="btn btn-block btn-primary" value="Chnage Password" />
                    </div><!-- panel-footer -->
                    <?php
                        echo form_close();
                        ?>
                   </div><!-- panel -->
                    </section>
                    <script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/js/jquery.validate.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/js/jquery-migrate-1.2.1.min.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/js/modernizr.min.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/js/pace.min.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/js/retina.min.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/js/jquery.cookies.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

                    
                    <script>
                        $(document).ready(function () {

                            $("#changepasswd").validate({
                                rules: {
                                    password: {
                                        required: true
                                    },
                                    cnfpassword: {
                                        required: true,
                                        equalTo:"#password"
                                    }
                                },
                                messages:
                                        {
                                            password:{
                                                required: "New Password is required "

                                            },
                                            cnfpassword: {
                                                required: "Confirm Password is required",
                                                equalTo:"Confirm Password must mach with New Passowrd"
                                            }

                                        },
                            });
                        });
                    </script>

                    <script>
                        $(document).ready(function () {

                            $("#forgotfrm").validate({
                                rules: {
                                    forgot_email: {
                                        required: true,
                                        email: true,
                                        remote: {
                                            url: "<?php echo site_url('ForgotPassword/emailExist') ?>",
                                            type: "post",
                                            data: {
                                                forgot_email: function () {
                                                    return $("#forgot_email").val();
                                                },
                                                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                                            }
                                        }

                                    }
                                },
                                messages:
                                        {
                                            forgot_email: {
                                                required: "Email is required ",
                                                email: "Enter Valid EmailId",
                                                remote: "Email id not exits"
                                            }

                                        },
                            });
                        });
                    </script>
                    <script type="text/javascript">
                        function closediv()
                        {
                            $(".closediv").hide();
                        }
                    </script> 


                    </body>
                    </html>
