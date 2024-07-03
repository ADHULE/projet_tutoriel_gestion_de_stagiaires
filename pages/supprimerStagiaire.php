<?php
session_start();
require_once('connexiondb.php');
// **************************************************************************************************
$idS = isset($_GET['idS']) ? $_GET['idS'] : 0;
try {
    //vérification et se retrouver à la page principale du programme si la codition est validée
    if (isset($_SESSION['user'])) {
        $requette = "DELETE FROM stagiaire WHERE idStagiaire=?";
        $paramettre = array($idS);
        $result = $pdo->prepare($requette);
        $result->execute($paramettre);
        // retourner a la page de filiere
        header('location:stagiaire.php');
    } else {
        header('location:login.php');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
