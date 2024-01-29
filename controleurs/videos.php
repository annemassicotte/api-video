<?php

require_once './modeles/videos.php';

class ControleurVideo {

    /***
     * Fonction permettant de récupérer l'ensemble des produits et de les afficher sous forme de liste
     */
/*     function afficherListe() {
        $videos = modele_video::ObtenirTous();
        require './vues/videos/liste.php';
    } */

    function afficherListeJSON() {
        $videos = modele_video::ObtenirTous();
        echo json_encode($videos);
    }

    /***
     * Fonction permettant de récupérer un produit à partir de l'identifiant (id) 
     * inscrit dans l'URL, et l'affiche sous forme de liste
     */
    /* function afficherFiche() {
        if(isset($_GET["id"])) {
            $video = modele_video::ObtenirUn($_GET["id"]);
            if($video) {  // ou if($video != null)
                require './vues/videos/fiche.php';
            } else {
                $erreur = "Aucun produit trouvé";
                require './vues/erreur.php';
            }
        } else {
            $erreur = "L'identifiant (id) du vieéo à afficher est manquant dans l'url";
            require './vues/erreur.php';
        }
    } */

    function afficherFicheJSON() {
        $message = new stdClass();
        
        if(isset($_GET["id"])) {
            $video = modele_video::ObtenirUn($_GET["id"]);
            if($video) {  // ou if($video != null)
                echo json_encode($video);
            } else {
                $erreur->message = "Aucun produit trouvé";
                echo json_encode($erreur);
            }
        } else {
            $erreur->message = "L'identifiant (id) du vidéo à afficher est manquant dans l'url";
            echo json_encode($erreur);
        }
    }

        /***
    * Fonction permettant d'ajouter un produit reçu au format JSON
    */
    function ajouterJSON($data) {
        $resultat = new stdClass();
        if(isset($data['nom']) && isset($data['description']) && isset($data['code']) && isset($data['categories']) &&
            isset($data['date_publication']) && isset($data['duree']) && isset($data['sous_titres']) && 
            isset($data['url_image']) && isset($data['auteur']['nom_auteur']) && isset($data['auteur']['utilisateur']) && isset($data['auteur']['verifie']) && isset($data['auteur']['description'])) {

                $resultat->message = modele_video::ajouter($data['nom'], $data['description'], $data['code'], $data['categories'], $data['date_publication'], $data['duree'], $data['sous_titres'], $data['url_image'], $data['auteur']['nom_auteur'], $data['auteur']['utilisateur'], $data['auteur']['verifie'], $data['auteur']['description']);
        } else {
            $resultat->message = "Impossible d'ajouter un vidéo. Des informations sont manquantes";
        }
        echo json_encode($resultat);
    }

    /***
    * Fonction permettant de modifier un produit reçu au format JSON
    */
    function modifierJSON($data) {
        $resultat = new stdClass();
        if(isset($_GET['id']) && isset($data['nom']) && isset($data['description']) && isset($data['code']) && isset($data['date_publication']) && isset($data['duree']) && isset($data['sous_titres']) && isset($data['url_image'])) {
            $resultat->message = modele_video::modifier($_GET['id'], $data['nom'], $data['description'], $data['code'], $data['date_publication'], $data['duree'], $data['sous_titres'], $data['url_image']);
        } else {
            $resultat->message = "Impossible de modifier le produit. Des informations sont manquantes";
            require './vues/erreur.php';
        }
        echo json_encode($resultat);
    }

    /***
     * Fonction permettant de supprimer un produit
     */
    function supprimerJSON($id) {
        $resultat = new stdClass();
        $resultat->message = modele_video::supprimer($_GET['id']);
        echo json_encode($resultat);
    }

}

?>