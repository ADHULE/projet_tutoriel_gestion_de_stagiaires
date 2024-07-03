<?php
session_start();
require_once('connexiondb.php');
// **************************************************************************************************
$idS = isset($_POST['idS']) ? $_POST['idS'] : 0;
$nom = isset($_POST['nom']) ? $_POST['nom'] : "";
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
$civilite = isset($_POST['civilite']) ? $_POST['civilite'] : "";
$idFilie = isset($_POST['idFilie']) ? $_POST['idFilie'] : "";
$nomPhoto = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : "";
// recuper une image temporairement
$nomPhomoTemporaire = $_FILES['photo']['tmp_name'];
// enregistrer la vraie image (le vrai fichier) dans un donne avec le nom du fichier choisi
move_uploaded_file($nomPhomoTemporaire, "../images/" . $nomPhoto);
// verification si la place de la photo est vide alors ajouter une sinon ne rien modifier (photo)
try {
    //vérification et se retrouver à la page principale du programme si la codition est validée
    if (isset($_SESSION['user'])) {
        if (!empty($nomPhoto)) {
            $requette = "update stagiaire set nom=?, prenom=?, civilite=?,idFiliere=?,photo=? where idStagiaire=?";
            $paramettre = array($nom, $prenom, $civilite, $idFilie, $nomPhoto, $idS);
        } else {
            $requette = "update stagiaire set nom=?, prenom=?, civilite=?,idFiliere=? where idStagiaire=?";
            $paramettre = array($nom, $prenom, $civilite, $idS, $idFilie);
        }
        $resultat = $pdo->prepare($requette);
        $resultat->execute($paramettre);
        // retourner a la page de filiere
        header('location:stagiaire.php');
    } else {
        header('location:login.php');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}



