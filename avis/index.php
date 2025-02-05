<?php
include_once '../include/config.php'; 
require_once '../controleurs/avis.php';

header('Content-Type: application/json;');
header('Access-Control-Allow-Origin: *'); 

$controleurAvis=new ControleurAvis;

switch($_SERVER['REQUEST_METHOD'])
{
case 'GET':  // GESTION DES DEMANDES DE TYPE GET
	if(isset($_GET['id'])) { 
		$controleurAvis->afficherAvisJSON();
	}
	break;

case 'POST':
	$corpsJSON = file_get_contents('php://input');
	$data = json_decode($corpsJSON, TRUE);
	$controleurAvis->ajouterAvisJSON($data);
	break;

default:
	$reponse = new stdClass();
	$reponse->message = "Opération non supportée";	
	echo json_encode($reponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
?>