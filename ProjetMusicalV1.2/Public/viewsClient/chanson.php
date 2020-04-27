<?php
require_once '../../vendor/autoload.php';
require_once '../../useFunction/sanitizeString.php';
use App\App;
use App\Chanson;
use App\RechercheIn;
use App\AllInformation as getChanson;

$user = App::getAuth()->user();
if(!$user) {
    header('Location: ../../index.php');
}

$chanson = new Chanson(new getChanson($query, $queryCount, $params, $sortable));
$postsChanson = $chanson->selectChanson(App::getPDO(), $_GET['q'], $_GET['sort'], $_GET['dir'], $_GET['p']);
$page = getChanson::$page;
$pages = getChanson::$pages;

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
        <title>Artiste Musical</title>
    </head>
    <body>
        <header class="topbarClient">
            <nav>
                <img src="../../img/imgtop.png" alt="Image Topbar" width="150px" height="auto">
                <div class="topbarCLient-D">
                    <a href="../accueilClient.php" title="Accueil">Accueil</a>
                    <a href="artiste.php" title="Artiste">Artiste</a>
                    <a href="album.php" title="Album">Album</a>
                    <a href="note.php" title="Noter">Noter</a>
                    <a href="../../useFunction/logout.php" title="Se déconnecter">Se déconnecter</a>
                </div>
            </nav>
        </header>
        <div class="body-chanson">
            <main class="main-chanson">
                <h1 class="chanson-title">Chanson Musical</h1>
                <div class="rechercher">
                <form action="">
                    <input type="text" name="q" placeholder="Recherche par titre" value="<?= sanitizeString($_GET['q'] ?? null) ?>"/>
                </form>
                </div>
                <div class="table-chanson">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><?= RechercheIn::sort('codeChanson', 'Code chanson', $_GET) ?></th>
                                <th><?= RechercheIn::sort('titreC', 'Titre', $_GET) ?></th>
                                <th><?= RechercheIn::sort('duree', 'Durée', $_GET) ?></th>
                                <th><?= RechercheIn::sort('auteurC', 'Auteur', $_GET) ?></th>
                                <th><?= RechercheIn::sort('noteOpinionC', 'Note d\' opinion', $_GET) ?></th>
                                <th><?= RechercheIn::sort('numA', 'Numéro Artiste', $_GET) ?></th>
                                <th><?= RechercheIn::sort('codeAlbum', 'Code Album', $_GET) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td colspan = "8"><hr class="separate-posts"></td></tr>
                            <?php foreach ($postsChanson as $postChanson): ?>
                                <tr>
                                    <td><?= $postChanson->codeChanson ?></td>
                                    <td><?= $postChanson->titreC ?></td>
                                    <td><?= $postChanson->duree ?></td>
                                    <td><?= $postChanson->auteurC ?></td>
                                    <td><?= $postChanson->noteOpinionC ?></td>
                                    <td><?= $postChanson->numA ?></td>
                                    <td><?= $postChanson->codeAlbum ?></td>
                                    <td><a href="../ListenSon/son.php?listenSong=<?= sanitizeString($postChanson->codeChanson) ?>"><img src="../../img/lectureAudio.png" width="75px" height="auto"></a></td>
                                </tr>
                                <tr><td colspan = "8"><hr class="separate-posts"></td></tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="paps">
                    <div class="pa">
                        <?php if ($pages > 1 && $page > 1): ?>
                            <a href="?<?= RechercheIn::withParam($_GET, "p", $page-1) ?>">Page précéente</a>
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