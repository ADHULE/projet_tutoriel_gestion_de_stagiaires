<?php
session_start();
require_once('connexiondb.php');
// **************************************************************************************************
$idU = isset($_GET['idU']) ? $_GET['idU'] : 0;
try {
    //vérification et se retrouver à la page principale du programme si la codition est validée
    if (isset($_SESSION['user'])) {
        $requette = "DELETE FROM utilisateur WHERE idUser=?";
        $paramettre = array($idU);
        $result = $pdo->prepare($requette);
        $result->execute($paramettre);
        try {
            if ($result) {
                // retourner a la page de filiere
                header('location:utilisateur.php');
            }
        } catch (Exception $e) {
            echo "Erreur: " . $e->getMessage();
        }
    } else {
        header('location:login.php');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
