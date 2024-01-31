<?php

require_once "../include/config.php";

class modele_score{
    public $id; 

    /*Fonction permettant de construire un objet de type modele_score*/
    
    public function __construct($id) {
        $this->id = $id;
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

    /*Fonction permettant d'augmenter le score d'une vidéo*/

    public static function AugmenterScore($id) {
        $mysqli = self::connecter();

        if ($requete = $mysqli->prepare("UPDATE videos SET score = score+1 WHERE id=?")) {  // Création d'une requête préparée 
            $requete->bind_param("i", $id); // Envoi des paramètres à la requête

            if($requete->execute()) { // Exécution de la requête
                $message = "Score augmenté";  // Message ajouté dans la page en cas d'augmentation réussie
            } else {
                $message =  "Une erreur est survenue lors de l'augmentation du score: " . $requete->error;  // Message ajouté dans la page en cas d’échec
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


    /*Fonction permettant de diminuer le score d'une vidéo*/

    public static function DiminuerScore($id) {
        $mysqli = self::connecter();

        if ($requete = $mysqli->prepare("UPDATE videos SET score = score-1 WHERE id=?")) {  // Création d'une requête préparée 
            $requete->bind_param("i", $id); // Envoi des paramètres à la requête

            if($requete->execute()) { // Exécution de la requête
                $message = "Score diminué";  // Message ajouté dans la page en cas de diminution réussie
            } else {
                $message =  "Une erreur est survenue lors de la diminution du score: " . $requete->error;  // Message ajouté dans la page en cas d’échec
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
