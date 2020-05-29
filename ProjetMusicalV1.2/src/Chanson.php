<?php
//Creator : Jonathan
namespace App;
use PDO;
class Chanson extends AllInformation{

    private $codeChanson, $titreC, $duree, $auteurC, $noteOpinionC, $numA, $codeAlbum;
    public function __construct () {}

    public function selectChanson(PDO $pdo, $q, $sort, $dir, $p) {
        $this->query = "SELECT * FROM chanson";
        $this->queryCount = "SELECT COUNT(codeChanson) as codeChanson FROM chanson";
        $this->params = []; 
        $this->sortable = ["codeChanson", "titreC", "duree", "auteurC", "noteOpinionC", "numA", "codeAlbum"];

        self::seekAAC($q, "auteurC", "null", "titreC");
        $postS = self::getInformation($sort, $dir, $p, $pdo);
        self::perPages($pdo, "codeChanson");
        
        return $postS;
    }

    // Pour les notes //
    public static function getChanson(PDO $pdo) {
        $select = $pdo->prepare("SELECT titreC FROM chanson");
        $select->execute();
        $selectTitre = $select->fetchAll();
        return $selectTitre;
    }
}