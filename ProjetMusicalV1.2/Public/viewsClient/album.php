<?php
require_once '../../vendor/autoload.php';
require_once '../../useFunction/sanitizeString.php';
use App\App;
use App\Son;
use App\Album;
use App\RechercheIn;
use App\AllInformation as getAlbum;
$user = App::getAuth()->user();
if(!$user) {
    header('Location: ../../index.php');
}

$album = new Album(new getAlbum($query, $queryCount, $params, $sortable));
$postsAlbum = $album->selectAlbum(App::getPDO(), $_GET['q'], $_GET['sort'], $_GET['dir'], $_GET['p']);
$page = getAlbum::$page;
$pages = getAlbum::$pages;

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="../../Js/footerInformation/information.js"></script>
        <link rel="stylesheet" href="../../Css/styleAAC.css">
        <link rel="stylesheet" href="../../Css/styleFooter.css">
        <link rel="stylesheet" href="../../Css/styleTopbar.css">
        <title>Album Musical</title>
    </head>
    <body>
        <header class="topbarClient">
            <nav>
                <img src="../../img/imgtop.png" alt="Image Topbar" width="150px" height="auto">
                <div class="topbarCLient-D">
                    <a href="../accueilClient.php" title="Accueil">Accueil</a>
                    <a href="artiste.php" title="Artiste">Artiste</a>
                    <a href="chanson.php" title="Chanson">Chanson</a>
                    <a href="note.php" title="Noter">Noter</a>
                    <a href="../../useFunction/logout.php" title="Se déconnecter">Se déconnecter</a>
                </div>
            </nav>
        </header>
        <div class="body-album">
            <main class="main-album">
                <h1 class="album-title">Album Musical</h1>
                <div class="rechercher">
                    <form action="">
                        <input type="text" name="q" placeholder="Rechercher par nom" value="<?= sanitizeString($_GET['q'] ?? null) ?>"/>
                    </form>
                </div>
                <div class="table-album">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><?= RechercheIn::sort('codeAlbum', 'Code Album', $_GET) ?></th>
                                <th><?= RechercheIn::sort('nomAL', 'Nom album', $_GET) ?></th>
                                <th><?= RechercheIn::sort('anneeSortie', 'Année de sortie', $_GET) ?></th>
                                <th><?= RechercheIn::sort('urlPochette', 'Url pochette', $_GET) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td colspan = "6"><hr class="separate-posts"></td></tr>
                            <?php foreach ($postsAlbum as $postAlbum): ?>
                                <tr>
                                    <td><strong><?= $postAlbum->codeAlbum ?></strong></td>
                                    <td><?= $postAlbum->nomAL ?></td>
                                    <td><?= $postAlbum->anneeSortie ?></td>
                                    <td><img src="<?= $postAlbum->urlPochette ?>" alt="image album" width="300px" height="auto"></td>
                                    <td><a href="../ListenSon/son.php?listenSong=<?= Son::getChansonFromArtiste($postAlbum->codeAlbum) ?>">Voir album</a></td>
                                </tr>
                                <tr><td colspan = "6"><hr class="separate-posts"></td></tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="paps">
                    <div class="pa">
                            <?php if ($pages > 1 && $page > 1): ?>
                                <a href="?<?= RechercheIn::withParam($_GET, "p", $page-1) ?>">Page précédente</a>
                            <?php endif ?>
                        </div>
                        <div class="ps">
                            <?php if ($pages > 1 && $page < $pages): ?>
                                <a href="?<?= RechercheIn::withParam($_GET, "p", $page+1) ?>">Page suivante</a>
                            <?php endif ?>   
                    </div>
                </div>
            </main>
        </div>   
        <?php require_once '../FooterUse/footer.php' ?>
    </body>
</html>