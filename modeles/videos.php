<?php

require_once "./include/config.php";

class modele_video{
    public $id; 
    public $nom; 
    public $description;
    public $code;
    public $date_publication;
    public $duree;
    public $sous_titres;
    public $url_image;

    /***
     * Fonction permettant de construire un objet de type modele_produit
     */
    public function __construct($id, $nom, $description, $code, $categories, $date_publication, $duree, $sous_titres, $url_image, $nom_auteur, $utilisateur, $verifie, $description_auteur) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->code = $code;
        $this->categories = explode(";", $categories);
        $this->date_publication = $date_publication;
        $this->duree = $duree;
        $this->sous_titres = $sous_titres;
        $this->url_image = $url_image;
        

        $this->auteur = new stdClass();
        $this->auteur->nom_auteur = $nom_auteur;
        $this->auteur->utilisateur = $utilisateur;
        $this->auteur->verifie = $verifie;
        $this->auteur->description = $description_auteur;
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
     * Fonction permettant de récupérer l'ensemble des produits 
     */

    public static function ObtenirTous() {
        $liste = [];
        $mysqli = self::connecter();

        $resultatRequete = $mysqli->query("SELECT * FROM videos ORDER BY nom");

        foreach ($resultatRequete as $enregistrement) {
            $liste[] = new modele_video($enregistrement['id'], $enregistrement['nom'], $enregistrement['description'], $enregistrement['code'], $enregistrement['categories'], $enregistrement['date_publication'], $enregistrement['duree'], $enregistrement['sous_titres'], $enregistrement['url_image'],$enregistrement['nom_auteur'], $enregistrement['utilisateur'], $enregistrement['verifie'], $enregistrement['description_auteur']);
        }

        return $liste;
    }

    /***
     * Fonction permettant de récupérer un produit en fonction de son identifiant
     */
    public static function ObtenirUn($id) {
        $mysqli = self::connecter();

        if ($requete = $mysqli->prepare("SELECT * FROM videos WHERE id=?")) {  // Création d'une requête préparée 
            $requete->bind_param("i", $id); // Envoi des paramètres à la requête

            $requete->execute(); // Exécution de la requête

            $result = $requete->get_result(); // Récupération de résultats de la requête¸
            
            if($enregistrement = $result->fetch_assoc()) { // Récupération de l'enregistrement
                $video =new modele_video($enregistrement['id'], $enregistrement['nom'], $enregistrement['description'], $enregistrement['code'], $enregistrement['categories'], $enregistrement['date_publication'], $enregistrement['duree'], $enregistrement['sous_titres'], $enregistrement['url_image'], $enregistrement['nom_auteur'], $enregistrement['utilisateur'], $enregistrement['verifie'], $enregistrement['description_auteur']);
            } else {
                //echo "Erreur: Aucun enregistrement trouvé.";  // Pour fins de débogage
                return null;
            }   
            
            $requete->close(); // Fermeture du traitement 
        } else {
            echo "Une erreur a été détectée dans la requête utilisée : ";   // Pour fins de débogage
            echo $mysqli->error;
            return null;
        }

        return $video;
    }

    /***
     * Fonction permettant d'ajouter un produit
     */
    public static function ajouter($nom, $description, $code, $categories, $date_publication, $duree, $sous_titres, $url_image, $nom_auteur, $utilisateur, $verifie, $description_auteur) {
        $message = '';

        $mysqli = self::connecter();

        $liste_categories = implode(";", $categories);
        
        // Création d'une requête préparée
        if ($requete = $mysqli->prepare("INSERT INTO videos (nom, description, code, categories, date_publication, duree, sous_titres, url_image, nom_auteur, utilisateur, verifie, description_auteur) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {      

        $requete->bind_param("sssssissssss", $nom, $description, $code, $liste_categories, $date_publication, $duree, $sous_titres, $url_image, $nom_auteur, $utilisateur, $verifie, $description_auteur);

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
    }

    /***
     * Fonction permettant d'éditer un produit
     */
    public static function modifier($id, $nom, $description, $code, $date_publication, $duree, $sous_titres, $url_image) {
        $message = '';

        $mysqli = self::connecter();
        
        // Création d'une requête préparée
        if ($requete = $mysqli->prepare("UPDATE videos SET nom=?, description=?, code=?, date_publication=?, duree=?, sous_titres=?, url_image=?  WHERE id=?")) {      

        $requete->bind_param("ssssissi", $nom, $description, $code, $date_publication, $duree, $sous_titres, $url_image, $id);

        if($requete->execute()) { // Exécution de la requête
            $message = "Vidéo modifié";  // Message ajouté dans la page en cas d'ajout réussi
        } else {
            $message =  "Une erreur est survenue lors de l'édition: " . $requete->error;  // Message ajouté dans la page en cas d’échec
        }

        $requete->close(); // Fermeture du traitement

        } else  {
            echo "Une erreur a été détectée dans la requête utilisée : ";
            echo $mysqli->error;
            echo "<br>";
            exit();
        }

        return $message;
    }

    /***
     * Fonction permettant de supprimer un produit
     */
    public static function supprimer($id) {
        $message = '';

        $mysqli = self::connecter();
        
        // Création d'une requête préparée
        if ($requete = $mysqli->prepare("DELETE FROM videos WHERE id=?")) {      

        $requete->bind_param("i", $id);

        if($requete->execute()) { // Exécution de la requête
            $message = "Vidéo supprimé";  // Message ajouté dans la page en cas d'ajout réussi
        } else {
            $message =  "Une erreur est survenue lors de la suppression: " . $requete->error;  // Message ajouté dans la page en cas d’échec
        }

        $requete->close(); // Fermeture du traitement

        } else  {
            echo "Une erreur a été détectée dans la requête utilisée : ";
            echo $mysqli->error;
            echo "<br>";
            exit();
        }

        return $message;
    }

}
?>
