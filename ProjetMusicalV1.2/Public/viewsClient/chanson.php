<?php
require_once '../../vendor/autoload.php';
require_once '../../useFunction/sanitizeString.php';
use App\App;
use App\Chanson;
use App\AllInformation as getChanson;
use App\RechercheIn;
$user = App::getAuth()->user();

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
    <title>Artiste Musical</title>
</head>
<body>
    <div class="body-artiste">
        <h1>Chanson Musical</h1>
        <div class="rechercher">
        <form action="">
            <input type="text" name="q" placeholder="Recherche par nom" value="<?= sanitizeString($_GET['q'] ?? null) ?>"/>
        </form>
        </div>
        <div class="table-artiste">
            <table>
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
                <?php foreach ($postsChanson as $postChanson): ?>
                    <tr>
                        <td><?= $postChanson->codeChanson ?></td>
                        <td><?= $postChanson->titreC ?></td>
                        <td><?= $postChanson->duree ?></td>
                        <td><?= $postChanson->auteurC ?></td>
                        <td><?= $postChanson->noteOpinionC ?></td>
                        <td><?= $postChanson->numA ?></td>
                        <td><?= $postChanson->codeAlbum ?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="PSPA">
            <?php if ($pages > 1 && $page > 1): ?>
                <a href="?<?= RechercheIn::withParam($_GET, "p", $page-1) ?>">Page précéente</a>
            <?php endif ?>
            <?php if ($pages > 1 && $page < $pages): ?>
                <a href="?<?= RechercheIn::withParam($_GET, "p", $page+1) ?>">Page suivante</a>
            <?php endif ?>   
        </div> 
    </div>  
</body>
</html>