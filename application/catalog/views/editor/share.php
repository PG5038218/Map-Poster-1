<!DOCTYPE html>
<html>
  <head>
    <title>Your comrades need you!</title>
    <meta property="og:url" content="<?php echo site_url('editor/fbShare?title='.$og['title'].'&image='.$og['image']); ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="City <?php echo $og['title']; ?> un mapa personalizado creado en Mapify" />
    <meta property="og:description" content="Con Mapify puedes crear, diseñar y comprar un poster personalizado de tu ciudad." />
    <meta property="og:image" content="<?php echo $og['image']; //$url=substr($og['image'], 0, strpos($og['image'],"?")); echo $url;?>" />
    <meta property="og:image:height" content="710">
    <meta property="og:image:width" content="790">
  </head>
  <body>
    <script>
        window.location = '<?php echo site_url('editor'); ?>';
    </script>
</html>