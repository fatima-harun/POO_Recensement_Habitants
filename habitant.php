<?php
require_once "Agent.php";
require_once "config.php";
class Habitant implements Agent{
    private $matricule;
    private $nom;
    private $prenom;
    private $age;
    private $sexe;
    private $situationMatrimoniale;
    private $statut;
    private $occupation;

    public function __construct($connexion,$matricule,$nom,$prenom,$age,$sexe,$situationMatrimoniale,$statut,$occupation){
        $this->connexion=$connexion;
        $this->matricule=$matricule;
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->age=$age;
        $this->sexe=$sexe;
        $this->situationMatrimoniale=$situationMatrimoniale;
        $this->statut=$statut;
        $this->occupation=$occupation;

    }
    public function getMatricule(){
        return $this->matricule;
    }

    public function getNom(){
        return $this->nom;
    }
    public function setName($nouveauNom)
    {
        $this->nom=$nouveauNom;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    public function setPrenom($nouveauPrenom)
    {
        $this->prenom=$nouveauPrenom;
    }
    public function getAge(){
        return $this->age;
    }
    public function setAge($nouveauAge)
    {
        $this->age=$nouveauAge;
    }
    public function getSexe(){
        return $this->sexe;
    }
    public function setSexe($nouveauSexe)
    {
        $this->sexe=$nouveauSexe;
    }
    public function getSituationMatrimoniale(){
        return $this->situationMatrimoniale;
    }
    public function setSituationMatrimoniale($nouveauSituation)
    {
        $this->situation=$nouveauSituationMatrimoniale;
    }
    public function getStatut(){
        return $this->statut;
    }
    public function setStatut($nouveauStatut)
    {
        $this->statut=$nouveauStatut;
    }
    public function getOccupation(){
        return $this->occupation;
    }
    public function setOccupation($nouveauOccupation)
    {
        $this->occupation=$nouveauOccupation;
    }


    public function addHabitant($nom, $prenom, $age, $sexe, $situationMatrimoniale, $statut, $occupation) {
        try {
            // Requête SQL pour obtenir le dernier matricule
            $sql = "SELECT MAX(matricule) AS dernierMatricule FROM habitants";
            $stmt = $this->connexion->prepare($sql);
            $stmt->execute();
            $dernierMatriculeRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $dernierMatricule = $dernierMatriculeRow['dernierMatricule'];
    
            // Calcul du nouveau matricule
            if (empty($dernierMatricule)) {
                $prefixe = "POO_";
                $nouveauMatricule = $prefixe . "001";
            } else {
                $prefixe = "POO_";
                $numéro = (int) substr($dernierMatricule, strlen($prefixe));
                $nouveauNuméro = $numéro + 1;
                $nouveauMatricule = $prefixe . str_pad($nouveauNuméro, 3, "0", STR_PAD_LEFT);
            }
    
            // Requête SQL d'insertion
            $sqlInsert = "INSERT INTO habitants (matricule, nom, prenom, id_age, id_sexe, id_situation, id_statut, id_occupation) 
                        VALUES (:matricule, :nom, :prenom, :age, :sexe, :situationMatrimoniale, :statut, :occupation)";
        
            // Préparation de la requête
            $stmtInsert = $this->connexion->prepare($sqlInsert);
        
            // Liaison des valeurs aux paramètres
            $stmtInsert->bindParam(':matricule', $nouveauMatricule);
            $stmtInsert->bindParam(':nom', $nom);
            $stmtInsert->bindParam(':prenom', $prenom);
            $stmtInsert->bindParam(':age', $age);
            $stmtInsert->bindParam(':sexe', $sexe);
            $stmtInsert->bindParam(':situationMatrimoniale', $situationMatrimoniale);
            $stmtInsert->bindParam(':statut', $statut);
            $stmtInsert->bindParam(':occupation', $occupation);
        
            // Exécution de la requête d'insertion
            $stmtInsert->execute();
        
            // Redirection vers la page index.php après une insertion réussie
            header("Location: read.php");
            exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
        } catch (PDOException $e) {
            // Gestion de l'erreur en la lançant à l'extérieur de la méthode
            throw new Exception("ERREUR: Impossible d'insérer des données. " . $e->getMessage());
        }
    }
    
    //méthode pour afficher les habitants
  public function readHabitant(){
    
    {
        try {
            //requete sql pour selectionner tout les habitants
            $sql="SELECT h.matricule, h.nom, h.prenom, 
            CONCAT(a.age_min, ' - ', a.age_max) AS age_range,
            si.libelle AS situation, sex.libelle AS sexe, s.libelle AS statut, o.libelle AS occupation
           FROM habitants h
            INNER JOIN tranches_age a ON h.id_age = a.id
            INNER JOIN sexe sex ON h.id_sexe = sex.id
             INNER JOIN statut s ON h.id_statut = s.id
           INNER JOIN situation_matrimoniale si ON h.id_situation = si.id
            INNER JOIN occupation o ON h.id_occupation = o.id";

            
            //preparation de la requete
            $stmt=$this->connexion->prepare($sql);

            //exécution de la requete
            $stmt->execute();

            //recuperation des resultats
            $resultats=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultats;
        } 
        catch (PDOException $e) {
            die("erreur:Impossible d'afficher les habitants" .$e->getMessage());
        }

     }
    }


  public function updateHabitant($nom, $prenom, $age, $sexe, $situationMatrimoniale, $statut, $occupation){
    try {
        //requete sql de mis à jour 
        $sql= "UPDATE habitants SET nom= :nom, prenom = :prenom, id_age = :id_age, id_sexe=:id_sexe, id_situation=:id_situation,id_statut=:id_statut,id_occupation=:id_occupation WHERE matricule = :matricule";

        $stmt = $this->connexion->prepare($sql);

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':id_age', $id_age);
        $stmt->bindParam(':id_sexe', $id_sexe);
        $stmt->bindParam(':id_situation', $id_situation);
        $stmt->bindParam(':id_statut', $id_statut);
        $stmt->bindParam(':id_occupation', $id_occupation);
        $stmt->bindParam(':matricule', $matricule);

         $stmt->execute();

        
        //retourne true si la MAJ a reussi
        return true;
    
    //rediriger la page 
    header("location: read.php");
    exit();
    } catch (PDOException $e) {
        die("erreur: impossible de faire la mise à jour  des données" .$e->getMessage());
    }

  }

  public function deleteHabitant($matricule){
 
    try {
        // Requête SQL de suppression avec des paramètres
        $sql = "DELETE FROM habitants WHERE matricule = :matricule";
        
        // Préparation de la requête
        $stmt = $this->connexion->prepare($sql);
        
        // Liaison de la valeur de l'matricule au paramètre
        $stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR);
        
        // Exécution de la requête
        $stmt->execute();
        
        // Retourne true si la suppression a réussi
       
        header("location: read.php");
    } catch(PDOException $e) {
        // Gestion de l'erreur en la lançant à l'extérieur de la méthode
        throw new Exception("ERREUR: Impossible de supprimer l'habitant. " . $e->getMessage());
    }
}
  }

