<?php
// ouverture de la session afin de se connecter en une page
session_start();
// le code php pour recuper les informations depuis la base de donnees
require_once("connexiondb.php");
// **************************************************************************************************
try {
    //vérification et se retrouver à la page principale du programme si la codition est validée
    if (isset($_SESSION['user'])) {
        $idS = isset($_GET['idS']) ? $_GET['idS'] : 0;
        $requet = "SELECT * FROM stagiaire WHERE idStagiaire=$idS";
        $resultat = $pdo->query($requet);
        $stagiaire = $resultat->fetch(); //recuperer la valeur de la requette sous forme d'un tableau associatif
        // recuperation de l'informations du stagiaire depuis la base de données
        $nom = $stagiaire['nom'];
        $prenom = $stagiaire['prenom'];
        $civilite = strtoupper($stagiaire['civilite']);
        $idFiliere = $stagiaire['dFiliere'];
        $nomPhoto = $stagiaire['photo'];
        // une requette pour afficher toutes les filieres
        $requetteF = 'SELECT * FROM filiere';
        $resulatF = $pdo->query($requetteF);
    } else {
        header('location:login.php');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edition de Stagiaire</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>

<body>
    <?php
    // appelle de la page menu avec tous les codes
    include("menu.php");
    ?>
    <div class="container">
        <div class="panel panel-primary   marginTop">
            <div class="panel-heading">
                Edition de Stagiaire:
            </div>
            <div class="panel-body">
                <form action="updateStagiaire.php" method="post" class="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="idS"> Id de la filière:<?php echo $idS; ?></label>
                        <input id="idS" type="hidden" name="idS" value="<?php echo $idS; ?>" class="form-control">
                    </div>
                    <!-- affichage de valeur chaque information des champs de la table stagiaire de la base de données -->
                    <div class="form-group">
                        <label for="nom"> Nom:</label>
                        <input id="nom" type="text" name="nom" placeholder="tapper le nom du stagiaire" value="<?php echo $nom ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom:</label>
                        <input id="prenom" type="text" name="prenom" placeholder="tapper le prenom du stagiaire" value="<?php echo $prenom ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="civilite"> Civilite:</label>
                        <div class='radio'>
                            <label for="civilite">
                                <input type="radio" name="civilite" value="M" id="civilite" <?php if ($civilite === 'M') echo 'checked';  ?>> M:
                            </label><br>
                            <label for="civilite">
                                <input type="radio" name="civilite" value="F" id="civilite" <?php if ($civilite === 'F') echo 'checked';  ?>>F:
                            </label>

                        </div>
                    </div>
                    <!-- avec la fonction onchange on donne le pouvoire de changer automatiquement selon la valeur choisie -->
                    <div class="form-group">
                        <label for="filiere"> Filiere:</label>
                        <select name="idFiliere" class="orm-control" id="idFiliere">
                            <?php while ($filiere = $resulatF->fetch()) { ?>
                                <option value="<?php echo $filiere['idFiliere'] ?>" <?php if ($idFiliere === $filiere['idFiliere']) echo "selected" ?>>
                                    <?php echo $filiere['nomFiliere'] ?></option>
                            <?php   }  ?>
                        </select>
                    </div>
                    <!-- selection des photos -->
                    <div class="form-group">
                        <label for="photo"> Photo:</label>
                        <input id="photo" type="file" name="photo">
                    </div>
                    <!-- le bouton pour envoyen/ lancer la recherche -->
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"></span> Enregistrer</button>
                </form>
            </div>

        </div>
    </div>

</body>

</html>