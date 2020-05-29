<?php
//Creator : Jonathan
//Page principal
require_once 'vendor/autoload.php';
use App\User;
use App\App;
// Vérifie si l'utilisateur ne s'est pas déja connecter //
if(User::checkIfUserCo(App::getAuth())) {
    header('Location: Public/accueilClient.php?login=1');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta name="Description" content="Site musical">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="Js/footerInformation/information.js"></script>
        <link rel="stylesheet" href="Css/style.css">
        <title>Accueil Musical</title>
    </head>
    <body>
        <header class="topbar">
            <nav>
                <img src="img/imgtop.png" alt="Image Topbar" width="150px" height="auto">
                <div class="topbar-D">
                    <a href="index.php" title="Accueil Musical">Accueil</a>
                    <a href="Public/inscription.php" title="Inscription Musical">Inscription</a>
                    <a href="Public/connexion.php" title="Connexion Musical">Connexion</a>
                    <a href="#" onclick="informationLegales()" title="A propos">A propos</a>
                </div>
            </nav>
        </header>
        <div class="body-A">
            <div class="presentation-Projet">
                <div class="text-P">
                    <h2>Projet Musical</h2>
                    <p>Découvrer notre projet professionel</p>
                </div>
                <div class="image-Background-Main"></div>
            </div>
            <main class="main-AccueilSite">
                <div class="main-Site">
                    <h2>Présentation de Musical</h2>
                    <div class="img-presentation-Musical"></div>
                    <div class="Pre-Site">
                        <h2 class="h2-preSite">Musical</h2>
                        <h4 class="h4-Question">Qu'est ce que Musical ?</h4>
                        <div class="presentation-Musical">
                            <ul>
                                <li>Un environnement de musique </li>
                                <li>Découverte d'album</li>
                                <li>Musique illimiter</li>
                                <li>Rechercher ce que vous voulez</li>
                                <li>Et bien sur gratuit</li>
                            </ul>
                        </div>
                        <p class="pFinMainSite"><a href="Public/inscription.php">Inscriver vous</a> pour accéder au contenu </p>
                    </div>
                </div>
                <hr class="hr-separe">
                <aside class="aside-Accueil">
                    <h2>Fonctionnalité</h2>
                    <div class="fonctionnalité-Site">
                        <ul>
                            <li><a href="#" title="Album">Album</a></li>
                            <li><a href="#" title="Chanson">Chanson</a></li>
                            <li><a href="#" title="Artiste">Artiste</a></li>
                            <li><a href="#" title="Noter un album">Noter un album</a></li>
                        </ul>
                    </div>
                    <p><a href="Public/inscription.php">Inscriver vous</a> ou <a href="Public/connexion.php">Connecter vous</a></p>
                </aside>
            </main> 
        </div>
        <?php require_once 'Public/FooterUse/footer.php' ?>
    </body>
</html>