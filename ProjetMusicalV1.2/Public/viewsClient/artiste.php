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
        <link rel="stylesheet" href="../../Css/styleArtiste.css">
        <title>Artiste Musical</title>
    </head>
    <body>
        <header class="topbarClient">
            <nav>
                <div class="topbarClient-G"></div>
                    <img src="../../img/imgtop.png" alt="Image Topbar" width="150px" height="auto">
                </div>
                <div class="topbarCLient-D">
                    <a href="../accueilClient.php" title="Artiste">Accueil</a>
                    <a href="album.php" title="Album">Album</a>
                    <a href="chanson.php" title="Chanson">Chanson</a>
                    <a href="note.php" title="Noter">Noter</a>
                    <a href="../../useFunction/logout.php" title="Se déconnecter">Se déconnecter</a>
                </div>
            </nav>
        </header>
        <div class="body-artiste">
            <main class="main-artiste">
                <h1 class="artiste-title">Artiste Musical</h1>
                <div class="rechercher">
                    <form action="" method="get">
                        <input type="text" name="q" placeholder="Recherche par nom" value="<?= sanitizeString($_GET['q'] ?? null) ?>"/>
                    </form>
                </div>
                <div class="table-artiste">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><?= RechercheIn::sort('numA', 'Numéro artiste', $_GET) ?></th>
                                <th><?= RechercheIn::sort('nomA', 'Nom artiste', $_GET) ?></th>
                                <th><?= RechercheIn::sort('prenomA', 'Prénom artiste', $_GET) ?></th>
                                <th><?= RechercheIn::sort('urlPhoto', 'Photo', $_GET) ?></th>
                                <th><?= RechercheIn::sort('biographie', 'Biographie', $_GET) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td colspan = "6"><hr class="separate-posts"></td></tr>
                            <?php foreach ($postsArtiste as $postArtiste): ?>
                                <tr> 
                                    <td><strong><?= $postArtiste->numA ?></strong></td>
                                    <td><?= $postArtiste->nomA ?></td>
                                    <td><?= $postArtiste->prenomA ?></td>
                                    <td><img src="../../<?= $postArtiste->urlPhoto ?>" alt="<?= $postArtiste->urlPhoto ?>" width="300px" height="auto"></td>
                                    <td class="bio-cal"><?= $postArtiste->biographie ?></td>
                                    <td><a href="#"><img src="../../img/lectureAudio.png" alt="lecture audio" width="150px" height="auto"></a></td>
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