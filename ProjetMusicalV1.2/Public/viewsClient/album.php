<?php
require_once '../../vendor/autoload.php';
use App\App;
$pdo = App::getPDO();
$selectAlbum = $pdo->prepare('SELECT * FROM album');
$selectAlbum->execute();
$posts = $selectAlbum->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
</head>
<body>
    <h1>Album Musical</h1>
    <div class="table-Album">
        <table>
            <thead>
                <tr>
                    <th>Code Album</th>
                    <th>Nom Album</th>
                    <th>Année de sortie</th>
                    <th>Photo Pochette </th>
                <tr>
            </thead>
            <tbody>
            <?php foreach ($posts as $albumP): ?>
                <tr>
                    <td><?= $albumP['codeAlbum'] ?></td>
                    <td><?= $albumP['nomAL'] ?></td>
                    <td><?= $albumP['anneeSortie'] ?></td>
                    <td><?= $albumP['urlPochette'] ?></td>
                    <td><a href="#">Ecouter l'album</a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>
</html>