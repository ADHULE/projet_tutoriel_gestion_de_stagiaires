<?php
session_start();
require_once('connexiondb.php');
// **************************************************************************************************
$idf = isset($_POST['idF']) ? $_POST['idF'] : 0;
$nomf = isset($_POST['nomF']) ? $_POST['nomF'] : "";
try {
    //vérification et se retrouver à la page principale du programme si la codition est validée
    if (isset($_SESSION['user'])) {
        $niveauf = isset($_POST['valeurNiveauUser']) ? $_POST['valeurNiveauUser'] : "";
        $requette = "UPDATE filiere SET nomFiliere=?,niveau=?WHERE idFiliere=?";
        $paramettre = array($nomf, $niveauf, $idf);
        $resultat = $pdo->prepare($requette);
        $resultat->execute($paramettre);
        // retourner a la page de filiere
        header('location:filiere.php');
    } else {
        header('location:login.php');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
