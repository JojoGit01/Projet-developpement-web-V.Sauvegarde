<?php
require_once 'vendor/autoload.php';
use App\User;
use App\App;
if(User::checkIfUserCo(App::getAuth())){
    header('Location: Public/accueilClient.php?log=1');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <div class ="">
        <a href="Public/connexion.php">Connexion</a>
        <br>
        <a href="Public/inscription.php">Inscription</a>
    </div>
</body>
</html>