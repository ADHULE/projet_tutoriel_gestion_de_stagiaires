<?php
// require_once('identifierSession.php');
require_once('mesFonction.php');
require_once('connexiondb.php');
if (isset($_POST['email'])) {
    $monEmail = $_POST['email'];
} else {
    $monEmail = "";
}

$user = rechercher_utilisateur_par_email($monEmail);
try{
    if ($user !== null) {
        // $id = $user['idUser'];
        $requette = $pdo->prepare("UPDATE utilisateur SET pwd=md5('0000')");
        $requette->execute();
        $pour = $monEmail;
        $object = "Initialisation de mot de passe";
        $contenue = "Votre password a été restauré par '0000'" . "/n" . "vous pouvez le modifier à la premère connection";
        $entete = "From: App Gestion de Stagiaires " . "SAD:" ."adhulejean@gmail.com". "2024";
        mail($pour, $object, $contenue, $entete);
    } else {
        echo "Adresse Email incorrect!";
    }

} catch(Exception $e){
    echo $e->getMessage();
}
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

<body>
    <div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-6">
        <div class="panel panel-primary   marginTop">
            <div class="panel-heading">
                Renitialiser Votre password
            </div>
            <div class="panel-body">
                <form action="restaurerPassword.php" method="post" class="form">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input id="email" type="email" name="email" placeholder="Your are email address" class="form-control">
                    </div>
                    <!-- le bouton pour envoyen/ lancer la recherche -->
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-log-save"></span> Renitialiser </button>
                </form>
            </div>

        </div>
    </div>

</body>

</html>