<?php
session_start();
require_once('connexiondb.php');
// **************************************************************************************************
$nom = isset($_POST['nom']) ? $_POST['nom'] : "";
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
$civilite = isset($_POST['civilite']) ? $_POST['civilite'] : "";
$idFilie = isset($_POST['idFilie']) ? $_POST['idFilie'] : "";
$nomPhoto = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : "";
// recuper une image temporairement
$nomPhomoTemporaire = $_FILES['photo']['tmp_name'];
// enregistrer la vraie image (le vrai fichier) dans un donne avec le nom du fichier choisi
move_uploaded_file($nomPhomoTemporaire, "../images/" . $nomPhoto);
try {
    //vérification et se retrouver à la page principale du programme si la codition est validée
    if (isset($_SESSION['user'])) {
        // verification si la place de la photo est vide alors ajouter une sinon ne rien modifier (photo)
        $requette = "INSERT INTO stagiaire(nom,prenom,civilite,photo,idFiliere) VALUES(?,?,?,?,?)";
        $paramettre = array($nom, $prenom, $civilite, $nomPhoto, $idFilie);
        $resultat = $pdo->prepare($requette);
        $resultat->execute($paramettre);
    } else {
        header('location:login.php');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

// retourner a la page de filiere
header('location:stagiaire.php');
