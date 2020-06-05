<?php
//===================================================
// Name        : artisteBiographie.php
// Author      : Jonathan
// Version     : Final
// Description : Page qui permet de récupérer les biographies des artistes.
//===================================================
require_once '../../vendor/autoload.php';
require_once '../../useFunction/sanitizeString.php';
use App\App;

$user = App::getAuth()->user();
if(!$user) {
    header('Location: ../../index.php');
}

$viewArtiste = getNumArtisteForBiographie();
function getNumArtisteForBiographie() {
    $numArtiste = sanitizeString($_GET['numArtiste']);
    $query = App::getPDO()->prepare("SELECT * FROM artiste WHERE numA = '$numArtiste'");
    $query->execute();
    $viewArtiste = $query->fetch();
    if($numArtiste === null || $viewArtiste->numA !== $numArtiste) {
        header("Location: ../accueilClient.php");
        exit();
    } else {
        return $viewArtiste;
        exit();
    } return 0;
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="../../Js/footerInformation/information.js"></script>
        <link rel="stylesheet" href="../../Css/styleBiographieArtiste.css">
        <link rel="stylesheet" href="../../Css/styleTopbar.css">
        <link rel="stylesheet" href="../../Css/styleFooter.css">
        <title>Biographie Artiste</title>
    </head>
    <body>
        <header class="topbarClient">
            <nav>
                <img src="../../img/imgtop.png" alt="Image Topbar" width="150px" height="auto">
                <div class="topbarCLient-D">
                    <a href="../accueilClient.php" title="Accueil">Accueil</a>
                    <a href="album.php" title="Album">Album</a>
                    <a href="chanson.php" title="Chanson">Chanson</a>
                    <a href="note.php" title="Noter">Noter</a>
                    <a href="../../useFunction/logout.php" title="Se déconnecter">Se déconnecter</a>
                </div>
            </nav>
        </header>
        <div class="artisteBiographie">
            <h1 class="bioArtisteH1"><?= $viewArtiste->nomA?> <?= $viewArtiste->prenomA ?></h1>
            <img src="<?= $viewArtiste->urlPhoto ?>" width="300px" height="300px">
            <h2 class="bioArtisteH2">Biographie </h2>
            <p class="paraBio"><?= $viewArtiste->biographie ?></p>
            <button class="buttonReturn"><a href="artiste.php">Retour à la page Artiste</a></button>
        </div>
        <?php require_once '../FooterUse/footer.php' ?>
    </body>
</html>