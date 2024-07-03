<?php
// ouverture de la session
session_start();
require_once("connexiondb.php"); //appelle de la page de la connection à la base de données
$login = isset($_POST['login']) ? $_POST['login'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
// recuperation login et password à decriptant le mot de passe parce que cela a été cripté dans la base de données
$requet = "SELECT idUser,login,email,role,etat FROM utilisateur WHERE login='$login' AND pwd=md5('$password')";
//recuperer la valeur de la requette sous forme d'un tableau associatif
$resultat = $pdo->query($requet);

// verification d'utilisateur avec son etat bien-sur s'il existe
if ($user = $resultat->fetch()) {
    if ($user['etat'] == 1) {
        $_SESSION['user'] = $user;
        try {
            header('location:../index.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        $_SESSION['erreurLogin'] = "<strong>Error!!</strong> Votre compte de desactivé. <br> Prière de contacter l'administrateur.";
        header('location:login.php');
    }
} else {
    $_SESSION['erreurLogin'] = "<strong>Error!!</strong> Login où Password incorrecte.";
    header('location:login.php');
}
?>