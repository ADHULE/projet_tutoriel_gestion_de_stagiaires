<?php
// appelle de la page de gestion de securité des différentes pages
require_once('identifierSession.php');
// **************************************************************************************************

// le code php pour recuper les informations depuis la base de donnees
require_once("connexiondb.php");
// une requette pour afficher toutes les filieres
$requetteF = 'SELECT * FROM filiere';
$resulatF = $pdo->query($requetteF);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'un nouveau Stagiaire</title>
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
                Informations de nouveau Stagiaire:
            </div>
            <div class="panel-body">
                <form action="insertStagiaire.php" method="post" class="form" enctype="multipart/form-data">

                    <!-- affichage de valeur chaque information des champs de la table stagiaire de la base de données -->
                    <div class="form-group">
                        <label for="nom"> Nom:</label>
                        <input id="nom" type="text" name="nom" placeholder="tapper le nom du stagiaire" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom:</label>
                        <input id="prenom" type="text" name="prenom" placeholder="tapper le prenom du stagiaire" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="civilite"> Civilite:</label>
                        <div class='radio'>
                            <label for="civilite">
                                <input type="radio" name="civilite" value="M" id="civilite" checked> M:
                            </label><br>
                            <label for="civilite">
                                <input type="radio" name="civilite" value="F" id="civilite">F:
                            </label>

                        </div>
                    </div>
                    <!-- avec la fonction onchange on donne le pouvoire de changer automatiquement selon la valeur choisie -->
                    <div class="form-group">
                        <label for="filiere"> Filiere:</label>
                        <select name="idFiliere" class="orm-control" id="idFiliere">
                            <?php while ($filiere = $resulatF->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $filiere['idFiliere'] ?>">
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