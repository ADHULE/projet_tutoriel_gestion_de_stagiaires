<?php
session_start();
require_once("connexiondb.php");
// **************************************************************************************************
try {
    //vérification et se retrouver à la page principale du programme si la codition est validée
    if (isset($_SESSION['user'])) {
        // le code php pour recuper les informations depuis la base de donnees
        $idU = isset($_GET['idU']) ? $_GET['idU'] : 0;
        // requette pour modifier l'utilisateur
        $requetUser = "SELECT * FROM utilisateur WHERE idUser=$idU";
        $resulatUser = $pdo->query($requetUser);
        $user = $resulatUser->fetch(); //recuperer la valeur de la requette sous forme d'un tableau associatif
        // recuperation de l'informations du stagiaire depuis la base de données
        $login = $user['login'];
        $email = $user['email'];
        // changer la valeur de role en magiscule
        $role = strtoupper($user['role']);
        $requette=$pdo->prepare("SELECT * FROM utilisateur");
        $requette->execute();
        
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
    <title>Edition de l'utilisateur</title>
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
                Edition d'utilisateur:
            </div>
            <div class="panel-body">
                <form action="updateUser.php" method="post" class="form">
                    <div class="form-group">
                        <label for="idU"> Id :<?php echo $idU; ?></label>
                        <input id="idU" type="hidden" name="idU" value="<?php echo $idU; ?>" class="form-control">
                    </div>
                    <!-- affichage de valeur chaque information des champs de la table stagiaire de la base de données -->
                    <div class="form-group">
                        <label for="login"> Login:</label>
                        <input id="login" type="text" name="login" placeholder="Login" value="<?php echo $login ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input id="email" type="email" name="email" placeholder="Email" value="<?php echo $email ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <select name="role" class="form-control">
                            <option value="ADMIN" <?php if ($role === "ADMIN") echo 'selected' ?>>Administrateur</option>
                            <option value="VISITEUR" <?php if ($role === "VISITEUR") echo 'selected' ?>>Visiteur</option>
                        </select>
                    </div>
                    <!-- le bouton pour envoyen/ lancer la recherche -->
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"></span> Enregistrer</button>
                    <!--lien pour changer le mot de passe de l'utilisateur avec la clé primaire comme paramettre-->
                    &nbsp;&nbsp;
                        <a href="modifierPassword.php?idU=<?php echo $idU ?>">Changer Mot de passe</a>
                  
                </form>
            </div>

        </div>
    </div>

</body>

</html>