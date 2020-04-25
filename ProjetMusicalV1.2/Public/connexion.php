<?php
require_once '../vendor/autoload.php';
require_once '../useFunction/sanitizeString.php';
use App\User;
use App\App;
session_start();
$auth = App::getAuth();
$error = false;

//On vérifie que l'utilisateur n'est pas déja connecté
if(User::checkIfUserCo($auth)){
    header('Location: ../Public/accueilClient.php?login=1');
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
        <link rel="stylesheet" href="../Css/styleConnexion.css">
        <title>Connexion Musical</title>
    </head>
    <body class="body-C">
        <header class="topbar">
            <nav>
                <div class="topbar-G"></div>
                    <img src="../img/imgtop.png" alt="Image Topbar" width="150px" height="auto">
                </div>
                <div class="topbar-D">
                    <a href="../index.php" title="Accueil Musical" class="accueil">Accueil</a>
                    <a href="#" title="A propos" class="aPropos">A propos</a>
                </div>
            </nav>
        </header>
        <div class="body-Connexion">
            <main class="main-Connexion">
                <form action="" method="post">
                    <fieldset class="fieldset-C">
                        <legend>Connexion</legend>
                        <?php if($error): ?>
                            <label class="error">Identifiant ou mot de passe incorrect</label>
                        <?php endif ?>  
                        <div class="identifiantC">
                            <label for="identifiantC">Identifiant :</label>
                            <input type="text" name="username" placeholder="identifiant">
                        </div>
                        <div class="motDePasseC">
                            <label for="motDePasseC">Mot de passe :</label>
                            <input type="password" name="password" placeholder="mot de passe">
                        </div>
                        <div class="buttonC">
                            <input type="submit" name="ValiderC" value="Se connecter">
                            <input type="reset" id="resetC" name="resetC" value="Annuler">
                        </div>
                    </fieldset>
                </form>
            </main>
        </div>
        <footer class="footer">
            <nav>
                <a href="#" title="Conctater nous">Contactez nous</a>
                <a href="#" title="Information légales">Information légales</a>
                <a href="#" title="Politique de confidentialité Musical">Politique de confidentialité Musical</a>
                <a href="#" title="Information sur les cookies">Information sur les cookies</a>
            </nav>
        </footer>
    </body>
</html>