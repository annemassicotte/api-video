<?php
include_once '../include/config.php'; 
require_once '../controleurs/score.php';

header('Content-Type: application/json;');
header('Access-Control-Allow-Origin: *'); 

$controleurScore=new ControleurScore;

switch($_SERVER['REQUEST_METHOD'])
{
case 'PATCH':
	$reponse = new stdClass();
	$reponse->message = "Augmenter le score: ";
	if(isset($_GET['id'])) {
		$controleurScore->augmenterScore($_GET['id']);
	}
	else {
		$reponse->message = "L'ID de la vidéo est manquant.";
	}

	break;

default:
	$reponse = new stdClass();
	$reponse->message = "Opération non supportée";	
	echo json_encode($reponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
?>