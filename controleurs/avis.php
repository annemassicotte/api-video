<?php

require_once '../modeles/avis.php';

class ControleurAvis {

    /*Fonction permettant d'afficher les avis d'une vidéo grâce à son id*/

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
            $erreur->message = "L'identifiant (id) du vidéo est manquant dans l'url.";
            echo json_encode($erreur);
        }
    }


    /*Fonction permettant d'ajouter un avis sur une vidéo grâce à son id*/
    
    function ajouterAvisJSON($data) {
        $resultat = new stdClass();

        if (isset($data['fk_video']) && isset($data['note']) && isset($data['commentaire'])) {
            $resultat->message = modele_avis::AjouterAvis($data['fk_video'], $data['note'], $data['commentaire']);
        } else {
            $resultat->message = "Impossible d'ajouter un avis. Des informations sont manquantes.";
        }

        echo json_encode($resultat);
    }

}

?>