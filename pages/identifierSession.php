<?php
// ouverture de la session afin de se connecter en une page
session_start();
try {
    //vérification et se retrouver à la page principale du programme si la codition est validée
    if (!isset($_SESSION['user'])) header('location:login.php');
} catch (Exception $e) {
    echo $e->getMessage();
}
