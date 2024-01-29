<?php
    header('Content-Type: application/json');
    require_once 'controleurs/videos.php';
    $controleurVideos=new ControleurVideo;
    $controleurVideos->afficherListeJSON();
?>
