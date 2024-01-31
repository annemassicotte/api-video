<?php

require_once "../include/config.php";

class modele_avis{
    public $id; 
    public $note; 
    public $commentaire;
    public $fk_video;

    /*Fonction permettant de construire un objet de type modele_avis*/

    public function __construct($id, $note, $commentaire, $fk_video) {
        $this->id = $id;
        $this->note = $note;
        $this->commentaire = $commentaire;
        $this->fk_video = $fk_video;

    }

    /*Fonction permettant de se connecter à la base de données*/

    static function connecter() {
        
        $mysqli = new mysqli(Db::$host, Db::$username, Db::$password, Db::$database);

        // Vérifier la connexion
        if ($mysqli -> connect_errno) {
            echo "Échec de connexion à la base de données MySQL: " . $mysqli -> connect_error;   // Pour fins de débogage
            exit();
        } 

        return $mysqli;
    }


    /*Fonction permettant de récupérer un avis en fonction de son identifiant*/

    public static function ObtenirAvisDuneVideo($fk_video) {

        $liste = [];
        $mysqli = self::connecter();

        if ($requete = $mysqli->prepare("SELECT * FROM avis WHERE fk_video = ? ORDER BY note")) {  // Création d'une requête préparée 
            $requete->bind_param("i", $fk_video); // Envoi des paramètres à la requête

            $requete->execute(); // Exécution de la requête

            $result = $requete->get_result(); // Récupération de résultats de la requête¸
            
            foreach ($result as $enregistrement) {
                $liste[] = new modele_avis($enregistrement['id'], $enregistrement['note'], $enregistrement['commentaire'], $enregistrement['fk_video']);
            }   
            
            $requete->close(); // Fermeture du traitement 
        } else {
            echo "Une erreur a été détectée dans la requête utilisée : ";   // Pour fins de débogage
            echo $mysqli->error;
            return null;
        }

        return $liste;
    }



    /*Fonction permettant d'ajouter un avis pour une vidéo*/

    public static function AjouterAvis($fk_video, $note, $commentaire) {
        $message = '';
        $mysqli = self::connecter();

        // Création d'une requête préparée
        if ($requete = $mysqli->prepare("INSERT INTO avis (note, commentaire, fk_video) VALUES (?, ?, ?)")) {
            $requete->bind_param("isi", $note, $commentaire, $fk_video);

            if ($requete->execute()) {
                $message = "Avis ajouté avec succès";
            } else {
                $message = "Une erreur est survenue lors de l'ajout de l'avis : " . $requete->error;
            }

            $requete->close(); // Fermeture du traitement
        } else {
            echo "Une erreur a été détectée dans la requête utilisée : ";   // Pour fins de débogage
            echo $mysqli->error;
            echo "<br>";
            exit();
        }

        return $message;
    }

}
?>
