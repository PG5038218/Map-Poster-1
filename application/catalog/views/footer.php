 <div class="footer-top">
    <div class="container">
      <div class="row">
        <p class="pull-left share">Follow us on social networks </p>
        <ul class="socail fl-left top-o">
            <?php if($sem[0]['status']=='Enable'){ ?><li><a target="_blank" href="<?php echo $sem[0]['field_value'] ?>" class="facebook" title="Facebook"><i class="fa fa-facebook"></i></a></li><?php } ?>
            <?php if($sem[1]['status']=='Enable'){ ?><li><a target="_blank" href="<?php echo $sem[1]['field_value'] ?>" class="twitter" title="twitter"><i class="fa fa-twitter"></i></a></li><?php } ?>
            <?php if($sem[2]['status']=='Enable'){ ?><li><a target="_blank" href="<?php echo $sem[2]['field_value'] ?>" class="google-plus" title="google-plus"><i class="fa fa-google-plus"></i></a></li><?php } ?>
            <?php if($sem[3]['status']=='Enable'){ ?><li><a target="_blank" href="<?php echo $sem[3]['field_value'] ?>" class="pinterest" title="pinterest"><i class="fa fa-pinterest-p"></i></a></li><?php } ?>
            <?php if($sem[4]['status']=='Enable'){ ?><li><a target="_blank" href="<?php echo $sem[4]['field_value'] ?>" class="behance" title="instagram"><i class="fa fa-instagram"></i></a></li><?php } ?>
            <?php if($sem[5]['status']=='Enable'){ ?><li><a target="_blank" href="<?php echo $sem[5]['field_value'] ?>" class="linkedin" title="linkedin"><i class="fa fa-linkedin"></i></a></li><?php } ?>
        </ul>
        <div class="clearfix"></div>
        
        <span class="sm-text sm-text-inner">Copyright <?php echo date('Y'); ?> &copy; All Rights Reserved - MyJourneyMap</span>
        <ul class="footer-link">
              <li><a href="<?php echo site_url('services') ?>">Services</a></li>
              <li><a href="<?php echo site_url('showcase') ?>">Showcase</a></li>
              <li><a href="<?php echo site_url('contactus') ?>">Contact US</a></li>
              <li><a href="<?php echo site_url('faq') ?>">FAQ</a></li>
        </ul>
        <div class="claearfix"></div>
		<div class="csmt-footer-new col-xs-12 padng_rmv"> 
                    <p class="sm-text design-text">Design and Development by  <a href="http://www.mxicoders.com" target="_blank">mxicoders.com</a></p>
                </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script> 
<script src='<?php echo base_url(); ?>js/bootstrap-select.js'></script>
<script src="<?php echo base_url(); ?>js/mapify.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --> 
<!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]--> 
<!-- End Bootstrap JS -->
<?php if($this->uri->segment(1)=='editor'): ?>
<!--div class="hidden_map" id="map1"></div-->
<script src="<?php echo base_url(); ?>js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/html2canvas.min.js" type="text/javascript"></script>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.38.0/mapbox-gl.js'></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo $GOOGLE_API_KEY; ?>"></script> 
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
    mapboxgl.accessToken = '<?php echo $mapboxtoken?>';
    window.base_url="<?php echo base_url(); ?>";
    Stripe.setPublishableKey('<?php echo $stripekey?>');
    var version='<?php echo $version; ?>';
    var currentMapIndex=0;
    var mapObj={
        country:'United States',
        countryCode:'us',
        param:'',
        latitude:'40.39612',
        longitude:'-3.70742',
        title:'Madrid',
        subtitle:'Spain',
        tagline:'40.39°N / -3.70°W',
        posterStyle:'<?php echo $posterstyles[0]['style_name'] ?>',
        posterStyleValue:'<?php echo $posterstyles[0]['style_value'] ?>',
        mapStyle:'<?php echo $styles[0]['style_path'] ?>',
        staticAPI:'<?php echo $styles[0]['static_api_path'] ?>',
        orientation:'portrait',
        orientationValue:'Vertical',
        finish:'strict',
        finishValue:'Con Borde',
        posterSize:'<?php echo $default_poster['poster_id'] ?>',
        posterHeight:'<?php echo $default_poster['poster_height'] ?>',
        posterWidth:'<?php echo $default_poster['poster_width'] ?>',
        price:'<?php echo $default_poster['poster_price'] ?>',
        posterid:'<?php echo $default_poster['poster_id'] ?>',
        bounds:'',
        zoom:11,
        pitch:0,
        bearing:0,
        qty:1,
        imageThumb:'',
        imageShare:'',
        version:'<?php echo $version; ?>'
    };
</script>
<script src="<?php echo base_url(); ?>js/editor.js"></script>
<?php 
if($this->input->post('address')){
?>
<script>
    document.getElementById('address').value='<?php $this->input->post('address')?>';
    var param='<?php echo $this->input->post('param')?>';
    var country='<?php echo $this->input->post('country')?>';
    var countryCode='<?php echo $this->input->post('countryCode')?>';
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = (function(xhttp,map) {
          return function(){
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                var json_text = xhttp.responseText;
                var geoJosnData=JSON.parse(json_text);
                var feature=geoJosnData.features[0];	
                maps[currentMapIndex].latitude=feature.geometry.coordinates[1];
                maps[currentMapIndex].longitude=feature.geometry.coordinates[0];
                map.setCenter(feature.geometry.coordinates);
                var lat=feature.geometry.coordinates[1];
		var lng=feature.geometry.coordinates[0];
		var tagline='';
		if(lat>=0){
		tagline+=feature.geometry.coordinates[1].toFixed(2)+"°N / ";
		}else{
		tagline+=feature.geometry.coordinates[1].toFixed(2)+"°S / ";
		}
		if(lng>=0){
		tagline+=feature.geometry.coordinates[0].toFixed(2)+"°E ";
		}else{
		tagline+=feature.geometry.coordinates[0].toFixed(2)+"°W ";
		}
                setTitles(param,country,tagline);
                console.log(map.getCenter());
                map.getBounds();
            };
          };
        })(xhttp,map);
        xhttp.open("GET", "https://api.mapbox.com/geocoding/v5/mapbox.places/"+param+".json?country="+countryCode+"&types=place&autocomplete=true&access_token=<?php echo $mapboxtoken?>", true);
        xhttp.send();
</script>
<?php
}
?>
<?php endif; ?>
<?php if($this->uri->segment(1)=='contact'): ?>
<script src="<?php echo base_url(); ?>js/jquery.validate.min.js" type="text/javascript"></script>
<?php endif; ?>
<?php 
foreach($seo as $script){
    if($script['status']=='Enable'){
        echo $script['field_value'];
    }
}
?>
</body>
</html>
