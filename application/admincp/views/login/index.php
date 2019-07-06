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
            <div class="container">
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
</div>				
                <div class="panel panel-signin">
                    <div class="panel-body">
                        <div class="logo text-center">
                            <img src="<?php echo base_url('assets/images/login_logo.png'); ?>" alt="Chain Admin" >
                        </div>
                        <br />
                        <div class="mb10"></div>
                        <?php echo form_open('login/authenticate', array('id' => 'loginfrm', 'class' => 'form-horizontal login_frm tp_mrgn4', 'role' => 'form')); ?>
                        <label for="username" class="error" style="color:red;display:none"></label>
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" id="username" name="user_name" placeholder="Username">
                        </div><!-- input-group -->
                        <label for="password" class="error" style="color:red;display:none"></label>
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div><!-- input-group -->
                        
                        <div class="clearfix">
                            <div class="pull-left">
                                <div class="ckbox ckbox-primary mt10">
                                    <input type="checkbox" name="rememberMe" id="rememberMe" value="1">
                                    <label for="rememberMe">Remember Me</label>
                                </div>
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success">Sign In <i class="fa fa-angle-right ml5"></i></button>
                            </div>
                        </div>                      
                        <?php
                        echo form_close();
                        ?>  
                    </div><!-- panel-body -->
                    <div class="panel-footer">
                        <a data-href="<?php echo site_url('Forgotpassword'); ?>" title="Forgot your password?" data-toggle="modal" data-target="#confirm-status" href="#" class="btn btn-primary btn-block">Forgot your Password?</a>
                    </div><!-- panel-footer -->
                   </div><!-- panel -->
                   
                   <div class="modal fade" id="confirm-status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="confirm_status_title">Forgot your password?</h4>
                                </div>
                                <?php echo form_open('login/forgotpassword','class="form-horizontal" id="forgotfrm"'); ?>
                                <div class="modal-body" id="confirm_status_body">
                                    <label for="forgot_email" class="error" style="color:red;display:none">&nbsp;</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">&nbsp;Email&nbsp;&nbsp;</span>
                                        <input type="text" maxlength="70" class="form-control" name="forgot_email" id="forgot_email" placeholder="Email" value="">
                                    </div>
                                    <div class="input-group">                            
                                    </div>  
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="Send" class="btn btn-success" >
                                </div>
                                <?php echo form_close(); ?> 
                            </div>
                        </div>
                    </div>
                    </section>
                    <script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/js/jquery-migrate-1.2.1.min.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/js/modernizr.min.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/js/pace.min.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/js/retina.min.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/js/jquery.cookies.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
                    <script type="text/javascript">
                                $(document).ready(function (){
                                    $('#confirm-status').on('show.bs.modal', function (e) {
                                        $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
                                    });
                                });
                    </script> 
                    <script>
                        $(document).ready(function () {
                            $("#loginfrm").validate({
                                rules: {
                                    user_name: {
                                        required: true

                                    },
                                    password: {
                                        required: true

                                    }
                                },
                                messages:{
                                    user_name: {
                                        required: "User name is required "
                                    },
                                    password: {
                                        required: "Password is required"
                                    }
                                }
                            });
                        });
                    </script>
                    <script>
                        $(document).ready(function () {
                            $("#forgotfrm").validate({
                                rules: {
                                    forgot_email: {
                                        required: true,
                                        email: true
                                    },
                                },
                                messages:{
                                    forgot_email: {
                                        required: "Email is required ",
                                        email: "Please enter Valid email"
                                    }
                               }
                            });
                        });
                    </script>
                </body>
            </html>
