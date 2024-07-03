<?php
// require_once('identifierSession.php');
require_once('connexiondb.php');
require_once('mesFonction.php');
// echo rechercher_utilisateur_par_login('USER');
// une condition qui permet d'ajouter l'utilisateur seulement dans cette page
$messageCreation = "";
try {
    if (isset($_POST['login']) && isset($_POST['mail']) && isset($_POST['pw'])) {
        // recuperation, securiser et la verificatin des données introduites  
        $login = strip_tags($_POST['login']);
        $email = strip_tags($_POST['mail']);
        $_pwd = $_POST['pw'];
        // verifier un champs de texte n'est pas vide alors..........
        if (!empty($login) && !empty($email) && !empty($_pwd)) {
            // verification s'il n'existe pas un autre utilisateur avec le meme nom et la meme adresse email alors....
            if (rechercher_utilisateur_par_login($login) == 0 && rechercher_utilisateur_par_email($email) == 0) {
                if ($_POST['password'] >= 8) {
                    $requette = $pdo->prepare("INSERT INTO utilisateur(login,email,role,etat,pwd) VALUES (?,?,?,?,?)");
                    $requette->execute(array($login, $email, 'VISITEUR', 1, md5($_pwd)));
                    $messageCreation = " <div class='alert alert-success'>Success your compt is created, but isn't functionaly</div>";
                } else {

                    $messageCreation = "<div class='alert alert-danger'> Insert the password > 4!</div>";
                }
            } else {
                if (rechercher_utilisateur_par_login($login) !== 0) {
                    $messageCreation = "<div class='alert alert-danger'>That Login existed!</div>";
                }
                if (rechercher_utilisateur_par_email($email) !== 0) {
                    $messageCreation = "<div class='alert alert-danger'>That email existed</div> ";
                }
            }
        } else {
            $messageCreation = "<div class='alert alert-danger'>Faut remmplir tout le champs de texte</div> ";
        }
    }
} catch (Exception $exception) {
    echo $exception->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>créer un compte</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"><!-- appelle de la page et le fichier de la classe bootstrap-->
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>

<body>
    <div class="container">
        <form method="post" class="form" action="creerCompte.php">
            <h1>NEW ACOUNT</h1>
            <div class="form-group">
                <label for="login">Insert the Login:</label>
                <input type="text" name="login" id="login" class="form-control" placeholder="Login">
            </div>
            <div class="form-group">
                <label for="mail"> Insert the Email:</label>
                <input type="mail" name="mail" id="mail" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="pw" class="text_center"> Insert the password:</label>
                <input type="password" name="pw" id="pw" class="form-control" placeholder="Insert the password">
            </div>
    
            <button type="submit" class="btn btn-success ">
                <span class="glyphicon glyphicon-save"></span>Enregistrer</button>
            </button>
            <div class="form-group">
                <?php echo $messageCreation ?>
            </div>
        </form>
    </div>
</body>

</html>