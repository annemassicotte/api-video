<?php

require_once '../modeles/avis.php';

class ControleurAvis {

function afficherAvisJSON() {
    $message = new stdClass();
        if(isset($_GET["id"])) {
            $avis = modele_avis::ObtenirAvisDuneVideo($_GET["id"]);
            if($avis) {
                echo json_encode($avis);
            } else {
                $erreur->message = "Aucun avis trouvé";
                echo json_encode($erreur);
            }
        } else {
            $erreur->message = "L'identifiant (id) du vidéo à afficher est manquant dans l'url";
            echo json_encode($erreur);
        }
    }

}

?>