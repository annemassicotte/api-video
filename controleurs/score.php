<?php

require_once '../modeles/score.php';

class ControleurScore {

    /*Fonction permettant d'augmenter le score d'une vidéo*/

    function augmenterScore($id) {
        $resultat = new stdClass();
        if(isset($_GET['id'])) {
            $resultat->message = modele_score::AugmenterScore($_GET['id']);
        } else {
            $resultat->message = "Impossible d'augmenter le score. Des informations sont manquantes.";
        }
        echo json_encode($resultat);
    }
    
    /*Fonction permettant de diminuer le score d'une vidéo*/

    function diminuerScore($id) {
        $resultat = new stdClass();
        if(isset($_GET['id'])) {
            $resultat->message = modele_score::DiminuerScore($_GET['id']);
        } else {
            $resultat->message = "Impossible de diminuer le score. Des informations sont manquantes.";
        }
        echo json_encode($resultat);
    }
}

?>