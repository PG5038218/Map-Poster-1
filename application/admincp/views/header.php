<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php if (isset($title)) {echo $title;} ?></title>
        <link href="<?php echo base_url('assets/css/style.default.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/jquery-ui-1.10.3.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/css/style.datatables.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/css/dataTables.responsive.css'); ?>" rel="stylesheet" type="text/css"/>
        <!--<link href="<?php echo base_url('../ckeditor/ckeditor.css'); ?>" rel="stylesheet" type="text/css"/> -->
        <!--link rel="icon" href="<?php echo base_url('assets/images/mapify.ico'); ?>" type="image/ico" sizes="16x16"--> 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <header>
            <div class="headerwrapper">
                <div class="header-left">
                    <a href="<?php echo base_url(); ?>" class="logo">
                        <img class="img img-responsive" src="<?php echo base_url('assets/images/logo_white.png'); ?>" alt="Chain Admin" />
                    </a>
                    <div class="pull-right">
                        <a href="" class="menu-collapse">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div><!-- header-left -->
                <div class="header-right">
                    <div class="pull-right">
                        <!--
                        <div class="btn-group btn-group-list btn-group-notification">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-bell-o"></i>
                              <span class="badge">5</span>
                            </button>
                            <div class="dropdown-menu pull-right">
                                <a href="" class="link-right"><i class="fa fa-search"></i></a>
                                <h5>Notification</h5>
                                <ul class="media-list dropdown-list">
                                    <li class="media">
                                        <img class="img-circle pull-left noti-thumb" src="images/photos/user1.png" alt="">
                                        <div class="media-body">
                                          <strong>Nusja Nawancali</strong> likes a photo of you
                                          <small class="date"><i class="fa fa-thumbs-up"></i> 15 minutes ago</small>
                                        </div>
                                    </li>
                                </ul>
                                <div class="dropdown-footer text-center">
                                    <a href="" class="link">See All Notifications</a>
                                </div>
                            </div><!-- dropdown-menu --
                        </div><!-- btn-group -->                        
                        <!--
                        <div class="btn-group btn-group-list btn-group-messages">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge">2</span>
                            </button>
                            <div class="dropdown-menu pull-right">
                                <a href="" class="link-right"><i class="fa fa-plus"></i></a>
                                <h5>New Messages</h5>
                                <ul class="media-list dropdown-list">
                                    <li class="media">
                                        <span class="badge badge-success">New</span>
                                        <img class="img-circle pull-left noti-thumb" src="images/photos/user1.png" alt="">
                                        <div class="media-body">
                                          <strong>Nusja Nawancali</strong>
                                          <p>Hi! How are you?...</p>
                                          <small class="date"><i class="fa fa-clock-o"></i> 15 minutes ago</small>
                                        </div>
                                    </li>
                                </ul>
                                <div class="dropdown-footer text-center">
                                    <a href="" class="link">See All Messages</a>
                                </div>
                            </div><!-- dropdown-menu --
                        </div><!-- btn-group -->
                        <div class="btn-group btn-group-option">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="<?php echo base_url('dashboard/editProfile'); ?>" data-toggle="modal" data-target="#edit-profile" title="Profile"><i class="fa fa-user"></i>My Profile</a></li>
                                <li><a href="<?php echo base_url('dashboard/changepassword'); ?>" data-toggle="modal" data-target="#change-password" title="Change Password"><i class="fa fa-key"></i> Change Password</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url('logout'); ?>"><i class="fa fa-sign-out"></i>Sign Out</a></li>
                            </ul>
                        </div><!-- btn-group -->
                    </div><!-- pull-right -->
                </div><!-- header-right -->
            </div><!-- headerwrapper -->
        </header>
