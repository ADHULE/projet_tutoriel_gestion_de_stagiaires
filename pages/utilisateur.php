<?php
// ouverture de la session afin de se connecter en une page
session_start();
require_once("connexiondb.php"); //appelle de la page qui gere la connection à la base de données
// **************************************************************************************************
//recuperation de information introduites par l'utilisateur
$login = isset($_GET['login']) ? $_GET['login'] : "";
// pagination
$size = isset($_GET['size']) ? $_GET['size'] : 3;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$ofset = ($page - 1) * $size;
try {
    //vérification et se retrouver à la page principale du programme si la codition est validée
    if (isset($_SESSION['user'])) {
        $requetteUser = "SELECT * FROM utilisateur WHERE login LIKE'%$login%'";
        $countUser = "SELECT count(*) countU FROM utilisateur";
        // executer les differentes requettes
        $resultatUser = $pdo->query($requetteUser);
        $resulCountUser = $pdo->query($countUser);
        $data = $resulCountUser->fetch();
        $nbreUser = $data['countU'];
        $reste = $nbreUser % $size;
        // verification de nombre de pages
        if ($reste === 0) {
            $nbrPage = $nbreUser / $size;
        } else {
            $nbrPage = floor($nbreUser / $size) + 1;
        }
    } else header('location:login.php');
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"><!-- appelle de la page et le fichier de la classe bootstrap-->
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>

<body>
    <!-- appelle de la base de la menu -->
    <?php include("menu.php"); ?>
    <div class="container">
        <div class="panel panel-success haut">
            <div class="panel-heading">Recherche des utilisateurs...</div>
            <div class="panel-body">
                <form method="get" action="utilisateur.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="login" id="login" class="form-control" value="<?php $login; ?>">
                    </div>
                    <!-- le bouton pour envoyen/ lancer la recherche -->
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span> Rechercher...</button>
                        &nbsp &nbsp
                    <!-- securité de l'opération pour d'autres utilisateurs car seul l'administrateur a le droit -->
                    <?php if ($_SESSION['user']['role'] == "ADMIN") { ?>
                        <a href="nouveauUtilisateur.php" class="glyphicon glyphicon-plus">Nouveau Utilisateur</a>
                    <?php } ?>
                </form>
            </div>
        </div>
        <div class="panel panel-primary ">
            <div class="panel-heading">Liste des utilisateurs (<?php echo $nbreUser ?> utilisateurs)</div>
            <div class="panel-body">
                <!-- afficcher toutes les informations dans un tableau biensur dans la page html -->
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>idUser</th>
                            <th>login</th>
                            <th>Email</th>
                            <th>Role</th>
                            <!-- <th>Etat</th> -->
                            <!-- securité de l'opération pour d'autres utilisateurs car seul l'administrateur a le droit -->
                            <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                <th>Actions</th>

                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- parcourir tout tableau contenant les informations afin d'afficher chaque champ de la base de données -->
                        <?php while ($user = $resultatUser->fetch()) { ?>
                            <!-- Dans la balise tr nous avons ajouter une classe dans laquelle nous verifions l'etat des utilisateurs puis nous les soulignons 
                             avec une couleur selon l'etat de tout un chacun d'eux -->
                            <tr class="<?php echo $user['etat'] === 1 ? 'success' : 'danger' ?> ">
                                <td> <?php echo $user['idUser'] ?> </td>
                                <td> <?php echo $user['login'] ?> </td>
                                <td> <?php echo $user['email'] ?> </td>
                                <td> <?php echo $user['role'] ?> </td>
                                <!-- securité de l'opération pour d'autres utilisateurs car seul l'administrateur a le droit -->
                                <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                    <td>
                                        <a onclick="return confirm('Voulez vous vraiment modifier cette information?')" href="editerUtilisateur.php?idU= 
                                        <?php echo $user['idUser'] ?>" class="glyphicon glyphicon-edit"></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a onclick="return confirm('Etes vous sur de vouloir supprimer cette information?')" href="supprimerUtilisateur.php?idU= 
                                        <?php echo $user['idUser'] ?>" class="glyphicon glyphicon-trash"></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <!-- Affichage des iconnes afin de visualiser l'etat des utilisateurs  -->
                                        <a href="activerUser.php?idU=<?php echo $user['idUser'] ?>&etat=<?php echo $user['etat'] ?>">
                                            <?php if ($user['etat'] === 1)
                                                echo '<span class="glyphicon glyphicon-remove"></span>';
                                            else
                                                echo '<span class="glyphicon glyphicon-ok"></span>';
                                            ?>
                                        </a>
                                    </td>
                                <?php } ?>

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
                                <a href="utilisateur.php?page=<?php echo $i; ?>&login=<?php echo $login ?>">
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