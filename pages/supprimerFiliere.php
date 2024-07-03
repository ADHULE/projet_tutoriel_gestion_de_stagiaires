<?php
session_start();
require_once('connexiondb.php');
// **************************************************************************************************
$idf = isset($_GET['idF']) ? $_GET['idF'] : 0;
// requette pour recupeter et comparer l'identifiant de stagiaire
$requetteStagiaire = "SELECT COUNT(*) countStagiaire FROM stagiaire WHERE idFiliere=$idf";
$resultatStagiaire = $pdo->query($requetteStagiaire);
$tabCountStagiaire = $resultatStagiaire->fetch();
$nbrStagiaire = $tabCountStagiaire['countStagiaire'];
try {
    //vérification et se retrouver à la page principale du programme si la codition est validée
    if (isset($_SESSION['user'])) {
        if ($nbrStagiaire === 0) {
            $requette = "DELETE FROM filiere WHERE idFiliere=?";
            $paramettre = array($idf);
            $result = $pdo->prepare($requette);
            $result->execute($paramettre);
            // retourner a la page de filiere
            header('location:filiere.php');
        } else {
            $msg = "suppresion imposible: vous devez supprimer tous les stagiaires escript dans cette filiere";
            header("location:alerte.php?message=$msg");
        }
    } else {
        header('location:login.php');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
