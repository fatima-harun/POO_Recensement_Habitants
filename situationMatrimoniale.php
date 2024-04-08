<?php

//creation de la classe situation
class Situation_matrimoniale {

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
   

    public function RecupSituation_matrimoniale(){
        try {
            
            $sql = "SELECT * FROM situation_matrimoniale ";

             // Préparation de la requête
             $stmt = $this->connexion->prepare($sql);
            
             //executer la requete
             $stmt ->execute();

             //
             return $stmt ->fetchAll(PDO::FETCH_ASSOC);
             
        } catch (PDOException $e) {
            
            die("Erreur " . $e->getMessage());
        }
    }
   
}

?>