<?php
session_start();
require_once('connexiondb.php');
// **************************************************************************************************
$idU = isset($_POST['idU']) ? $_POST['idU'] : 0;
$login = isset($_POST['login']) ? $_POST['login'] : "";
$email = strtoupper(isset($_POST['email'])) ? strtoupper(isset($_POST['email'])) : "";
$role = isset($_POST['role']) ? $_POST['role'] : "";
try {
    //vérification et se retrouver à la page principale du programme si la codition est validée
    if (!isset($_SESSION['user'])) {
        $requette = "UPDATE utilisateur SET login=?,email=?,role=? WHERE idUser=?";
        $paramettre = array($login, $email, $role, $idU);
        $resultat = $pdo->prepare($requette);
        $resultat->execute($paramettre);
    } else {
        header('location:login.php');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

// retourner a la page de filiere
header('location:utilisateur.php');
