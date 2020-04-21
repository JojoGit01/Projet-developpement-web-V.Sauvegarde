<?php
require_once '../vendor/autoload.php';
require_once '../useFunction/sanitizeString.php';
use App\User;
use App\App;
$auth = App::getAuth();
session_start();
$error = false;

//On vérifie que l'utilisateur n'est pas déja connecté
if(User::checkIfUserCo($auth)){
    header('Location: ../Public/accueilClient.php?log=1');
    exit();
}

if(isset($_POST['ValiderC'])) {
    $username = sanitizeString($_POST['username']);
    $password = sanitizeString($_POST['password']);
    if(!empty($_POST)){
        $user = $auth->login($username, $password);
        if($user){
            header('Location: accueilClient.php?login=1');
            exit();
        }
        $error = true;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <?php if($error): ?>
        <p>Identifiant ou mot de passe incorrect</p>
    <?php endif ?>
    <div class = "">
        <form action ="" method="post">
            <input type="text" name="username" placeholder="identifiant">
            <input type="password" name="password" placeholder="mdp">
            <br>
            <input type="submit" name="ValiderC" value="Se connecter">
        </form>
    </div>
</body>
</html>