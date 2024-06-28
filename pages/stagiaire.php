<?php
require_once ("connexiondb.php");//appelle de la page qui gere la connection à la base de données
//recuperation de information introduites par l'utilisateur
$nomPrenom = isset($_GET['nomPrenom']) ? $_GET['nomPrenom'] : "";
$filiere = isset($_GET['filiere']) ? $_GET['filiere'] : 0;
$size = isset($_GET['size']) ? $_GET['size'] : 7;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$ofset = ($page - 1) * $size;
// afficher toutes les filieres
$requetFiliere = "SELECT * FROM filiere";

if ($filiere == 0) {
    $requetteStagiaire = "SELECT idStagiaire,nom,prenom,nomFiliere,photo,civilite FROM filiere as f,stagiaire as s WHERE f.idFiliere=s.idFiliere and (nom LIKE '%$nomPrenom%' or prenom LIKE '%$nomPrenom%' ) order by idStagiaire LIMIT $size offset $ofset";
    $countStagiaire = "SELECT count(*) countF FROM stagiaire WHERE nom LIKE '%$nomPrenom%' or prenom LIKE '%$nomPrenom%'";
} else {
    $requetteStagiaire = "SELECT idStagiaire,nom,prenom,nomFiliere,photo,civilite FROM filiere as f,stagiaire as s WHERE f.idFiliere=s.idFiliere and (nom LIKE '%$nomPrenom%' or prenom LIKE '%$nomPrenom%' ) and f.idFiliere=$filiere order by idStagiaire LIMIT $size offset $ofset";
    $countStagiaire = "SELECT count(*) countF FROM stagiaire WHERE (nom LIKE '%$nomPrenom%' or prenom LIKE '%$nomPrenom%')and idFiliere=$filiere";
}
// executer les differentes requettes
$resultatFiliere = $pdo->query($requetFiliere);
$resulStagiaire = $pdo->query($requetteStagiaire);
$resulCountStagiaire = $pdo->query($countStagiaire);
$data = $resulCountStagiaire->fetch();
$nbreStagiaire = $data['countF'];
$reste = $nbreStagiaire % $size;
// verification de nombre de pages
if ($reste === 0) {
    $nbrPage = $nbreStagiaire / $size;
} else {
    $nbrPage = floor($nbreStagiaire / $size) + 1;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de stagiaire</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"><!-- appelle de la page et le fichier de la classe bootstrap-->
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>

<body>
    <!-- appelle de la base de la menu -->
    <?php include ("menu.php"); ?>

    <div class="container">
        <div class="panel panel-success haut">
            <div class="panel-heading">Recherche des stagiaire...</div>
            <div class="panel-body">
                <form method="get" action="stagiaire.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="nomPrenom" id="nomPrenom" placeholder="taper nom de la stagiaire..."
                            class="form-control" value="<?php $nomPrenom; ?>">
                    </div>
                    <!-- selection toutes les filieres qui se retrouvent dans lq base de données -->
                    <label for="filiere">Filiere </label>
                    <select name="filiere" class="orm-control" id="filiere">
                        <option value=0>Toutes le filiere</option>
                        <?php while ($valeur = $resultatFiliere->fetch()) { ?>
                            <option value="<?php echo $valeur['idFiliere'] ?>">
                                <?php echo $valeur['nomFiliere'] ?>
                            </option>
                        <?php } ?>
                    </select>
                    <!-- le bouton pour envoyen/ lancer la recherche -->
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span> Rechercher...</button>
                    &nbsp &nbsp
                    <a href="nouveauStagiaire.php" class="glyphicon glyphicon-plus">Nouveau stagiaire</a>
                </form>
            </div>
        </div>
        <div class="panel panel-primary ">
            <div class="panel-heading">Liste des stagiaires (<?php echo $nbreStagiaire ?> stagiaire)</div>
            <div class="panel-body">
                <!-- afficcher toutes les informations dans un tableau biensur dans la page html -->
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID stagiaire</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>filiere</th>
                            <th>Photo</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- parcourir tout tableau contenant les informations afin d'afficher chaque champ de la base de données -->
                        <?php while ($stagiaire = $resulStagiaire->fetch()) { ?>
                            <tr>
                                <td> <?php echo $stagiaire['idStagiaire'] ?> </td>
                                <td> <?php echo $stagiaire['nom'] ?> </td>
                                <td> <?php echo $stagiaire['prenom'] ?> </td>
                                <td> <?php echo $stagiaire['nomFiliere'] ?> </td>
                                <td>
                                    <!-- recuperation et stockage temporere des images -->
                                    <img src="../images/<?php echo $stagiaire['photo'] ?>" width="50px" ; height="50px" ;
                                        class="img-circle">
                                </td>
                                <td>
                                    <a onclick="return confirm('Voulez vous vraiment modifier cette information?')"
                                        href="editerStagiaire.php?idF= <?php echo $stagiaire['idStagiaire'] ?>"
                                        class="glyphicon glyphicon-edit"></a>
                                    <a onclick="return confirm('Etes vous sur de vouloir supprimer cette information?')"
                                        href="supprimerStagiaire.php?idF= <?php echo $stagiaire['idStagiaire'] ?>"
                                        class="glyphicon glyphicon-trash"></a>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
                <div>
                    <!-- pagination de pages -->
                    <ul class="pagination">
                        <?php for ($i = 1; $i < $nbrPage; $i++) { ?>
                            <li class="<?php if ($i == $page)
                                echo 'active' ?>">
                                    <a
                                        href="stagiaire.php?page=<?php echo $i; ?>&nomPrenom=<?php echo $nomPrenom ?>&filiere=<?php echo $filiere ?>">
                                    <?php echo $i; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>