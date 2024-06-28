<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=gestion_stagiaires;charset=utf8", "root", "");
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . "";
}
?>