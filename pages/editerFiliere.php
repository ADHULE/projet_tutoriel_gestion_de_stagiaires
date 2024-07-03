<?php
// ouverture de la session afin de se connecter en une page
session_start();
// le code php pour recuper les informations depuis la base de donnees
require_once("connexiondb.php");
// **************************************************************************************************
try {
    //vérification et se retrouver à la page principale du programme si la codition est validée
    if (isset($_SESSION['user'])) {
        $idfil = isset($_GET['idF']) ? $_GET['idF'] : 0;
        $requet = "SELECT * FROM filiere WHERE  idFiliere=$idfil";
        $resultat = $pdo->query($requet);
        $filiere = $resultat->fetch(); //recuperer la valeur de la requette sous forme d'un tableau associatif
        // recuperation de nom et niveau de la filiere
        $nomf = $filiere['nomFiliere'];
        $niveauf = strtolower($filiere['niveau']);
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
    <title>Edition d'une filière</title>
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
                Edition de la filière:
            </div>
            <div class="panel-body">

                <form action="insertFiliere.php" method="post" class="form">
                    <div class="form-group">
                        <label for="niv"> Id de la filière:<?php echo $idfil; ?></label>
                        <input id="niv" type="hidden" name="idF" value="<?php echo $idfil; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="niv"> Nom de la filière:</label>
                        <input id="niv" type="text" name="nomF" placeholder="tapper le nom de votre filiere" value="<?php echo $nomf; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="niv"> Niveau:</label>
                        <!-- avec la fonction onchange on donne le pouvoire de changer automatiquement selon la valeur choisie -->
                        <select class="form-control" id="niv" name="valeurNiveauUser">
                            <option value="t">technicien</option>
                            <option value="l">license</option>
                            <option value="m">master</option>
                            <option value="q">qualifier</option>
                            <?php
                            // cette partie nous perment maitenir par defaut la valeur selectionnee
                            if ($niveau === "tous")
                                echo "selected";
                            if ($niveau === "t")
                                echo "selected";
                            if ($niveau === "l")
                                echo "selected";
                            if ($niveau === "m")
                                echo "selected";
                            if ($niveau === "q")
                                echo "selected";
                            ?>
                        </select>
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