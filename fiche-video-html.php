<?php
    require_once 'controleurs/videos.php';
?>

<!doctype html>
<html lang="fr">
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/styles.css">
  <title>Fiche vidéo</title>
 </head>
 <body>

    <?php
        $controleurVideos=new ControleurVideo;
        $controleurVideos->afficherFiche();
    ?>
    
    <a href="liste-videos-html.php">Retour à la liste des vidéos</a>

 </body>
</html>