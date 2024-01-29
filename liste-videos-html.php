<?php
    require_once 'controleurs/videos.php';
?>

<!doctype html>
<html lang="fr">
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Liste des vidéos</title>
 </head>
 <body>
    <h1>Liste des vidéos</h1>
    
    <?php
        $controleurVideos=new ControleurVideo;
        $controleurVideos->afficherListe();
    ?>

 </body>
</html>