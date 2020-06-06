<?php
//===================================================
// Name        : son.php
// Author      : Jonathan
// Version     : Final
// Description : Page permettant d'écouter la chanson d'un artiste chosit et de pouvoir écouter son album.
//===================================================
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

$listenAlbums = $son->listenAlbum($getInfo->codeAlbum);
?>
<?php if($checkNum): ?>  
    <!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script type="text/javascript" src="../../Js/sonViews/sonBoom.js"></script>
            <link rel="stylesheet" href="../../Css/styleFooter.css">
            <link rel="stylesheet" href="../../Css/styleSon.css">
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
                    <h1 class="title-son">Vous écoutez : <strong id="titleAuteur"><?= $getInfo->titreC ?> de <?= $getInfo->auteurC ?></strong></h1>
                    <iframe class="iframe-son" src="<?=$getInfo->son?>"></iframe>  
                </main>
                <aside class="aside-son">
                    <div class="albumSonGetting">
                        <h2 class="title-aside-son">Chanson Album</h2>
                        <?php foreach ($listenAlbums as $listenAlbum): ?>
                            <ul>
                                <li class="neutral"><a href="?listenSong=<?= $listenAlbum->codeChanson ?>"><?= $listenAlbum->titreC ?> de <?= $listenAlbum->auteurC ?></a></li>
                            </ul>
                        <?php endforeach ?>
                    </div>
                </aside>
            </div>
            <?php require_once '../FooterUse/footer.php' ?>
        </body>
    </html>
<?php endif ?>