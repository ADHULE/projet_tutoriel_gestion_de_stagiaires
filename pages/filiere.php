<?php
// *****************************************************************************************************
// appelle de la page menu avec tous les codes
try {
    require_once ("connexiondb.php"); //appelle de la page de la connection 
    $nom = isset($_GET['valeurNomUser']) ? $_GET['valeurNomUser'] : "";
    $niveau = isset($_GET['valeurNiveauUser']) ? $_GET['valeurNiveauUser'] : "tous";
    // pagination de page 
    $size = isset($_GET['size']) ? $_GET['size'] : 6;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $ofset = ($page - 1) * $size;

    $requetteFiliere = "SELECT * FROM filiere";
    $resultatFiliere = $pdo->query($requetteFiliere);
    if ($niveau === "tous") {
        $requetteFiliere = "SELECT * from filiere where nomFiliere like '%$nom%' limit $size offset $ofset";
        // la requette pour selectionner selon le nombre de filieres
        $requetteCount = "select count(*) countFiliere from filiere where nomFiliere like '%$nom%'";
    } else {
        $requetteFiliere = "SELECT * from filiere where nomFiliere like '%$nom%' and niveau='$niveau'";
        $requetteCount = "select count(*) countFiliere from filiere where nomFiliere like '%$nom%' and niveau='$niveau' limit $size offset $ofset";
    }
    $resultatFiliere = $pdo->query($requetteFiliere);
    $resulatCount = $pdo->query("$requetteCount");
    $tableauCount = $resulatCount->fetch();
    $nombrePage = $tableauCount['countFiliere'];
    $reste = $nombrePage % $size;//le reste de la division euclidienne de nombre de filiere par la taille de la page
    if ($reste === 0) {
        $nombrePage = $nombrePage / $size;
    } else {
        $nombrePage = floor($nombrePage / $size) + 1;// la partie entiere d'un nombre 
    }

} catch (Exception $exception) {
    echo 'your erreur is on: ' . $exception->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>filières</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>

<body>
    <?php include ("menu.php"); ?>

    <div class="container">
        <div class="panel panel-primary   marginTop">
            <div class="panel-heading">
                Recherche de Filieres....
            </div>
            <div class="panel-body">
                <h2>
                    Corps de notre panel
                </h2>
                <!-- un formulaire permettant de faire les différentes recherches -->
                <form action="filiere.php" method="get" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="valeurNomUser" placeholder="tapper le nom de votre filiere"
                            class="form-control" value="<?php $nom; ?>">
                    </div>
                    <label for="niv"> Niveau:</label>
                    <!-- avec la fonction onchange on donne le pouvoire de changer automatiquement selon la valeur choisie -->
                    <select class="form-control" id="niv" name="valeurNiveauUser" onchange="this.form.submit()">
                        <option value="tous">Tous les Niveaux</option>
                        <option value="TECHNICIEN">technicien</option>
                        <option value="LICENCIEN">license</option>
                        <option value="MASTER">master</option>
                        <option value="QUALIFIER">qualifier</option>
                        <?php
                        // cette partie nous perment maitenir par defaut la valeur selectionnee
                        if ($niveau === "tous")
                            echo "selected";
                        if ($niveau === "TECHNICIEN")
                            echo "selected";
                        if ($niveau === "LICENCIEN")
                            echo "selected";
                        if ($niveau === "MASTER")
                            echo "selected";
                        if ($niveau === "QUALIFIER")
                            echo "selected";
                        ?>
                    </select>
                    <!-- le bouton pour envoyen/ lancer la recherche -->
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span> Rechercher...</button>
                    &nbsp &nbsp
                    <a href="nouvelleFiliere.php" class="glyphicon glyphicon-plus">Nouvelle Filière</a>
                </form>
            </div>
        </div>
        <div class="panel panel-success">
            <div class="panel-heading">
                Liste des Filieres (
                <?php echo $nombrePage ?>Filieres
                )
            </div>
            <div class="panel-body">
                <h2>Tableau de Filieres</h2>
                <!-- tableau pour afficher les informations stockees du filières dans la base des donnees -->
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id_Filiere</th>
                            <th>Nom_Filiere</th>
                            <th>Niveau</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <!-- tant qu'il ya de valeur dans le tabaleu alors afficher: NB: la fonction fetch permet de retourner les valeurs sous une forme de tableau artimetiquue -->
                    <?php while ($filiere = $resultatFiliere->fetch()) { ?>
                        <tr>
                            <td> <?php echo $filiere['idFiliere'] ?></td>
                            <td> <?php echo $filiere['nomFiliere'] ?></td>
                            <td> <?php echo $filiere['niveau'] ?></td>
                            <!-- les actions sur les donnees*************************************************************************** -->
                            <td>
                                <a onclick="return confirm('Voulez vous vraiment modifier cette information?')"
                                    href="editerFiliere.php?idF= <?php echo $filiere['idFiliere'] ?>"
                                    class="glyphicon glyphicon-edit"></a>
                                <a onclick="return confirm('Etes vous sur de vouloir supprimer cette information?')"
                                    href="supprimerFiliere.php?idF= <?php echo $filiere['idFiliere'] ?>"
                                    class="glyphicon glyphicon-trash"></a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <!-- boutton pour le nombre de pagination permettant de daviguer entre les differences pages -->
                <div>
                    <ul class="pagination pagination-sm">
                        <?php for ($i = 1; $i <= $nombrePage; $i++) { ?>
                            <li class="<?php if ($i == $page)
                                echo 'active'; ?>"><a
                                    href="filiere.php?page=<?php echo $i; ?>&nom=<?php echo $nom ?>&niveau=<?php echo $niveau ?>">
                                    <?php echo $i; ?>
                                </a></li>

                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>