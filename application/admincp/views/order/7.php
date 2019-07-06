<!DOCTYPE html>
<html>
    <head>
    </head>
    <style>.map-bg-height{width:<?php echo $map['width'] ?>px; height:<?php echo $map['height']; ?>px;
                   background-image:  url("<?php echo $map['staticAPI']; ?><?php echo $map['longitude']; ?>,<?php echo $map['latitude']; ?>,<?php echo $map['zoom']; ?>,<?php echo $map['pitch']; ?>,<?php echo $map['bearing']; ?>/<?php echo $map['imgWidth'] ?>x<?php echo $map['imgHeight'] ?>@2x?access_token=<?php echo $mapboxtoken; ?>&attribution=false&logo=false") !important;
                   background-size: 101% 102%;
                   <?php if ($map['finish'] == 'strict') { ?>
                       box-shadow: 0 0 0 8px #ffffff, 0 0 0 10px #000;
                       border: 10px solid #000000;  
                   <?php } else { ?>
                       border: 10px solid #ffffff;
                   <?php } ?>

        }
    </style>
    <?php if ($map['posterStyle'] == 'white'): ?>
        <style> /**White Text CSS**/
            .map-location{
                float: left;
                bottom: 0px;
                width:100%;
                left:30px;
                /*width:<?php echo $map['width'] - 20 ?>px; 
                height:<?php echo $map['height'] - 20; ?>px*/
            }
            .map-location .white-text-div {
                background: #ffffff;
                width:100%;
                margin-top: <?php echo ($map['orientation'] == 'portrait')?2910:1805 ?><?php //echo ($map['height'] - 1000);   ?>px;
                height:<?php echo ($map['orientation'] == 'portrait')?450:400 ?>px;
            }
            .map-location .city { 
                margin-top:0px; 
                margin-left:50px;
                color: #333;
                font-family: "Oswald,sans-serif";
                font-size: <?php echo ($map['orientation'] == 'portrait')?180:150 ?>px;
                margin-bottom: 0px;
                padding: 2px 5px;
                letter-spacing: -5px;
                text-transform: uppercase;
                padding-left:10px;    
                padding-bottom: 0px;
            }
            .map-location .tag-line {
                margin-left:50px;
                font-family: "Oswald,sans-serif";
                font-size: <?php echo ($map['orientation'] == 'portrait')?90:65 ?>px;
                font-weight: 500;
                line-height: 50px;
                margin-bottom: 25px;
                margin-top: 0px;
                padding: 2px 10px 0px;
                text-transform: uppercase;
            }
            .map-location .des-address {
                margin-top:10px;
                margin-left:50px;
                color: #7c7c7c;
                font-family: "Oswald,sans-serif";
                font-size: <?php echo ($map['orientation'] == 'portrait')?90:65 ?>px;
                margin-bottom: 4px;
                margin-top:-20px;
                padding: 2px 10px 0px;
            }
        </style>    
    <?php endif; ?>
    <?php if ($map['posterStyle'] == 'modern'): ?>
        <style>  /**Modern CSS**/
            .map-location-modern{
                float: left;
                bottom: 0px;
                width:100%;
                left:30px;
                /*width:<?php echo $map['width'] - 20 ?>px; 
                height:<?php echo $map['height'] - 20; ?>px*/
            }

            .map-location-modern .white-text-div {
                background:linear-gradient(top bottom,rgba(255,255,255,0) 0,#fff 40%,#fff 60%) !important; 
                width: 100%;
                text-align:center;
                margin-top:<?php echo ($map['orientation'] == 'portrait')?2740:1570 ?><?php //echo ($map['height'] - 1900); ?>px;
                height:<?php echo ($map['orientation'] == 'portrait')?400:350 ?>px;
            }
            .map-location-modern .city { 
                color: #333333;
                font-family: "Oswald,sans-serif";
                font-size: <?php echo ($map['orientation'] == 'portrait')?150:150 ?>px;
                margin-bottom: 50px;
                padding: 10px 17px;
                text-transform: uppercase; 
                text-align:center;
                font-weight: bold;
                letter-spacing: 75px;
            }
            .map-location-modern .tag-line {
                font-family: "Oswald,sans-serif";
                font-size: <?php echo ($map['orientation'] == 'portrait')?65:65 ?>px;
                font-weight: 500;
                line-height: 15px;
                margin-bottom: 0;
                margin-top: 0;
                padding: 2px 17px 5px;
                text-align: center;
                text-transform: uppercase;
                letter-spacing: 20px;
            }
            .map-location-modern .des-address {
                color: #7c7c7c;
                font-family: "Oswald,sans-serif";
                font-size: <?php echo ($map['orientation'] == 'portrait')?65:65 ?>px;
                margin-top: <?php echo ($map['orientation'] == 'portrait')?90:90 ?>px;
                margin-bottom: 4px;
                padding: 0px 17px 15px; 
                text-align:center
            }
            .border-top-text{
                background: #fff;
                padding-left:27px; 
                color:#333;
                width:100px;
                z-index: 11111;
            }
            .nb {
                background: #000000 none repeat scroll 0 0;
                height: 1px;
                margin-bottom: 23px;
                margin-left: 10% !important;
                margin-right: 10% !important;
                margin-top: <?php echo ($map['orientation'] == 'portrait')?-30:-25 ?>px;
                width: 80%
            }
        </style>    
    <?php endif; ?>
    <?php if ($map['posterStyle'] == 'stricts'): ?>
        <style>
            .map-location-stricts{
                float: left;
                bottom: 0px;
                /*width:<?php echo $map['width'] - 20 ?>px; 
                height:<?php echo $map['height'] - 20; ?>px*/ 
            }
            .map-location-stricts .white-text-div {
                background:#fff;
                float:left;
                width:<?php echo (strlen($map['title']) * (($map['orientation'] == 'portrait')?150:160)); ?>px;
                text-align:center;
                margin-top: <?php echo ($map['orientation'] == 'portrait')?2860:1710 ?>px;
                height: <?php echo ($map['orientation'] == 'portrait')?500:500 ?>px;
            }
            .map-location-stricts .city { 
                color: #333;
                font-family: "Oswald,sans-serif";
                font-size: <?php echo ($map['orientation'] == 'portrait')?180:180 ?>px;
                margin-bottom: 0;
                padding: 10px 17px;
                text-transform: uppercase; 
                text-align:center;
                margin-top: 0px;
            }
            .map-location-stricts .tag-line {
                font-family: "Oswald,sans-serif";
                font-size: <?php echo ($map['orientation'] == 'portrait')?90:90 ?>px;
                font-weight: 500;
                line-height: 15px;
                margin-bottom: 0;
                margin-top: 20px;
                margin-top: 0;
                padding: 25px 17px 0px; 
                text-transform: uppercase; 
                text-align:center;}
            .map-location-stricts .des-address {
                color: #7c7c7c;
                font-family: "Oswald,sans-serif";
                font-size: <?php echo ($map['orientation'] == 'portrait')?90:90 ?>px;
                margin-bottom: 4px;
                margin-top:40px;
                padding:0px 17px 30px;
                text-align:center
            }
        </style>
    <?php endif; ?>
    <body>
        <!-- header -->
        <div class="map-bg-height map-bg f-width h_iframe strict"> 
            <?php if ($map['posterStyle'] == 'white') { ?>
                <div class="map-location">
                    <div class="white-text-div padding-0">
                        <p class="city map_title"><?php echo $map['title']; ?></p>
                        <p class="tag-line map_subtitle"><?php echo $map['subtitle']; ?></p>
                        <p class="des-address map_tagline"><?php echo $map['tagline']; ?></p>
                    </div>
                </div>
            <?php } ?>

            <?php if ($map['posterStyle'] == 'modern') { ?>
                <div class="map-location-modern">
                    <div class="white-text-div padding-0">
                        <p class="city map_title"><?php echo $map['title']; ?></p>
                        <p class="tag-line"><span class="border-top-text">&nbsp;<?php echo $map['subtitle']; ?>&nbsp;&nbsp;&nbsp;</span></p><div class="nb"></div>
                        <p class="des-address map_tagline"><?php echo $map['tagline']; ?></p>
                    </div>
                </div>
            <?php } ?>

            <?php if ($map['posterStyle'] == 'stricts') { ?>
                <div class="map-location-stricts">
                    <div class="white-text-div padding-0">
                        <p class="city map_title"><?php echo $map['title']; ?>&nbsp;</p>
                        <p class="tag-line map_subtitle"><?php echo $map['subtitle']; ?></p>
                        <p class="des-address map_tagline"><?php echo $map['tagline']; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --> 
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
        <!--[if lt IE 9]>
              <script src="js/html5shiv.js"></script>
              <script src="js/respond.min.js"></script>
            <![endif]--> 
        <!-- End Bootstrap JS -->
    </body>
</html>