<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta content="Mapify.es" name="keywords" />
<meta content="Mapify.es" name="description" />
<meta name="theme-color" content="#273E74">
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />

<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#273E74">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#273E74">
<title>Mapify.es</title>

<!-- End Bootstrap CSS -->

<!-- custom CSS -->
<!--link href="<?php echo base_url("css/style.css"); ?>" rel="stylesheet" type="text/css" /-->
</head>
<style>.map-bg-height{width:1920px; height:2690px;}</style>
<style>
    .map-bg {
    border-color: #ffffff;
    padding: 0;
    margin-top: 0px; 
}
.map-bg.f-width.h_iframe {
    z-index: 11;
}
.h_iframe {
    position: relative;
}
.f-width.h_iframe #map {
    position: absolute;
    top: 0;
    left: 0;
}
.map-location-modern .white-text-div {
    background: linear-gradient(to bottom,rgba(255,255,255,0) 0,#fff 43%,#fff 60%) !important;
    bottom: 3px;
    display: table !important;
    left: 0% !important;
    margin: 0 auto;
    position: absolute;
    right: 0 !important;
    width: 99.6%;
    z-index: 11111;
    text-align: center;
}
.map-location-modern .city {
    color: #333333;
    font-family: "Oswald",sans-serif;
    font-size: 41px;
    margin-bottom: 0;
    padding: 10px 17px;
    text-transform: uppercase;
    text-align: center;
}
.map-location-modern .tag-line {
    font-family: "Oswald",sans-serif;
    font-size: 19px;
    font-weight: 500;
    line-height: 25px;
    margin-bottom: 0;
    margin-top: 0;
    padding: 2px 17px 5px;
    text-align: center;
    text-transform: uppercase;
}
.map-location-modern .des-address {
    color: #7c7c7c;
    font-family: "Oswald",sans-serif;
    font-size: 19px;
    margin-bottom: 4px;
    padding: 2px 17px 8px;
    text-align: center;
}
.map-location-modern .city{font-size: 500% !important; padding:60px 17px !important}
.map-location-modern .des-address{font-size: 200% !important; padding:46px 17px 8px !important;}
.map-location-modern .tag-line{font-size: 200% !important;}
.nb{height: 2px !important;margin-bottom: 23px !important;margin-left: 10% !important;margin-right: 10% !important;margin-top: -68px !important;width: 80% !important;}
</style>
<body>
<!-- header -->
<div class="map-bg-height map-bg f-width h_iframe strict" id="map-new" style="border: 3px solid #000000;"> 
        <div class="map-bg strict" >
            <div id='map' style="background-color: balck;" >
                <img style="margin:0px !important;border-color: red;" height="2690" width="1920" style="border:0;" src="https://api.mapbox.com/styles/v1/mapbox/streets-v8/static/72.70470967927284,19.06570725565807,7.006562529849505,0,0/942x1256@2x?access_token=pk.eyJ1Ijoia2F0aGFrIiwiYSI6ImNpcnJydTlxejBocHh0Y25rMm9rb2k4cGUifQ.jwd-geXu9qd9oRcMqEZGNQ">		
            </div>
            <div class="map-location" style="display:none">
              <div class="white-text-div padding-0">
                <p class="city map_title">New York</p>
                <p class="tag-line map_subtitle">UNITED STATES</p>
                <p class="des-address map_tagline">40.70°N / -73.97°W</p>
              </div>
            </div>
            <div class="map-location-modern" style="">
              <div class="white-text-div padding-0">
                <p class="city map_title">New York</p>
                <p class="tag-line"><span class="border-top-text map_subtitle">UNITED STATES</span></p><div class="nb"></div>
                <p class="des-address map_tagline">40.70°N / -73.97°W</p>
              </div>
            </div>
            <div class="map-location-stricts" style="display:none">
              <div class="white-text-div padding-0">
                <p class="city map_title">New York</p>
                <p class="tag-line map_subtitle">UNITED STATES</p>
                <p class="des-address map_tagline">40.70°N / -73.97°W</p>
              </div>
            </div>
        </div>
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
