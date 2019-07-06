<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content="#273E74">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#273E74">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta http-equiv="Content-Security-Policy" content="block-all-mixed-content">
        <?php if (isset($meta_title)): ?>
            <meta content="<?php echo $meta_title; ?>" name="title"/>
        <?php endif; ?>
        <?php if (isset($meta_keyword)): ?>
            <meta content="<?php echo $meta_keyword; ?>" name="keyword"/>
        <?php endif; ?>
        <?php if (isset($meta_description)): ?>
            <meta content="<?php echo $meta_description; ?>" name="description"/>
        <?php endif; ?>
        <title><?php echo (isset($meta_title)) ? $meta_title : ''; ?></title>
        <noscript>
        <meta http-equiv="refresh" content="1; URL=<?php echo base_url() . 'noscript.php' ?>" />
        </noscript>
        <!-- Bootstrap CSS -->
        <link href="<?php echo base_url('css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- End Bootstrap CSS -->
        <!-- custom CSS -->
        <link href="<?php echo base_url('css/style.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Font-awesome css -->
        <link href="<?php echo base_url('css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('css/jquery.bxslider.css'); ?>" rel="stylesheet" />

        <link rel="icon" href="<?php echo base_url('img/mapify.ico'); ?>" type="image/ico" sizes="16x16"> 
        <!-- Web Font -->
        <!-- Google Web fonts -->
        <link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,100,200,500,600,800,700,900' rel='stylesheet' type='text/css'>
        <!-- Raleway font -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin,greek-ext,greek,latin-ext,vietnamese' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin,greek-ext,greek,latin-ext,vietnamese' rel='stylesheet' type='text/css'>
        <!-- Roboto -->
    </head>
    <body>
        <!-- header -->
        <header class="header">
            <div class="col-xs-12 padding-0 mrg-30 lft-pad">

<!--<div class="pull-right circle-border"> <a href="#menu" id="toggle" ><i class="fa fa-bars"></i><i class="fa fa-times"></i></a>
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
</div>-->
                <nav class="navbar navbar-default">

                    <div class="col-sm-4 col-xs-12 logo padding-0"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('img/logo.png') ?>" class="img-responsive" alt="" title="" width="379" height="109" /></a> </div>
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

                </nav>
            </div>
            <div class="">
                <div class="">
                    <div class="col-md-4 col-xs-12 padding-left-0 padding-right-0 "> <img src="<?php echo base_url(); ?>img/circle-img.png" class="img-responsive pull-left max-img" alt="" title="" width="374" height="374" /> </div>
                    <div class="col-md-8 col-xs-12 top-set">
                        <p class="map-poster">Lorem ipsum dolor sit</p>
                        <span>Lorem ipsum dolor sit amet ipsum</span>

                        <br>
                         <!-- <p class="center-img"><img src="<?php echo base_url(); ?>img/down.png" class="img-responsive" alt="" title="" width="42" height="67" /></p>
                       <div class="text-center"><section class="content" id="section11">
                            <div class="slideshow slideshow--11" data-effect="fx11">
                                <div class="slide slide--current"><h2 class="title barcelona">Madrid</h2></div>
                                <div class="slide"><h2 class="title barcelona">Barcelona</h2></div>
                                <div class="slide"><h2 class="title barcelona">Sevilla</h2></div>
                                <div class="slide"><h2 class="title barcelona">Valencia</h2></div>
                                <div class="slide"><h2 class="title barcelona">Malaga</h2></div>
                                <div class="slide"><h2 class="title barcelona">Bilbao</h2></div>
                            </div>
                        </section>
                        </div> -->
                        <div>
                            <?php echo form_open('editor', array('class' => 'form-inline Subscribe-form', 'id' => 'frmLocation')); ?>
                            <div class="form-group pull-left full-width">
                                <input type="text" placeholder="Enter Your City" id="address" name="address" class="form-control">
                                <input type="hidden" name="output" />
                            </div>
                            <button class="btn btn-default" type="submit">Create Poster</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="col-xs-12">
                        <p class="des"><?php echo $short_desc; ?></p>
                    </div>
                </div>
            </div>
        </header>
        <!-- End header -->
        <?php echo $pagecontent; ?>
        <section class="col-xs-12 padding-0 bg-green">


            <div class="gray-bg ft-rmvmargin">

                <?php echo form_open('', array('class' => 'form-inline ft-rmvmargin', 'id' => 'frmSubscription')); ?>
                <div class="form-group pull-left full-width">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your emil address">
                </div>
                <button type="button" class="btn btn-default" id="subsribe">Subscribe Now</button>
                <label for="email" class="error"></label>
                <?php echo form_close(); ?>

            </div>


        </section>
    </section>
    <footer class="bg-green">
        <div class="container">
            <div class="row">

                <ul class="socail">
                    <?php if ($sem[0]['status'] == 'Enable') { ?><li><a target="_blank" href="<?php echo $sem[0]['field_value'] ?>" class="facebook" title="Facebook"><i class="fa fa-facebook"></i></a></li><?php } ?>
                    <?php if ($sem[1]['status'] == 'Enable') { ?><li><a target="_blank" href="<?php echo $sem[1]['field_value'] ?>" class="twitter" title="twitter"><i class="fa fa-twitter"></i></a></li><?php } ?>
                    <?php if ($sem[2]['status'] == 'Enable') { ?><li><a target="_blank" href="<?php echo $sem[2]['field_value'] ?>" class="google-plus" title="google-plus"><i class="fa fa-google-plus"></i></a></li><?php } ?>
                    <?php if ($sem[3]['status'] == 'Enable') { ?><li><a target="_blank" href="<?php echo $sem[3]['field_value'] ?>" class="pinterest" title="pinterest"><i class="fa fa-pinterest-p"></i></a></li><?php } ?>
                    <?php if ($sem[4]['status'] == 'Enable') { ?><li><a target="_blank" href="<?php echo $sem[4]['field_value'] ?>" class="behance" title="instagram"><i class="fa fa-instagram"></i></a></li><?php } ?>
                    <?php if ($sem[5]['status'] == 'Enable') { ?><li><a target="_blank" href="<?php echo $sem[5]['field_value'] ?>" class="linkedin" title="linkedin"><i class="fa fa-linkedin"></i></a></li><?php } ?>
                </ul>
                <ul class="footer-link contact-footer">
                    <li>Phone : 1800 1800 18 </li>&nbsp;&nbsp;
                    <li>Email : info@mxicoders.com</li>


                </ul>

                <ul class="footer-link">
                    <li><a href="<?php echo site_url('services') ?>">Services</a></li>
                    <li><a href="<?php echo site_url('showcase') ?>">Showcase</a></li>
                    <li><a href="<?php echo site_url('contactus') ?>">Contact US</a></li>
                    <li><a href="<?php echo site_url('faq') ?>">FAQ</a></li>
                </ul>
                            <div class=""> <!--<span class="sm-text">Copyright 2016 © All Rights Reserved - mapify.es</span> -->
                    <p class="sm-text design-text">Design and Development by  <a href="http://www.mxicoders.com" target="_blank">mxicoders.com</a></p>
                </div>
            </div>
        </div>
    </footer>



    <script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.min.js') ?>"></script> 
    <script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js') ?>"></script> 
    <script type="text/javascript" src="<?php echo base_url('js/jquery.bxslider.min.js') ?>"></script> 
    <script src="<?php echo base_url(); ?>js/jquery.validate.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo $GOOGLE_API_KEY; ?>"></script> 
    <!-- <script type="text/javascript" src="<?php echo base_url('js/charming.min.js') ?>"></script> 
    <script type="text/javascript" src="<?php echo base_url('js/anime.min.js') ?>"></script> 
    <script type="text/javascript" src="<?php echo base_url('js/textfx.js') ?>"></script> -->
    <script src="<?php echo base_url(); ?>js/mapify.js"></script>
    <?php
    if (!isset($_COOKIE['mapify_cookie'])) {
        ?>
        <script type="text/javascript">
            function SetCookie(c_name, value, expiredays)
            {
                var exdate = new Date();
                exdate.setDate(exdate.getDate() + expiredays);
                document.cookie = c_name + "=" + escape(value) + ";path=/" + ((expiredays == null) ? "" : ";expires=" + exdate.toUTCString());
            }
        </script>
    <?php } ?>
    <?php
    if (!isset($_COOKIE['mapify_cookie'])) {
        ?>
        <div id="cookie-notification" class="cookie-notice-container">
            <span id="cn-notice-text">Utilizamos cookies para asegurar que damos la mejor experiencia al usuario en nuestro sitio web. Si continúa utilizando este sitio asumiremos que está de acuerdo.</span><a href="#" id="cn-accept-cookie" data-cookie-set="accept" class="cn-set-cookie button bootstrap">Estoy de acuerdo</a>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                if (document.cookie.indexOf("mapify_cookie") === -1) {
                    $("#cookie-notification").show();
                } else {
                    $("#cookie-notification").remove();
                }
                $('#cn-accept-cookie').on('click', function (e) {
                    e.preventDefault();
                    SetCookie('mapify_cookie', 'mapify_cookie', 365);
                    $("#cookie-notification").remove();
                });
            });

        </script>
    <?php } ?>
    <script>
        $('.bxslider').bxSlider({
            mode: 'fade',
            captions: true
        });
        $('#frmSubscription').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: "Ingresa tu email para suscribirte.",
                    email: "Ingresa un email valido para suscribirte."
                }
            }
        });
        $('#subsribe').on('click', function (e) {
            $(this).prop('disabled', true);
            e.preventDefault();
            if ($('#frmSubscription').valid()) {
                $.ajax({
                    method: "POST",
                    url: "<?php echo base_url('subscribe'); ?>",
                    data: {email: $('#email').val()},
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {
                            $('#email').val('');
                        }
                        alert(data.message);
                        $(this).prop('disabled', false);
                    }
                });
            }
        });
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('address'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var queryParameter = {};
                var place = places.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }
                var address = place.address_components;
                var cnt = address.length - 1;
                for (i = cnt; i >= 0; i--) {
                    if (address[i].types[0] == 'country') {
                        $('#frmLocation').append('<input type="hidden" name="country" value="' + address[i].long_name + '" />');
                        $('#frmLocation').append('<input type="hidden" name="countryCode" value="' + address[i].short_name.toString().toLowerCase() + '" />');
                    } else if (address[i].types[0] == 'administrative_area_level_1') {
                        $('#frmLocation').append('<input type="hidden" name="param" value="' + address[i].long_name + '" />');
                    } else if (address[i].types[0] == 'administrative_area_level_2') {
                        $('#frmLocation').append('<input type="hidden" name="param" value="' + address[i].long_name + '" />');
                    } else if (address[i].types[0] == 'locality') {
                        $('#frmLocation').append('<input type="hidden" name="param" value="' + address[i].long_name + '" />');
                    }
                }
                $('#frmLocation').submit();
            });
        });

    </script>
    <?php
    foreach ($seo as $script) {
        if ($script['status'] == 'Enable') {
            echo $script['field_value'];
        }
    }
    ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --> 
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
    <!--[if lt IE 9]>
          <script src="<?php echo base_url(); ?>js/html5shiv.js"></script>
          <script src="<?php echo base_url(); ?>js/respond.min.js"></script>
        <![endif]--> 
    <!-- End Bootstrap JS -->

</body>
</html>
