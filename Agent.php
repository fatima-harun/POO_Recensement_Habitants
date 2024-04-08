<?php
require_once "config.php";

interface Agent{
    public function addHabitant($nom, $prenom, $age, $sexe, $situationMatrimoniale, $statut,$occupation);
    public function readhabitant();
    public function updatehabitant($nom, $prenom, $age, $sexe, $situationMatrimoniale, $statut,$occupation);
    public function deletehabitant($matricule);
}



