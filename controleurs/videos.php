<?php

require_once './modeles/videos.php';

class ControleurVideo {

    /*Fonction permettant d'afficher toutes les vidéos reçues au format JSON*/

    function afficherToutesJSON() {
        $videos = modele_video::ObtenirToutes();
        echo json_encode($videos);
    }

    /*Fonction permettant d'afficher une vidéo reçue au format JSON selon son id*/

    function afficherUneJSON() {
        $message = new stdClass();
        
        if(isset($_GET["id"])) {
            $video = modele_video::ObtenirUne($_GET["id"]);
            if($video) {  // ou if($video != null)
                echo json_encode($video);
            } else {
                $erreur->message = "Aucune vidéo trouvée.";
                echo json_encode($erreur);
            }
        } else {
            $erreur->message = "L'identifiant (id) de la vidéo à afficher est manquante dans l'url.";
            echo json_encode($erreur);
        }
    }

    /*Fonction permettant d'ajouter une vidéo reçue au format JSON*/
    function ajouterJSON($data) {
        $resultat = new stdClass();
        if(isset($data['nom']) && isset($data['description']) && isset($data['code']) && isset($data['categories']) &&
            isset($data['date_publication']) && isset($data['duree']) && isset($data['nombre_vues']) && isset($data['score']) && isset($data['sous_titres']) && 
            isset($data['url_image']) && isset($data['auteur']['nom_auteur']) && isset($data['auteur']['utilisateur']) && isset($data['auteur']['verifie']) && isset($data['auteur']['description_auteur'])) {

                $resultat->message = modele_video::ajouter($data['nom'], $data['description'], $data['code'], $data['categories'], $data['date_publication'], $data['duree'], $data['nombre_vues'], $data['score'], $data['sous_titres'], $data['url_image'], $data['auteur']['nom_auteur'], $data['auteur']['utilisateur'], $data['auteur']['verifie'], $data['auteur']['description_auteur']);
        } else {
            $resultat->message = "Impossible d'ajouter une vidéo. Des informations sont manquantes.";
        }
        echo json_encode($resultat);
    }

    /*Fonction permettant de modifier une vidéo reçue au format JSON*/
    function modifierJSON($data) {
        $resultat = new stdClass();

        if(isset($_GET['id'])) {
            if(isset($data['nom']) && isset($data['description']) && isset($data['code']) && isset($data['date_publication']) && isset($data['duree']) && isset($data['nombre_vues']) && isset($data['score']) && isset($data['sous_titres']) && isset($data['url_image']) && isset($data['auteur']['nom_auteur']) && isset($data['auteur']['utilisateur']) && isset($data['auteur']['verifie']) && isset($data['auteur']['description_auteur'])){
                $resultat->message = modele_video::modifier($_GET['id'], $data['nom'], $data['description'], $data['code'], $data['categories'], $data['date_publication'], $data['duree'], $data['nombre_vues'], $data['score'], $data['sous_titres'], $data['url_image'], $data['auteur']['nom_auteur'], $data['auteur']['utilisateur'], $data['auteur']['verifie'], $data['auteur']['description_auteur']);
            } else {
                $resultat->message = "Impossible de modifier la vidéo. Des informations sont manquantes.";
            } 
        }
            else {
                $resultat->message = "L'ID de la vidéo est manquant.";
            }  

        echo json_encode($resultat);
    }

    /*Fonction permettant de supprimer une vidéo*/

    function supprimerJSON() {
        $resultat = new stdClass();
        if(isset($_GET['id'])) {
            $resultat = modele_video::supprimer($_GET['id']);
        } else {
            $resultat->message = "L'ID de la vidéo est manquant.";
        }  
        echo json_encode($resultat);
    }
}

?>