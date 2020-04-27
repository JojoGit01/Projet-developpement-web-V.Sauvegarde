<?php
// php -S localhost:8080 : Pour mes test //
require_once '../../vendor/autoload.php';
require_once '../../useFunction/sanitizeString.php';

use App\App;
use App\Son;
$user = App::getAuth()->user();
if(!$user) {
    header('Location: ../../index.php');
}

$son = new Son();

// Récupére le son //
$listenSong = sanitizeString($_GET['listenSong']);
$getInfo = $son->getSong($listenSong);
$checkNum = $son->checkGet($listenSong, $getInfo);

?>
<?php if($checkNum): ?>  
    <!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../../Css/styleFooter.css">
            <title>Son : <?= $getInfo->titreC ?></title>
        </head>
        <body>
            <header class="topbarClient">
                <nav>
                    <img src="../../img/imgtop.png" alt="Image Topbar" width="150px" height="auto">
                    <div class="topbarCLient-D">
                        <a href="../accueilClient.php" title="Artiste">Accueil</a>
                        <a href="../viewsClient/chanson.php" title="Chanson">Chanson</a>
                        <a href="../../useFunction/logout.php" title="Se déconnecter">Se déconnecter</a>
                    </div>
                </nav>
            </header>
            <div class="body-son">
                <main class="son">
                    <h1>Vous écouter : <?= $getInfo->titreC ?> de <?= $getInfo->auteurC ?></h1>
                    <iframe width="700px" height="400px" src="<?=$getInfo->son?>"></iframe>  
                </main>
                <aside class="aside-son">
                    <div class="otherSon">
                        <?php for($i = 0; $i < 10; $i++): ?>
                            <ul>
                                <li>Autre chanson : ...</li>
                            </ul>
                            <hr>
                        <?php endfor ?>
                    </div>
                </aside>
            </div>
            <?php require_once '../FooterUse/footer.php' ?>
        </body>
    </html>
<?php endif ?>