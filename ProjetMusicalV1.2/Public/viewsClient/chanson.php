<?php
require_once '../../vendor/autoload.php';
require_once '../../useFunction/sanitizeString.php';
use App\App;
use App\Artiste;
use App\AllInformation as getArtiste;
use App\RechercheIn;
$user = App::getAuth()->user();

$artiste = new Artiste(new getArtiste($query, $queryCount, $params, $sortable));
$postsArtiste = $artiste->selectArtiste(App::getPDO(), $_GET['q'], $_GET['sort'], $_GET['dir'], $_GET['p']);
$page = getArtiste::$page;
$pages = getArtiste::$pages;

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
        <h1>Artiste Musical</h1>
        <div class="rechercher">
        <form action="">
            <input type="text" name="q" placeholder="Recherche par nom" value="<?= sanitizeString($_GET['q'] ?? null) ?>"/>
        </form>
        </div>
        <div class="table-artiste">
            <table>
                <thead>
                    <tr>
                        <th><?= RechercheIn::sort('numA', 'Numéro artiste', $_GET) ?></th>
                        <th><?= RechercheIn::sort('nomA', 'Nom artiste', $_GET) ?></th>
                        <th><?= RechercheIn::sort('prenomA', 'Prénom artiste', $_GET) ?></th>
                        <th><?= RechercheIn::sort('urlPhoto', 'Url photo', $_GET) ?></th>
                        <th><?= RechercheIn::sort('biographie', 'Biographie', $_GET) ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($postsArtiste as $postArtiste): ?>
                    <tr>
                        <td><?= $postArtiste->numA ?></td>
                        <td><?= $postArtiste->nomA ?></td>
                        <td><?= $postArtiste->prenomA ?></td>
                        <td><?= $postArtiste->urlPhoto ?></td>
                        <td><?= $postArtiste->biographie ?></td>
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