<?php
session_start();
require_once('connexiondb.php');
// **************************************************************************************************
$nomf = isset($_POST['valeurNomUser']) ? $_POST['valeurNomUser'] : "";
$niveauf = isset($_POST['valeurNiveauUser']) ? $_POST['valeurNiveauUser'] : "";
try {
    //vérification et se retrouver à la page principale du programme si la codition est validée
    if (isset($_SESSION['user'])) {
        $requette = "INSERT INTO filiere(nomFiliere,niveau) VALUES(?,?)";
        $paramettre = array($nomf, $niveauf);
        $resultat = $pdo->prepare($requette);
        $resultat->execute($paramettre);
    } else {
        header('location:login.php');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
// retourner a la page de filiere
header('location:filiere.php');
