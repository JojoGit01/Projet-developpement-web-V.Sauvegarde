<?php
//===================================================
// Name        : accueilClient.php
// Author      : Jonathan
// Version     : Final
// Description : Page principale pour les clients qui sont connectées 
//===================================================
require_once '../useFunction/sanitizeString.php';
require_once '../vendor/autoload.php';
use App\App;
use App\Artiste;
$user = App::getAuth()->user();
if(!$user) {
    header('Location: ../index.php');
}
$imageArtiste = new Artiste();
$images = $imageArtiste->selectImage(App::getPDO());

if (isset($_POST['sendRecherche'])) {
    $rechercheOption =  sanitizeString($_POST['rechercherPar']);
    $recherche = sanitizeString($_POST['rechercherOut']);

    $rechercheOption === "Artiste" ? header("Location: viewsClient/artiste.php?q=$recherche") : null;
    $rechercheOption === "Album" ? header("Location: viewsClient/album.php?q=$recherche") : null;
    $rechercheOption === "Chanson" ? header("Location: viewsClient/chanson.php?q=$recherche") : null;
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <script type="text/javascript" src="../Js/jquery.js"></script>
        <script type="text/javascript" src="../Js/footerInformation/information.js"></script>
        <script src="../Js/galerieSysteme.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Css/styleFooter.css">
        <link rel="stylesheet" href="../Css/styleAccueilClient.css">
        <link rel="stylesheet" href="../Css/styleTopbar.css">
        <title>Site Musical</title>
    </head>
    <body>
        <header class="topbarClient">
            <nav>
                <img src="../img/imgtop.png" alt="Image Topbar" width="150px" height="auto">
                <div class="topbarCLient-D">
                    <a href="viewsClient/artiste.php" title="Artiste">Artiste</a>
                    <a href="viewsClient/album.php" title="Album">Album</a>
                    <a href="viewsClient/chanson.php" title="Chanson">Chanson</a>
                    <a href="viewsClient/note.php" title="Noter">Noter</a>
                    <a href="../useFunction/logout.php" title="Se déconnecter">Se déconnecter</a>
                </div>
            </nav>
        </header>

        <div class="body-accueilMusical">
            <div class="presentation-accueilMusical">
                <div class="image-backgroundAccueil"></div>
                <h1 class="title-background">Bienvenue <?= $user->identifiantC ?></h1>
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
                            <h2>Cherchez-vous quelque chose de spécial</h2>
                            <div class="search-information">
                                <h3><a href="viewsClient/artiste.php" title="artiste">Visualiser les artistes</a></h3>
                                <h3><a href="viewsClient/chanson.php" title="chanson">Visualiser des chansons</a></h3>
                                <h3><a href="viewsClient/album.php" title="album">Visualiser quelques albums</a></h3>
                                <h3><a href="viewsClient/note.php" title="noter">Noter une chanson</a></h3>
                            </div>
                        </div>
                    </div>
                    <hr class="separate">
                </main>
                <hr class="separate-main-aside">
                <aside class="aside-accueilMusical">
                    <div class="image-recherche-back">
                        <form action="" method="post">
                            <div class="search">
                                <h2 class="title-recherche">Faire une recherche</h2>
                                <div class="rechercheAAT">
                                    <div class="recherchePrecise">
                                        <label><strong>Vous recherchez</strong></label>
                                        <select name="rechercherPar" value="<?php sanitizeString($_POST['rechercherPar']) ?>" required>
                                            <option>Artiste</option>
                                            <option>Album</option>
                                            <option>Chanson</option>
                                        </select>
                                    </div>
                                    <div class="doRecherche">
                                        <label for="rechercheOut"><strong>Votre recherche</strong></label>
                                        <input type="text" name="rechercherOut" value="<?php sanitizeString($_POST['rechercherOut']) ?>" placeholder="Artiste / Album / Chanson" required>
                                    </div>
                                    <div class="buttonR">
                                        <input type="submit" name="sendRecherche" id="sendRecherche" value="Rechercher">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="slideContainGalerie">
                        <div id="galerie">
                            <img src="../img/imgtop.png" class="active"/>
                            <?php foreach ($images as $image): ?>
                                <img src="<?= $image->urlPhoto ?>"/>
                            <?php endforeach ?>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
        <?php 
            // footer
            require_once 'FooterUse/footer.php' 
        ?>
    </body>
</html>