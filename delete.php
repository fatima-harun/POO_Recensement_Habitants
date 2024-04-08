<?php

require_once "config.php";
require_once "habitant.php";
// Vérification si l'ID de l'abitant à supprimer est passé dans la requête GET
if(isset($_GET['matricule'])) {
    // Récupération de la matricule de l'habitant à supprimer
    $matricule = $_GET['matricule'];
    
    // Appel de la méthode deleteStudent pour supprimer l'étudiant
    $habitant->deleteHabitant($matricule);
    
    // Redirection vers la page read.php après la suppression réussie
    header("Location: read.php");
    exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
} else {
    // Gérer le cas où la matricule de l'habitant n'est pas disponible dans la requête GET
    echo "Matricule de l'habitant non spécifié.";
}
?>