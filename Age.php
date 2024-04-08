<?php
class Age {

//les propriete
private $age_min;
private $age_max;
private $connexion;


//Creation des fonctions
public function __construct($connexion,$libelle){
    $this->connexion=$connexion;
    $this->libelle=$libelle;
    
}

public function getLibelle(){
    return $this->libelle;
}


public function RecupTranche_age(){
    try {
        
        $sql = "SELECT * FROM tranches_age";

          // Préparation de la requête
          $stmt = $this->connexion->prepare($sql);

          //executer la requete
          $stmt ->execute();

          //Retoune
            return $stmt ->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        
        die("Erreur : Impossible d'insérer un habitant. " . $e->getMessage());
    }
}

}

?>