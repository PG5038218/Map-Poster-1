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
<?php if(isset($meta_title)): ?>
<meta content="<?php echo $meta_title; ?>" name="title"/>
<?php endif; ?>
<?php if(isset($meta_keyword)): ?>
<meta content="<?php echo $meta_keyword; ?>" name="keyword"/>
<?php endif; ?>
<?php if(isset($meta_description)): ?>
<meta content="<?php echo $meta_description; ?>" name="description"/>
<?php endif; ?>
<title><?php if(isset($meta_title)){echo $meta_title;}else{echo $app_name;}?></title>

<noscript>
    <meta http-equiv="refresh" content="1; URL=<?php echo base_url().'noscript.php' ?>" />
</noscript>
<!-- Bootstrap CSS -->
<link href="<?php echo base_url('css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
<!-- End Bootstrap CSS -->

<!-- custom CSS -->
<link href="<?php echo base_url('css/style.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />

<!-- Web Font -->
<!-- Google Web fonts -->
<link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Raleway:400,300,100,200,500,600,800,700,900' rel='stylesheet' type='text/css'>
<!-- Raleway font -->
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin,greek-ext,greek,latin-ext,vietnamese' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin,greek-ext,greek,latin-ext,vietnamese' rel='stylesheet' type='text/css'>
<!-- Roboto -->
<link href="<?php echo base_url('css/gridGallery.css'); ?>" rel="stylesheet" />
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
<div class="bg-inner" id="Location">
    <div class="container">
    <div class="row"><br><br>
        <div class="bg_white cms-font">
            <?php echo $pagecontent; ?>
            <div class="col-xs-12 padding-0">
                <div data-directory="gallery" id="grid">
                &nbsp;</div>
            </div>
        </div>
    </div>
</div>
    
<div class="footer-top">
    <div class="container">
      <div class="row">
        <p class="pull-left share"></p>
        <ul class="socail fl-left top-o">
            <?php if($sem[0]['status']=='Enable'){ ?><li><a target="_blank" href="<?php echo $sem[0]['field_value'] ?>" class="facebook" title="Facebook"><i class="fa fa-facebook"></i></a></li><?php } ?>
            <?php if($sem[1]['status']=='Enable'){ ?><li><a target="_blank" href="<?php echo $sem[1]['field_value'] ?>" class="twitter" title="twitter"><i class="fa fa-twitter"></i></a></li><?php } ?>
            <?php if($sem[2]['status']=='Enable'){ ?><li><a target="_blank" href="<?php echo $sem[2]['field_value'] ?>" class="google-plus" title="google-plus"><i class="fa fa-google-plus"></i></a></li><?php } ?>
            <?php if($sem[3]['status']=='Enable'){ ?><li><a target="_blank" href="<?php echo $sem[3]['field_value'] ?>" class="pinterest" title="pinterest"><i class="fa fa-pinterest-p"></i></a></li><?php } ?>
            <?php if($sem[4]['status']=='Enable'){ ?><li><a target="_blank" href="<?php echo $sem[4]['field_value'] ?>" class="behance" title="instagram"><i class="fa fa-instagram"></i></a></li><?php } ?>
            <?php if($sem[5]['status']=='Enable'){ ?><li><a target="_blank" href="<?php echo $sem[5]['field_value'] ?>" class="linkedin" title="linkedin"><i class="fa fa-linkedin"></i></a></li><?php } ?>
        </ul>
        <div class="clearfix"></div>
        <br>
        <br>
        <br>
        <span class="sm-text sm-text-inner">Copyright <?php echo date('Y'); ?> &copy; All Rights Reserved - MyJourneyMap</span>
        <ul class="footer-link">
              <li><a href="<?php echo site_url('services') ?>">Services</a></li>
              <li><a href="<?php echo site_url('showcase') ?>">Showcase</a></li>
              <li><a href="<?php echo site_url('contactus') ?>">Contact US</a></li>
              <li><a href="<?php echo site_url('faq') ?>">FAQ</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
    <!-- SCRIPTS FOR FOR THE PLUGIN-->
    <script src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/mapify.js"></script>
    <script src="<?php echo base_url(); ?>js/rotate-patch.js"></script>
    <script src="<?php echo base_url(); ?>js/waypoints.min.js"></script> <!-- if you wont use the Lazy Load feature erase this line -->
    <script src="<?php echo base_url(); ?>js/autoGrid.min.js"></script>

    <script>
      $(function(){
            //INITIALIZE THE PLUGIN
            $('#grid').grid({
                categoriesOrder: 'byName', //byDate, byDateReverse, byName, byNameReverse, random
                imagesOrder: 'byDate', //byDate, byDateReverse, byName, byNameReverse, random
                isFitWidth: true, //Nedded to be true if you wish to center the gallery to its container
                lazyLoad: true, //If you wish to load more images when it reach the bottom of the page
                showNavBar: false, //Show the navigation bar?
                smartNavBar: false, //Hide the navigation bar when you don't have categories or just 1
                imagesToLoadStart: 15, //The number of images to load when it first loads the grid
                imagesToLoad: 5, //The number of images to load when you click the load more button
                aleatoryImagesFromCategories: true,//Get few images from each category if not it will get them in order
                horizontalSpaceBetweenThumbnails: 15, //The space between images horizontally
                verticalSpaceBetweenThumbnails: 15, //The space between images vertically
                columnWidth: 'auto', //The width of each columns, if you set it to 'auto' it will use the columns instead
                columns: 5, //The number of columns when you set columnWidth to 'auto'
                columnMinWidth: 220, //The minimum width of each columns when you set columnWidth to 'auto'
                isAnimated: true, //Animation when resizing or filtering with the nav bar
                caption: false, //Show the caption in mouse over
                captionCategory: false,//Show the category section of the caption
                captionType: 'classic', // 'grid', 'grid-fade', 'classic' the type of caption effect
                lightBox: true, //Do you want the lightbox?
                lightboxKeyboardNav: true, //Keyboard navigation of the next and prev image
                lightBoxSpeedFx: 600, //The speed of the lightbox effects
                lightBoxZoomAnim: true, //Do you want the zoom effect of the images in the lightbox?
                lightBoxText: false, //If you wish to show the text in the lightbox
                lightboxPlayBtn: true, //Show the play button?
                lightBoxAutoPlay: false, //The first time you open the lightbox it start playing the images
                lightBoxPlayInterval: 4000, //The interval in the auto play mode 
                lightBoxShowTimer: true, //If you wish to show the timer in auto play mode
                lightBoxStopPlayOnClose: false, //Stop the auto play mode when you close the lightbox?
            });
      });
    </script>
    <?php 
foreach($seo as $script){
    if($script['status']=='Enable'){
        echo $script['field_value'];
    }
}
?>
</body>
</html>