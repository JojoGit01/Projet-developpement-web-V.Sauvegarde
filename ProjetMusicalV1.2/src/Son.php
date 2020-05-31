<?php
//Creator : Jonathan
namespace App;
use PDO;
class Son {

    public $titreC, $codeChanson, $auteurC, $codeAlbum, $son;
    public function __construct () {}

    //Récupére toutes les données d'un son ou d'un album
    public static function getDatas ($idT, $numT) {
        $pdo = App::getPDO();
        $query = $pdo->prepare("SELECT * FROM chanson WHERE $idT = $numT");
        $query->execute();
        $idT === "codeChanson" ? $getDatas = $query->fetch() : $getDatas = $query->fetchAll();
        return $getDatas;
    }
    //Récupére le son dans la base de données
    public function getSong($numSong) {
        $idT = "codeChanson";
        return self::getDatas($idT, $numSong);
    }
    //Vérifier que les informations de la chanson écouté est bien disponible
    public function checkGet($listenSong, $getInfo) {
        if($listenSong === null || $getInfo->codeChanson !== $listenSong) {
            header("Location: ../accueilClient.php");
            exit();
        } else {
            return true;
            exit();
        }
        return 0;
    }

    // Récupére l'album dans la base de données
    public function listenAlbum ($codeAlbum) {
        $idT = "codeAlbum";
        return self::getDatas($idT, $codeAlbum); 
    }

    //Récupérer le codeChanson à partir de l'artiste ou de l'album.
    public static function getData($nameJoinT, $numT, $data) {
        $pdo = App::getPDO();
        $query = $pdo->prepare("SELECT codeChanson FROM chanson JOIN $nameJoinT ON chanson.$numT = $nameJoinT.$numT WHERE $nameJoinT.$numT = '$data'");
        $query->execute();
        return (int)$query->fetch()->codeChanson;
    }
    public static function getChansonFromArtiste ($numA) {
        $nameJoinT = "artiste"; 
        $numT = "numA";
        return self::getData($nameJoinT, $numT, $numA);
    }
    public static function getChansonFromAlbum ($codeAlbum) {
        $nameJoinT = "album"; 
        $numT = "codeAlbum";
        return self::getData($nameJoinT, $numT, $codeAlbum);
    }
}