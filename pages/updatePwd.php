<?php
require_once('identifierSession.php');
require_once('connexiondb.php');
// recuperation de la clé de l'utilisateur
$iduser = $_SESSION['user']['idUser'];
// recuperer et verification de valeurs introduites par d'utilisateur
$oldPwd = isset($_POST['oldpwd']) ? $_POST['oldpwd'] : '';
$newPwd = isset($_POST['newpwd']) ? $_POST['newpwd'] : 0;
// recuperer le password de la parsonne connecter
$requette = "SELECT * FROM utilisateur WHERE iduser=$iduser AND pwd=md5('$oldPwd')";
$resultat = $pdo->prepare($requette);
$resultat->execute();
// verifier si l'utilisateur existe(a des informations)
$message = "";
$tempsReponse = 3;
$url = "login.php";
if ($resultat->fetch()) {
    $requetUp = "UPDATE utilisateur SET pwd=md5(?) WHERE iduser=?";
    $paramettre = array($newPwd, $iduser);
    $resultat = $pdo->prepare($requetUp);
    $resultat->execute($paramettre);
    $message = "<div class='alert alert-success'>  <strong>Success!</strong> Your password is changed !</div> ";
} else {
    // se retourner à la page precédante
    $message = "<div class='alert alert-danger'> <strong>Error!</strong> Your old password is incorrect! </div>";
    $url = $_SERVER['HTTP_REFERER'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message_Modification_password</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php
        // refrechir et se retourner à la page de connection pendant un certain temps
        echo $message;
        header("refresh:$tempsReponse;url=$url");
        ?>
    </div>
<div class="alert alert-danger"></div>
</body>

</html>