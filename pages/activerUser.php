<?php
// ouverture de la session afin de se connecter en une page
session_start();
require_once('connexiondb.php');
// **************************************************************************************************
try {
    //vérification et se retrouver à la page principale du programme si la codition est validée
    if (isset($_SESSION['user'])) {
        $idU = isset($_GET['idU']) ? $_GET['idU'] : 0;
        $etat = isset($_GET['etat']) ? $_GET['etat'] : 0;
        try {
            if ($etat == 1)
                $newEtat = 0;
            else
                $newEtat = 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        $requette = "UPDATE utilisateur SET etat=? WHERE idUser=?";
        $paramettre = array($newEtat, $idU);
        $resultat = $pdo->prepare($requette);
        $resultat->execute($paramettre);
        // retourner a la page de filiere
        header('location:utilisateur.php');
    } else header('location:login.php');
} catch (Exception $e) {
    echo $e->getMessage();
}
