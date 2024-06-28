<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle filière</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>

<body>
    <?php
    // appelle de la page menu avec tous les codes
    include ("menu.php");
    ?>
    <div class="container">
        <div class="panel panel-primary   marginTop">
            <div class="panel-heading">
                Ajouter les informations (données) de la nouvelle filière
            </div>
            <div class="panel-body">

                <form action="insertFiliere.php" method="post" class="form">
                    <div class="form-group">
                        <label for="niv"> Nom de la filière:</label>
                        <input id="niv" type="text" name="valeurNomUser" placeholder="tapper le nom de votre filiere"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="niv"> Niveau:</label>
                        <!-- avec la fonction onchange on donne le pouvoire de changer automatiquement selon la valeur choisie -->
                        <select class="form-control" id="niv" name="valeurNiveauUser">
                        <option value="TECHNICIEN">technicien</option>
                        <option value="LICENCIEN">license</option>
                        <option value="MASTER">master</option>
                        <option value="QUALIFIER">qualifier</option>
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