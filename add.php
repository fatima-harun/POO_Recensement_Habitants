<?php
require_once "config.php";

//Verifier si le formulaire a ete soumis
if(isset($_POST['submit'])){

// recuperation des donnees du formulaire
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$age=$_POST['id_age'];
$sexe=$_POST['id_sexe'];
$situationMatrimoniale=$_POST['id_situation'];
$statut=$_POST['id_statut'];
$occupation=$_POST['id_occupation'];

//Verifier si les champs ne sont pas vides
if($nom != "" && $prenom != "" && $age != "" && $sexe != "" && $situationMatrimoniale != "" && $statut != "" && $occupation != "") {
  
    // appel de la methode addHabitant 
    //$habitant est une instance de la classe Habitant
    //appel de la méthode
    $habitant->addHabitant($nom, $prenom, $age, $sexe, $situationMatrimoniale, $statut,$occupation);
}
}
?>