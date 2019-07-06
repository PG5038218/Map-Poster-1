<!DOCTYPE html>
<html>
<head>
<title>Create Image Demo</title>

<!-- custom CSS -->
<link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet" type="text/css" />
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.23.0/mapbox-gl.css' rel='stylesheet' />
<link href="<?php echo base_url('css/bootstrap-select.min.css'); ?>" rel="stylesheet" type="text/css" />
<!-- Font-awesome css -->
<link href="<?php echo base_url('css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/jquery.bxslider.css'); ?>" rel="stylesheet" />
<!-- Web Font -->
<!-- Google Web fonts -->
<link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,100,200,500,600,800,700,900' rel='stylesheet' type='text/css'>
<!-- Raleway font -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin,greek-ext,greek,latin-ext,vietnamese' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin,greek-ext,greek,latin-ext,vietnamese' rel='stylesheet' type='text/css'>
<!-- Roboto -->

</head>
<style>
    body{overflow: hidden}
    /*#loader{
        position: absolute;
        height: 100%;
        width:100%;
        z-index:99;
        background-color: #FFFFFF;
    }*/
    .map-bg-height{width:960px; height:1280px;}
    .loader{display: block!important;background-color: #FFFFFF !important;}
</style>
<body>
<!-- header -->
<div class="loader"><table><tbody><th><strong style="color: #000;font-size: 25px;padding: 20px;">Por favor espera mientras procesamos tu pedido. Gracias....</strong><br/><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></table></tbody></th></div>
<div class="bg-inner" id="Location">
  <div class="container cstm-container">
    <div id="mapContainer">
      <div class="col-md-8 center-map-new" id="mapContainer1">
        <div class="map-bg map-bg-height col-xs-11 f-width h_iframe" id="map-new"> 
            <img class="ratio" id="3x4-portrait" width="3" height="4" src="<?php echo base_url(); ?>img/3X4-portrait.png" style="display:none"/> 
            <img class="ratio" id="3x4-landscape" width="4" height="3" src="<?php echo base_url(); ?>img/4X3-landscapet.png" style="display:none" />
            <div class="">
                <div id='map'></div>
            </div>
            <div class="map-location poster-title" id="map-location" style="display:none">
                <div class="white-text-div padding-0">
                    <p class="city map_title"></p>
                    <p class="tag-line map_subtitle"></p>
                    <p class="des-address map_tagline"></p>
                </div>
            </div>
            <div class="map-location-modern poster-title" id="map-location-modern" style="display:none">
                <div class="white-text-div padding-0">
                    <p class="city map_title"></p>
                    <p class="tag-line"><span class="border-top-text map_subtitle"></span></p><div class="nb"></div>
                    <p class="des-address map_tagline"></p>
                </div>
            </div>
            <div class="map-location-stricts poster-title" id="map-location-stricts" style="display:none">
                <div class="white-text-div padding-0">
                    <p class="city map_title"></p>
                    <p class="tag-line map_subtitle"></p>
                    <p class="des-address map_tagline"></p>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="imgMap"></div>
<script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script> 
<script src='<?php echo base_url(); ?>js/bootstrap-select.js'></script>
<script src="<?php echo base_url(); ?>js/jquery.validate.min.js" type="text/javascript"></script>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.23.0/mapbox-gl.js'></script>
<script src="<?php echo base_url(); ?>js/html2canvas.min.js" type="text/javascript"></script>
<script type="text/javascript">  
    mapboxgl.accessToken = '<?php echo $mapboxtoken?>';
    var currentMapIndex=0;
    var maps=JSON.parse('<?php echo $maps;?>');
    //console.log(maps);
    var totalMaps=maps.length;
    var map =false;
    var interval=0;
    $(document).ready(function(){createMap();});	
    function createMap(){
        $('#imgMap').html('');
        $('#map').html('');
        $('#imgMap').height(maps[currentMapIndex].imgHeight);
        $('#imgMap').width(maps[currentMapIndex].imgWidth);
        $('.map-bg-height').height(maps[currentMapIndex].height);
        $('.map-bg-height').width(maps[currentMapIndex].width);
        map = new mapboxgl.Map({
            container: 'imgMap', // container id
            style: maps[currentMapIndex].mapStyle, //stylesheet location
            center: [maps[currentMapIndex].longitude,maps[currentMapIndex].latitude], // starting position
            zoom: maps[currentMapIndex].zoom, // starting zoom
            minZoom:10
        });
        interval=setInterval(function(){
            if(map.loaded()){
                clearInterval(interval);
                setUpMapStyle();
            }
	},50);
    }
    function setUpMapStyle(){
        $('.map_title').html(maps[currentMapIndex].title);
        $('.map_subtitle').html(maps[currentMapIndex].subtitle);
        $('.map_tagline').html(maps[currentMapIndex].tagline);
        map.setMaxBounds([
            [maps[currentMapIndex].bounds._sw.lng,maps[currentMapIndex].bounds._sw.lat],
            [maps[currentMapIndex].bounds._ne.lng,maps[currentMapIndex].bounds._ne.lat]
        ]);
        if(maps[currentMapIndex].posterStyle=='white'){
            $('.map-location').show();
            $('.map-location-modern').hide();
            $('.map-location-stricts').hide();
        }
        else if(maps[currentMapIndex].posterStyle=='modern'){
            $('.map-location').hide();
            $('.map-location-modern').show();
            $('.map-location-stricts').hide();
        }
        else if(maps[currentMapIndex].posterStyle=='stricts'){
            $('.map-location').hide();
            $('.map-location-modern').hide();
            $('.map-location-stricts').show();
        }
        else{
            $('.map-location').hide();
            $('.map-location-modern').hide();
            $('.map-location-stricts').hide();
        }
        map.setStyle(maps[currentMapIndex].mapStyle);
        if (maps[currentMapIndex].orientation == 'landscape'){
           $('img#3x4-landscape').show();
           $('img#3x4-portrait').hide();
        }else{
           $('img#3x4-portrait').show();
           $('img#3x4-landscape').hide();
        }
        if(maps[currentMapIndex].finish == 'strict'){
            $('.map-bg').addClass('strict');
            $('.map-bg').removeClass('map-bg-frame');
            maps[currentMapIndex].finish='strict';
        }
        else if(maps[currentMapIndex].finish == 'paper'){
            $('.map-bg').removeClass('map-bg-frame');
            $('.map-bg').removeClass('strict');
            maps[currentMapIndex].finish='paper';
        }
        sendImage();
    }
    
    function  sendImage(){
        var center=map.getCenter();
        var zoom=map.getZoom();
        var bearing=map.getBearing();
        var pitch=map.getPitch();
        var canvas=map.getCanvas();
        var h=canvas.height;
        var w=canvas.width;
        var img=$('<img height="100%" width="100%">').attr('src',
        maps[currentMapIndex].staticAPI+center.lng+','+center.lat+','+zoom +','+bearing +','+pitch
                +'/'+w+'x'+h+'@2x?access_token=<?php echo $mapboxtoken?>&attribution=false');
        $('#map').html(img);
	//return;
        html2canvas($('#map-new'), {
        useCORS:true,
         onrendered: function (canvas) {
             //window.open(canvas.toDataURL('image/png'));
             $.ajax({
                type: "POST", 
                url: window.location.href,
                dataType: 'json',
                data: {
                    draw:maps[currentMapIndex].draw,
                    base64data : canvas.toDataURL('image/png')
                },
                complete:function(jqXHR,textStatus){
                    
                },
                success:function(data){
                    currentMapIndex++;
                    if(currentMapIndex<totalMaps){
                        createMap();
                    }else if(data.success){
                        window.location="<?php echo base_url('editor/finish/'.  base64_encode($orderid)); ?>";
                        
                    }
                }       
             });
             }
         });
    }
</script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --> 
<!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]--> 
<!-- End Bootstrap JS -->
</body>
</html>
