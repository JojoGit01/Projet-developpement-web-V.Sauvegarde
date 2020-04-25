<?php
require_once '../useFunction/sanitizeString.php';
require_once '../vendor/autoload.php';
use App\App;
$user = App::getAuth()->user();
if(!$user) {
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <script type="text/javascript" src="../Js/jquery.js"></script>
        <script src="../Js/galerieSysteme.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Css/styleAccueilClient.css">
        <title>Site Musical</title>
    </head>
    <body>
        <header class="topbarClient">
            <nav>
                <div class="topbarClient-G"></div>
                    <img src="../img/imgtop.png" alt="Image Topbar" width="150px" height="auto">
                </div>
                <div class="topbarCLient-D">
                    <a href="viewsClient/artiste.php" title="Artiste">Artiste</a>
                    <a href="viewsClient/album.php" title="Album">Album</a>
                    <a href="viewsClient/chanson.php" title="Chanson">Chanson</a>
                    <a href="viewsClient/note.php" title="Noter">Noter</a>
                    <a href="../useFunction/logout.php" title="Se déconnecter">Se déconnecter</a>
                </div>
            </nav>
        </header>
        <div class="slideContainGalerie">
            <div id="galerie">
                <img src="../img/firstimg.jpg" alt="image1" class="active"/>
                <img src="../img/no-pub.png" alt="image2"/>
                <img src="../img/zap-inf.png" alt="image3"/>
            </div>
        </div>
        <div class="body-accueilMusical">
            <div class="presentation-accueilMusical">
                <h2 class="title-background">Bienvenue <?= $user->identifiantC ?></h2>
                <div class="image-backgroundAccueil"></div>
            </div>
            <div class="container-accueilMusical">
                <main class="main-accueilMusical">
                    <div class="aspect-accueilMusical">
                        <div class="download-sound">
                            <div class="download">
                                <img src="../img/music-download.png" alt="Download Music">
                                <h4>Télécharger votre musique.</h4>
                                <p>Profitez-en même sans connexion internet</p>
                            </div>
                            <div class="sound">
                                <img src="../img/ecouter-musique.jpg" alt="Photo ecouter">
                                <h4>Ecoutez les titres de votre choix.</h4>
                            </div>
                        </div>
                        <div class="pub-zap">
                            <div class="pub">
                                <img src="../img/no-pub.png" alt="image no pub">
                                <h4>Pas de coupures publicitaires.</h4>
                                <p>Profitez de vos titres sans interruption.</p>
                            </div>
                            <div class="zap">
                                <img src="../img/zap-inf.png" alt="zap infini">
                                <h4>Zapping à l'infini.</h4>
                                <p>Cliquez simplement sur suivant.</p>
                            </div>
                        </div>
                    </div>
                    <hr class="separate">
                    <div class="site-view">
                        <div class="see-information">
                            <h2>Chercher vous quelque chose de spéciale</h2>
                            <div class="search-information">
                                <h3><a href="viewsClient/artiste.php" title="artiste">Visualiser les artistes</a></h3>
                                <h3><a href="viewsClient/chanson.php" title="chanson">Visualiser des chansons</a></h3>
                                <h3><a href="viewsClient/album.php" title="album">Visualiser quelque album</a></h3>
                                <h3><a href="viewsClient/note.php" title="noter">Noter une chanson</a></h3>
                            </div>
                        </div>
                    </div>
                    <hr class="separate">
                    <div class="site-message">
                        <div class="comments">
                            <fieldset class="fieldset">
                                <legend>Laisser nous un commentaire</legend>
                                <label for="commentaire"></label>
                                <textarea class="comment" cols="40" rows="10">Laisser un commentaire</textarea>
                                <input type="submit" id="envoyerComment" name="envoyerComment" value="Envoyer commentaire">
                            </fieldset>
                        </div>
                    </div>
                </main>
                <hr class="separate-main-aside">
                <aside class="aside-accueilMusical">
                    <div class="image-recherche-back"></div>
                    <form action="" method="post">
                        <div class="search">
                            <h4>Faire une recherche</h4>
                            <div class="rechercheAAT">
                                <div class="recherchePrecise">
                                    <label>Recherche précise : </label>
                                    <select name="recherchePar" value="<?php sanitizeString($_POST['rechercherPar']) ?>">
                                        <option>Artiste</option>
                                        <option>Album</option>
                                        <option>Chanson</option>
                                    </select>
                                </div>
                                <div class="doRecherche">
                                    <input type="text" name="rechercheOut" value="<?php sanitizeString($_POST['rechercherOut']) ?>">
                                </div>
                            </div>
                        </div>
                    </form>
                </aside>
            </div>
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