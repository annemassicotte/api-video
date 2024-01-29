<?php

require_once "../include/config.php";
//include_once 'include/fonctions.php'; 

class modele_avis{
    public $id; 
    public $note; 
    public $commentaire;
    public $fk_video;

    /***
     * Fonction permettant de construire un objet de type modele_produit
     */
    public function __construct($id, $note, $commentaire, $fk_video) {
        $this->id = $id;
        $this->note = $note;
        $this->commentaire = $commentaire;
        $this->fk_video = $fk_video;

    }

    /***
     * Fonction permettant de se connecter à la base de données
     */
    static function connecter() {
        
        $mysqli = new mysqli(Db::$host, Db::$username, Db::$password, Db::$database);

        // Vérifier la connexion
        if ($mysqli -> connect_errno) {
            echo "Échec de connexion à la base de données MySQL: " . $mysqli -> connect_error;   // Pour fins de débogage
            exit();
        } 

        return $mysqli;
    }



    /***
     * Fonction permettant de récupérer un avis en fonction de son identifiant
     */
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





    /***
     * Fonction permettant d'ajouter un produit
     */
    /* public static function ajouter($nom, $description, $code, $date_publication, $duree, $sous_titres, $url_image) {
        $message = '';

        $mysqli = self::connecter();
        
        // Création d'une requête préparée
        if ($requete = $mysqli->prepare("INSERT INTO videos (nom, description, code, date_publication, duree, sous_titres, url_image) VALUES(?, ?, ?, ?, ?, ?, ?)")) {      

        $requete->bind_param("ssssiss", $nom, $description, $code, $date_publication, $duree, $sous_titres, $url_image);

        if($requete->execute()) { // Exécution de la requête
            $message = "Vidéo ajouté";  // Message ajouté dans la page en cas d'ajout réussi
        } else {
            $message =  "Une erreur est survenue lors de l'ajout: " . $requete->error;  // Message ajouté dans la page en cas d’échec
        }

        $requete->close(); // Fermeture du traitement

        } else  {
            echo "Une erreur a été détectée dans la requête utilisée : ";   // Pour fins de débogage
            echo $mysqli->error;
            echo "<br>";
            exit();
        }

        return $message;
    } */

}
?>
