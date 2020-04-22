<?php
require '../vendor/autoload.php';
use App\App;
$user = App::getAuth()->user();
if(!$user) {
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil client</title>
</head>
<body>
    <h1>Hello <?= $user->prenomC ?></h1>
    <div>
        <a href="viewsClient/artiste.php">Artiste</a>
        <a href="viewsClient/album.php">Album</a>
        <a href="viewsClient/chanson.php">Chanson</a>
        <a href="viewsClient/note.php">Noter</a>

    <a href="../useFunction/logout.php">Se déconnecter</a>
</body>
</html>