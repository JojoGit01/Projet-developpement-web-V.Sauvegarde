<?php
//===================================================
// Name        : Album.php
// Author      : Jonathan
// Version     : Final
//===================================================
namespace App;
use PDO;
class Album extends AllInformation {

    private $codeAlbum, $nomAL, $anneeSortie, $urlPochette;
    public function __construct () {}

    public function selectAlbum(PDO $pdo, $q, $sort, $dir, $p) {
        $this->query = "SELECT * FROM album";
        $this->queryCount = "SELECT COUNT(codeAlbum) as codeAlbum FROM album";
        $this->params = []; 
        $this->sortable = ["codeAlbum", "nomAL", "anneeSortie", "urlPochette"];

        self::seekAAC($q, "nomAL", "null", "null");
        $postS = self::getInformation($sort, $dir, $p, $pdo);
        self::perPages($pdo, "codeAlbum");
        
        return $postS;
    }
}