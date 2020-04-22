<?php
require_once '../../vendor/autoload.php';
require_once '../../useFunction/sanitizeString.php';
use App\App;
use App\Album;
use App\AllInformation as getAlbum;
use App\RechercheIn;
$user = App::getAuth()->user();

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
    <title>Album Musical</title>
</head>
<body>
    <div class="body-artiste">
        <h1>Album Musical</h1>
        <div class="rechercher">
        <form action="">
            <input type="text" name="q" placeholder="Rechercher par nom" value="<?= sanitizeString($_GET['q'] ?? null) ?>"/>
        </form>
        </div>
        <div class="table-artiste">
            <table>
                <thead>
                    <tr>
                        <th><?= RechercheIn::sort('codeAlbum', 'Code Album', $_GET) ?></th>
                        <th><?= RechercheIn::sort('nomAL', 'Nom album', $_GET) ?></th>
                        <th><?= RechercheIn::sort('anneeSortie', 'Année de sortie', $_GET) ?></th>
                        <th><?= RechercheIn::sort('urlPochette', 'Url pochette', $_GET) ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($postsAlbum as $postAlbum): ?>
                    <tr>
                        <td><?= $postAlbum->codeAlbum ?></td>
                        <td><?= $postAlbum->nomAL ?></td>
                        <td><?= $postAlbum->anneeSortie ?></td>
                        <td><?= $postAlbum->urlPochette ?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="PSPA">
            <?php if ($pages > 1 && $page > 1): ?>
                <a href="?<?= RechercheIn::withParam($_GET, "p", $page-1) ?>">Page précédente</a>
            <?php endif ?>
            <?php if ($pages > 1 && $page < $pages): ?>
                <a href="?<?= RechercheIn::withParam($_GET, "p", $page+1) ?>">Page suivante</a>
            <?php endif ?>   
        </div> 
    </div>   
</body>
</html>