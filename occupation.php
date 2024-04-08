<?php

//creation de la classe statut
class Occupation {

    //les propriete
    private $connexion;
    private $libelle;

    //Creation des fonctions
    public function __construct($connexion,$libelle){
        $this->connexion=$connexion;
        $this->libelle=$libelle;
    }
    
    public function getLibelle(){
        return $this->libelle;
    }
    public function setLibelle(){
        $this->libelle=$libelle;
    }
   

    public function RecupOccupation(){
        try {
            
            $sql = "SELECT * FROM occupation";

             // Préparation de la requête
             $stmt = $this->connexion->prepare($sql);
            
             //executer la requete
             $stmt ->execute();

             return $stmt ->fetchAll(PDO::FETCH_ASSOC);
             
        } catch (PDOException $e) {
            
            die("Erreur : Impossible d'insérer un habitant. " . $e->getMessage());
        }
    }
    
   
}

?>