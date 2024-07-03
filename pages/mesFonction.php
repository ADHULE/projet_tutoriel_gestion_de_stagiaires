<?php
function rechercher_utilisateur_par_login($login)
{
    global $pdo; //appelle de la chaine de connection qui est variable globale
    $requette = $pdo->prepare("SELECT * FROM utilisateur WHERE login=?");
    $requette->execute(array($login));
    return $requette->rowCount();
}
function rechercher_utilisateur_par_email($email)
{
    global $pdo; //appelle de la chaine de connection qui est variable globale
    $requette = $pdo->prepare("SELECT * FROM utilisateur WHERE email=?");
    $requette->execute(array($email));
    return $requette->rowCount();
}
