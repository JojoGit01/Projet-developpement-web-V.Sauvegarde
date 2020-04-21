<?php
require_once '../../vendor/autoload.php';
use App\App;
$pdo = App::getPDO();
$selectAlbum = $pdo->prepare('SELECT * FROM artiste');
$selectAlbum->execute();
$posts = $selectAlbum->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artiste Musical</title>
</head>
<body>
    
</body>
</html>