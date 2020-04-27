<?php
namespace App;

class Son {

    public $titreC, $codeChanson, $auteurC, $son;
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

    public function listenOtherSong () {
        $pdo = App::getPDO();
        $query = $pdo->prepare("SELECT * FROM chanson LIMITS 10");
        $query->execute();
        $query->fetchAll();
    }
}