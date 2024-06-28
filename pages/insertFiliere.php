<?php
require_once ('connexiondb.php');
$nomf = isset($_POST['valeurNomUser']) ? $_POST['valeurNomUser'] : "";
$niveauf = isset($_POST['valeurNiveauUser']) ? $_POST['valeurNiveauUser'] : "";
$requette = "INSERT INTO filiere(nomFiliere,niveau) VALUES(?,?)";
$paramettre = array($nomf, $niveauf);
$resultat = $pdo->prepare($requette);
$resultat->execute($paramettre);
// retourner a la page de filiere
header('location:filiere.php');

?>