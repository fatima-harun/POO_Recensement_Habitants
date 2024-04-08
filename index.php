<?php
require_once "config.php";

require_once "habitant.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recensement des Habitants</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1{
            text-align:center;
            color:white;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        form{
            background-color:#00b894;
            color:white
        }
    </style>
</head>
<body>
    <form action="add.php" method="POST">
       <div class="titre"> <h1>Formulaire de recensement</h1></div>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="age">Tranche d'âge :</label>
        <select name="id_age" id="" required>
        <option value="">Sélectionne une Tranche d'âge</option>
            <?php  foreach ($Ages as $age) : ?>
            <option value="<?php  echo $age ['id']; ?>"><?php  echo $age ['age_min'];echo "-";echo $age ['age_max']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="sexe">Sexe :</label>
        <select id="" name="id_sexe" required>
        <option value="">Sélectionne une situation matrimoniale</option>
        <?php foreach ($SE as $Se) : ?>
            <option value="<?php echo $Se ['id']; ?>"><?php echo $Se ['libelle'] ;?></option>
            <?php  endforeach;?>
        </select>

        <label for="situation_matrimoniale">Situation matrimoniale :</label>
        <select name="id_situation" id="" >
            <option value="">Sélectionne une situation matrimoniale</option>
        <?php foreach ($SM as $Sm) : ?>
            <option value="<?php echo $Sm ['id']; ?>"><?php echo $Sm ['libelle'] ;?></option>
            <?php  endforeach;?>
        </select>

        <label for="">Statut</label>
        <select name="id_statut" id="" >
        <option value="">Sélectionne un statut</option>
        <?php foreach ($status as $statu) : ?>
                    <option value="<?php echo $statu ['id']; ?>"><?php echo $statu ['libelle']; ?></option>
                <?php endforeach; ?>
        </select>

        <label for="occupation">Occupation</label>
        <select name="id_occupation" id="" >
            <option value="">Sélectionne une occupation</option>
            <?php foreach ($SO as $so) : ?>
                    <option value="<?php echo $so ['id']; ?>"><?php echo $so ['libelle']; ?></option>
                <?php endforeach; ?>
        </select>

        <button type="submit" name="submit">Enregistrer</button>
    </form>
</body>
</html>
