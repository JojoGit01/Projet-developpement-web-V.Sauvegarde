<?php
/*
    - Code permettant la déconnexion de l'utilisateur
    - Si déconnexion cela nous envoye a la page d'accueil (index.php)
*/
session_start();
session_destroy();
header('Location: ../index.php');
?>