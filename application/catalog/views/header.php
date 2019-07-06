<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="theme-color" content="#273E74">
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#273E74">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#273E74">
<meta http-equiv="Content-Security-Policy" content="block-all-mixed-content">
<?php if(isset($meta_title)): ?>
<meta name="title"  content="<?php echo $meta_title; ?>" />
<?php endif; ?>
<?php if(isset($meta_keyword)): ?>
<meta name="keyword" content="<?php echo $meta_keyword; ?>" />
<?php endif; ?>
<?php if(isset($meta_description)): ?>
<meta name="description" content="<?php echo $meta_description; ?>" />
<?php endif; ?>
<title><?php if(isset($meta_title)){echo $meta_title;}else{echo $app_name;}?></title>

<noscript>
            <meta http-equiv="refresh" content="1; URL=<?php echo base_url().'noscript.php' ?>" />
</noscript>

<!-- Bootstrap CSS -->
<link href="<?php echo base_url('css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
<!-- End Bootstrap CSS -->
<link rel="icon" href="<?php echo base_url('img/mapify.ico'); ?>" type="image/ico" sizes="16x16"> 
<!-- custom CSS -->
<link href="<?php echo base_url('css/style.min.css'); ?>" rel="stylesheet" type="text/css" />
<?php if($this->uri->segment(1)=='editor'): ?>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.38.0/mapbox-gl.css' rel='stylesheet' />
<?php endif; ?>
<link href="<?php echo base_url('css/bootstrap-select.min.css'); ?>" rel="stylesheet" type="text/css" />
<!-- Font-awesome css -->
<link href="<?php echo base_url('css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/jquery.bxslider.css'); ?>" rel="stylesheet" />
<!-- Web Font -->
<!-- Google Web fonts -->
<link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Raleway:400,300,100,200,500,600,800,700,900' rel='stylesheet' type='text/css'>
<!-- Raleway font -->
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin,greek-ext,greek,latin-ext,vietnamese' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin,greek-ext,greek,latin-ext,vietnamese' rel='stylesheet' type='text/css'>
<!-- Roboto -->
<?php if($this->uri->segment(1)=='showcase'): ?>
<link href="<?php echo base_url('css/gridGallery.css'); ?>" rel="stylesheet" />
<?php endif; ?>

</head>
<body>
<!-- header -->
<header class="header-inner">
  <div class="container">
    <div class="col-xs-12 padding-0">
        <div class="col-sm-4 col-xs-12 logo padding-0"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('img/logo.png'); ?>" class="img-responsive" alt="" title="" width="251" height="60" /></a> </div>
      <!--<div class="pull-right circle-border"> <a href="#menu" id="toggle"><i class="fa fa-bars"></i><i class="fa fa-times"></i></a>
        <div id="menu">
          <ul>
            <li><a href="<?php echo site_url('home') ?>">Inicio</a></li>
            <li><a href="<?php echo site_url('about') ?>">Quienes somos</a></li>
            <li><a href="<?php echo site_url('showcase'); ?>">Galería</a></li>
            <li><a href="<?php echo site_url('contact') ?>">Contacto</a></li>
	    <li><a href="<?php echo site_url('faq') ?>">Ayuda</a></li>
		<li><a href="<?php echo site_url('blog') ?>">Blog</a></li>
          </ul>
        </div>
      </div> -->
	  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo site_url('home') ?>">Home</a></li>
		<li><a href="<?php echo site_url('about') ?>">ABOUT US</a></li>
		<li><a href="<?php echo site_url('services') ?>">SERVICES</a></li>
		<li><a href="<?php echo site_url('showcase'); ?>">SHOWCASE</a></li>
		<li><a href="<?php echo site_url('contact') ?>">CONTACT US</a></li>
       
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    </div>
  </div>
</header>
<?php if($this->uri->segment(1)=='editor'): ?>
<div class="type" id="location">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-xs-12 center-img padding-0">
                <ul class="nav nav-pills nav-justified thumbnail setup-panel jumper" data-target="#location">
                    <li class="active col-md-1 col-xs-6 pull-left padding-0"><a href="#step-1"> <img src="<?php echo base_url(); ?>img/location-tab.png" title="" class="" alt="" width="40" height="40" />
                            <h4 class="list-group-item-heading display-none">LOCATION</h4>
                        </a></li>
                    <li class="col-md-1 col-xs-6 pull-left padding-0"><a href="#step-2"> <img src="<?php echo base_url(); ?>img/style-tab.png" title="" class="" alt="" width="40" height="40" />
                            <h4 class="list-group-item-heading display-none">STYLE</h4>
                        </a></li>
                    <li class="col-md-1 col-xs-6 pull-left padding-0"><a href="#step-3"> <img src="<?php echo base_url(); ?>img/layout-tab.png" title="" class="" alt="" width="40" height="40" />
                            <h4 class="list-group-item-heading display-none">LAYOUT</h4>
                        </a></li>
                    <li class="col-md-1 col-xs-6 pull-left padding-0"><a href="#step-4"> <img src="<?php echo base_url(); ?>img/cart.png" class="" title="" alt="" width="40" height="40" />
                            <h4 class="list-group-item-heading display-none">PAYMENT</h4>
                        </a></li>
                    <!--li class="col-md-1 col-xs-6 pull-left padding-0"><a href="#step-5"> <img src="<?php echo base_url(); ?>img/payment-tab.png" class="" title="" alt="" width="40" height="40" />
                            <h4 class="list-group-item-heading display-none">Payment</h4>
                        </a></li-->
                </ul>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="bg-inner" id="Location">
