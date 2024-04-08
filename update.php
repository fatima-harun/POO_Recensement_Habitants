<?php
require_once "config.php";

require_once "habitant.php";

if(isset($_POST['submit'])){
    //recuperation des données
    $matricule = $_GET["matricule"];//recuparation de la matricule de l'habitant à partir du get 
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $age=$_POST['id_age'];
    $sexe=$_POST['sexe'];
    $situationMatrimoniale=$_POST['id_situation'];
    $statut=$_POST['id_statut'];
    $occupation=$_POST['id_occupation'];
    

    //appel de la methode update
    $habitant->updatehabitant($nom, $prenom, $age, $sexe, $situationMatrimoniale, $statut, $occupation);
    //rediriger la page vers index
    header("location: read.php");
    exit();
}
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
    </style>
</head>
<body>
              <?php
                //requete sql pour selectionner les données de l'habitant à partir de sa matricule

                $sql="SELECT * FROM habitants WHERE matricule = :matricule";

                //prepareation de la requete
                $stmt=$connexion ->prepare($sql);

                //liaison des valeurs aux parametre
                $stmt->bindParam(':matricule', $_GET['matricule'], PDO::PARAM_STR);


                //execution de la requete
                if($stmt->execute()){
                    //preparation du resultat
                    $habitants=$stmt->fetch(PDO::FETCH_ASSOC);
                    //recuperation des donnés de l'habitant
                    $matricule = $habitants['matricule'];
                     $nom=$habitants['nom'];
                     $prenom = $habitants['prenom'];
                     $age=$habitants['id_age'];
                     $sexe = $habitants['id_sexe'];
                     $situationMatrimoniale=$habitants['id_situation'];
                     $statut = $habitants['id_statut'];
                     $occupation=$habitants['id_occupation'];
                }else{
                    echo"Erreur lors de la recuperation des données";
                }
            ?>
    <form action="update.php?matricule=<?php echo $matricule;?>" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $nom?>" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $prenom?>" required>

        <label for="age">Tranche d'âge :</label>
        <select name="id_age" id="" required>
        <?php foreach ($Ages as $age) : ?>
                <option value="<?php echo $age['id']; ?>" <?php if($age['id'] == $habitants['id_age']) echo 'selected'; ?>>
                <?php  echo $age ['age_min'];echo "-";echo $age ['age_max']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="sexe">Sexe :</label>
        <select id="sexe" name="sexe" required>
        <?php foreach ($SE as $se) : ?>
                <option value="<?php echo $se['id']; ?>" <?php if($se['id'] == $habitants['id_sexe']) echo 'selected'; ?>>
                    <?php echo $se['libelle']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="situation_matrimoniale">Situation matrimoniale :</label>
        <select name="id_situation" id="" >
        <?php foreach ($SM as $sm) : ?>
                <option value="<?php echo $sm['id']; ?>" <?php if($sm['id'] == $habitants['id_situation']) echo 'selected'; ?>>
                    <?php echo $sm['libelle']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="">Statut</label>
        <select name="id_statut" id="" >
        <?php foreach ($status as $statut) : ?>
                <option value="<?php echo $statut['id']; ?>" <?php if($statut['id'] == $habitants['id_statut']) echo 'selected'; ?>>
                    <?php echo $statut['libelle']; ?>
                </option>
            <?php endforeach; ?>
            
        </select>

        <label for="occupation">Occupation</label>
        <select name="id_occupation" id="" >
            <option value="">Sélectionne une occupation</option>
            <?php foreach ($SO as $so) : ?>
                <option value="<?php echo $so['id']; ?>" <?php if($so['id'] == $habitants['id_occupation']) echo 'selected'; ?>>
                    <?php echo $so['libelle']; ?>
                </option>
            <?php endforeach; ?>
        </select>


        <button type="submit" name="submit">Enregistrer</button>
    </form>
</body>
</html>
