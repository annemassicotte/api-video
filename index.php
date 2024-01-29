<?php
header('Content-Type: application/json;');
header('Access-Control-Allow-Origin: *');
require_once './controleurs/videos.php';
$controleurVideos=new ControleurVideo;

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET': // GESTION DES DEMANDES DE TYPE GET
        if(isset($_GET['id'])) { // CODE PERMETTANT DE RÉCUPÉRER L'ENREGISTREMENT CORRESPONDANT À L'IDENTIFIANT PASSÉ EN PARAMÈTRE
            $controleurVideos->afficherFicheJSON($_GET['id']);
        } else {// CODE PERMETTANT DE RÉCUPÉRER TOUT LES ENREGISTREMENTS
            $controleurVideos->afficherListeJSON();
        }
        break;
    case 'POST': // CODE PERMETTANT DE D'AJOUTER UN ENREGISTREMENT
        $corpsJSON = file_get_contents('php://input');
        $data = json_decode($corpsJSON, TRUE);
        $controleurVideos->ajouterJSON($data);
        break;
    case 'PUT': // CODE PERMETTANT DE METTRE À JOUR L'ENREGISTREMENT CORRESPONDANT À L'IDENTIFIANT PASSÉ EN PARAMÈTRE
        if(isset($_GET['id'])) {
            $corpsJSON = file_get_contents('php://input');
            $data = json_decode($corpsJSON, TRUE);
            $controleurVideos->modifierJSON($data);
        }
        break;
    case 'DELETE': // CODE PERMETTANT DE SUPPRIMER L'ENREGISTREMENT CORRESPONDANT À L'IDENTIFIANT PASSÉ EN PARAMÈTRE
        if(isset($_GET['id'])) {
            $controleurVideos->supprimerJSON($_GET['id']);
        }
        break;
        default:
}
?>