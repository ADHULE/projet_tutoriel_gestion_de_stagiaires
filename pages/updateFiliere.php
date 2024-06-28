<?php
require_once ('connexiondb.php');
$idf = isset($_POST['idF']) ? $_POST['idF'] : 0;
$nomf = isset($_POST['nomF']) ? $_POST['nomF'] : "";
$niveauf = isset($_POST['valeurNiveauUser']) ? $_POST['valeurNiveauUser'] : "";
$requette = "UPDATE filiere SET nomFiliere=?,niveau=?WHERE idFiliere=?";
$paramettre = array($nomf, $niveauf, $idf);
$resultat = $pdo->prepare($requette);
$resultat->execute($paramettre);
// retourner a la page de filiere
header('location:filiere.php');

?>