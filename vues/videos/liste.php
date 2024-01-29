<h2>Affichage sous forme de liste</h2>
<ul>
    <?php foreach ($videos as $video) {  ?> 
        <li><?= $video->nom ?> <?= $video-> duree?></li>
    <?php  } ?>
</ul>