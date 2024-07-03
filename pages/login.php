<?php
session_start();
// recuperation de message d'erreur
try {
    if (isset($_SESSION['erreurLogin'])) {
        $messageErreur = $_SESSION['erreurLogin'];
    } else {
        $messageErreur = "";
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}
// effacer le message en arretant la session
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter(Login)</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>

<body class="bodylogin">
    <div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-6">
        <div class="panel panel-primary   marginTop">
            <div class="panel-heading">
                SE CONNECTER
            </div>
            <div class="panel-body">
                <form action="seConnecter.php" method="post" class="form">
                    <!-- afficher le message d'erreur -->
                    <?php if (!empty($messageErreur)) { ?>
                        <div class="alert alert-danger">
                            <?php echo $messageErreur ?>
                        </div>

                    <?php  } ?>
                    <!-- affichage de valeur chaque information des champs de la table stagiaire de la base de données -->
                    <div class="form-group">
                        <label for="login"> Login:</label>
                        <input id="login" type="text" name="login" placeholder="Login" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input id="password" type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                    <!-- le bouton pour envoyen/ lancer la recherche -->
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-log-in"></span> Se connecter</button>
                        &nbsp; &nbsp;
                        <div class="div_a_login">
                            <a href="restaurerPassword.php" class="bi bg-info a_login"> 
                            <span class="glyphicon glyphicon-log-in"> Mot de passe Oublier!</span> 
                            </a>
                            &nbsp; &nbsp;
                           <a href="creerCompte.php" class="glyphicon glyphicon-log- a_login">
                           Créer un compte !</a>
            
                       </div>
                </form>
            </div>

        </div>
    </div>

</body>

</html>