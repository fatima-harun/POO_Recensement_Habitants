<?php
require_once "config.php";
require_once "habitant.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des habitants</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    $sql = "SELECT nom, prenom, a.libelle, si.libelle, sex.libelle, s.libelle
    FROM habitants h
    INNER JOIN tranches_age a ON h.id_age = a.id
    INNER JOIN sexe sex ON h.id_sexe = sex.id
    INNER JOIN statut s ON h.id_statut = s.id
    INNER JOIN situation_matrimoniale si ON h.id_situation = si.id";
    ?>
    <div class="container">
        <h1>Liste des habitants recensés de la commune de Patte d'oie</h1>
        <table>
            <tr>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Âge</th>
                <th>Sexe</th>
                <th>Situation matrimoniale</th>
                <th>Statut</th>
                <th>Occupation</th>
                <th>Action</th>
            </tr>

            <?php if ($resultats !== null) { ?>
    <?php foreach ($resultats as $habitant) { ?>
        <tr>
            <td><?php echo $habitant['matricule']?></td>
            <td><?php echo $habitant['nom']?></td>
            <td><?php echo $habitant['prenom']?></td>
            <td><?php echo $habitant['age_range']?></td> 
            <td><?php echo $habitant['sexe']?></td>
             <!-- au niveau des crochets il faut mettre le nom de l'alia donné lors de la jointure -->
            <td><?php echo $habitant['situation']?></td>      
            <td><?php echo $habitant['statut']?></td> 
            <td><?php echo $habitant['occupation']?></td>
            <td><button class="btn btn-delete"><a href="update.php?matricule=<?php echo $habitant['matricule']; ?>">Modifier</a></button></td>
               <td><button class="btn btn-delete"><a href="delete.php?matricule=<?php echo $habitant['matricule']; ?>">Supprimer</a></button></td>
        </tr>
    <?php } ?>
<?php } ?>

        </table>
    </div>
    <style>
        /* Reset des styles par défaut */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Styles pour le conteneur principal */
.container {
    font-family: Arial, sans-serif; 
    margin-top:30px;
}

/* Styles pour le titre */
h1 {
    text-align: center;
    margin-bottom: 20px;
}

/* Styles pour le tableau */
table {
    width: 100%;
    border-collapse: collapse;
}

/* Styles pour les en-têtes de colonne */
th {
    background-color:#4cd137;
    padding: 10px;
    text-align: left;
    border-bottom: 2px solid #ccc;
    color:white
}

/* Styles pour les cellules */
td {
    padding: 10px;
    border-bottom: 1px solid #ccc;
}

/* Styles pour les lignes impaires du tableau */
tr:nth-child(odd) {
    background-color: #f9f9f9;
}

/* Styles pour les liens */
a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
    color: #0056b3;
}
button{
    padding:
}
    </style>
</body>
</html>
