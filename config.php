<?php
require_once "habitant.php";
require_once "statut.php";
require_once "Age.php";
require_once "situationMatrimoniale.php";
require_once "occupation.php";
require_once "sexe.php";
// Définition des constantes pour les informations de connexion à la base de données
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Juin1706-*2000');
define('DB_NAME', 'testCommune');

try {
    // Connexion à la base de données en utilisant PDO
    $connexion = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $habitant = new Habitant($connexion,null,'diop','fatou','0-4','feminin','Celibataire','chef de quartier','retraité');
    // Appel de la méthode readStudent pour lire les étudiants
    $resultats = $habitant->readHabitant();
    
    // Instanciation de  statut
    $indiqueStatut = new Statut($connexion, "Civile");
    $status = $indiqueStatut ->RecupStatut();

    // Instanciation tranche age
    $indiqueAge= new Age($connexion, "0-4");
    $Ages = $indiqueAge ->RecupTranche_age();

        // Instanciation situation matrimoniale
        $indiqueSituation= new Situation_matrimoniale($connexion, "Divorce",);
        $SM = $indiqueSituation ->RecupSituation_matrimoniale();

        // Instanciation d'occupation
        $indiqueOccupation= new Occupation ($connexion, "Retraité",);
        $SO= $indiqueOccupation ->RecupOccupation();

        // Instanciation de sexe
        $indiqueSexe= new Sexe ($connexion, "Féminin",);
        $SE= $indiqueSexe ->RecupSexe();


} catch (PDOException $e) {
    // Gestion des erreurs de connexion à la base de données
    die("Erreur : Impossible de se connecter à la base de données " . $e->getMessage());
}


?>