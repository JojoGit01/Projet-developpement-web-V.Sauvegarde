<?php
namespace App;

class Son {

    public $titreC, $codeChanson, $auteurC, $codeAlbum, $son;
    public function __construct () {}

    //Récupére le son
    public function getSong($numSong) {
        $pdo = App::getPDO();
        $query = $pdo->prepare("SELECT * FROM chanson WHERE codeChanson = '$numSong'");
        $query->execute();
        $getInfo = $query->fetch();
        return $getInfo;
    }

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

    // Récupére l'album
    public function listenAlbum ($codeAlbum) {
        $pdo = App::getPDO();
        $query = $pdo->prepare("SELECT * FROM chanson where codeAlbum = '$codeAlbum'");
        $query->execute();
        $listenAlbum = $query->fetchAll();
        return $listenAlbum;
    }


    public static function getChansonFromArtiste ($numA) {
        $pdo = App::getPDO();
        $selectCodeChanson = $pdo->prepare("SELECT codeChanson FROM chanson JOIN artiste ON chanson.numA = artiste.numA WHERE artiste.numA = '$numA'");
        $selectCodeChanson->execute();
        $getCodeChanson = (int)$selectCodeChanson->fetch()->codeChanson;
        return $getCodeChanson;
    }
    public static function getChansonFromAlbum ($codeAlbum) {
        $pdo = App::getPDO();
        $selectCodeChanson = $pdo->prepare("SELECT codeChanson FROM chanson JOIN album ON chanson.codeAlbum = album.codeAlbum WHERE album.codeAlbum = '$codeAlbum'");
        $selectCodeChanson->execute();
        $getCodeChanson = (int)$selectCodeChanson->fetch()->codeChanson;
        return $getCodeChanson;
    }
}